<?php
// Cron job: picks up posters emailed to the posters address, has Claude read
// them, and emails the approvers a link to review each one.
// cPanel > Cron Jobs, every 5 minutes:
//   php /home/<account>/public_html/process_inbox.php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/mail_client.php';
require_once __DIR__ . '/activity_lib.php';
require_once __DIR__ . '/poster_reader.php';
include __DIR__ . '/db_connection.php';

const MAX_ATTEMPTS = 3;
const MAX_IMAGE_BYTES = 4500000; // Claude accepts images up to 5 MB
const MIN_IMAGE_BYTES = 30000;
const LOOKBACK_DAYS = 3;

// One run at a time, in case a run takes longer than the cron interval.
$lock = fopen(sys_get_temp_dir() . '/hinduupm_process_inbox.lock', 'c');
if (!flock($lock, LOCK_EX | LOCK_NB)) {
    exit;
}

$cfg = mail_config();
try {
    $imap = new ImapClient($cfg['imap_host'], $cfg['imap_port'], $cfg['username'], $cfg['app_password']);
    $uids = $imap->search_to($cfg['poster_address'], new DateTime('-' . LOOKBACK_DAYS . ' days'));
} catch (Throwable $e) {
    inbox_log('inbox: ' . $e->getMessage());
    exit(1);
}

// Emails already finished with, so they aren't downloaded again.
$finished = array_map('intval', array_column($conn->query(
    "SELECT imap_uid FROM poster_inbox WHERE imap_uid IS NOT NULL AND (status <> 'received' OR attempts >= " . MAX_ATTEMPTS . ")"
)->fetch_all(MYSQLI_ASSOC), 'imap_uid'));

$new = array_diff($uids, $finished);
echo date('Y-m-d H:i:s') . ' checked ' . $cfg['poster_address'] . ': ' . count($uids) . ' emails in the last ' . LOOKBACK_DAYS . ' days, ' . count($new) . " to look at\n";

foreach ($new as $uid) {
    try {
        $mail = mail_parse($imap->fetch($uid));
    } catch (Throwable $e) {
        inbox_log('inbox uid ' . $uid . ': ' . $e->getMessage());
        continue;
    }

    $row = inbox_row($conn, $mail, $uid);
    if ($row['status'] === 'ignored') {
        echo 'ignored email from ' . $mail['from'] . " (not in approvers or submitters)\n";
    }
    if ($row['status'] !== 'received' || $row['attempts'] >= MAX_ATTEMPTS) {
        continue;
    }

    $conn->query("UPDATE poster_inbox SET attempts = attempts + 1 WHERE id = " . (int) $row['id']);
    try {
        $count = inbox_process($conn, $mail);
        echo 'email from ' . $mail['from'] . ': ' . $count . " new poster(s)\n";
        $stmt = $conn->prepare("UPDATE poster_inbox SET status = 'done', posters = ?, error = NULL WHERE id = ?");
        $stmt->bind_param("ii", $count, $row['id']);
        $stmt->execute();
        $stmt->close();
    } catch (Throwable $e) {
        inbox_log('inbox ' . $row['id'] . ': ' . $e->getMessage());
        $failed = $row['attempts'] + 1 >= MAX_ATTEMPTS;
        $status = $failed ? 'failed' : 'received';
        $msg = $e->getMessage();
        $stmt = $conn->prepare("UPDATE poster_inbox SET status = ?, error = ? WHERE id = ?");
        $stmt->bind_param("ssi", $status, $msg, $row['id']);
        $stmt->execute();
        $stmt->close();
        if ($failed) {
            inbox_reply($mail, 'போஸ்டரை படிக்க முடியவில்லை',
                "மன்னிக்கவும், இந்த போஸ்டரை தானாக படிக்க முடியவில்லை. இணையதள நிர்வாக பக்கத்தில் நேரடியாக சேர்க்கவும்.");
        }
    }
}
$imap->logout();

// The inbox row for this email, created on first sight. Emails from senders
// who aren't on the lists are recorded as ignored and never read.
function inbox_row(mysqli $conn, array $mail, $uid) {
    $stmt = $conn->prepare("SELECT * FROM poster_inbox WHERE message_id = ?");
    $stmt->bind_param("s", $mail['message_id']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($row) {
        return $row;
    }

    $status = mail_is_submitter($mail['from']) ? 'received' : 'ignored';
    $stmt = $conn->prepare("INSERT INTO poster_inbox (message_id, imap_uid, from_address, subject, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $mail['message_id'], $uid, $mail['from'], $mail['subject'], $status);
    $stmt->execute();
    $stmt->close();
    return inbox_row($conn, $mail, $uid);
}

// Creates a pending activity per poster in the email; returns how many.
function inbox_process(mysqli $conn, array $mail) {
    if (!$mail['images']) {
        inbox_reply($mail, 'போஸ்டர் இணைக்கப்படவில்லை', 'இந்த மின்னஞ்சலில் போஸ்டர் படம் இல்லை. போஸ்டரை இணைத்து மீண்டும் அனுப்பவும்.');
        return 0;
    }

    $note = trim($mail['subject'] . "\n" . $mail['text']);
    $created = [];
    foreach ($mail['images'] as list($bytes, $mime)) {
        $hash = hash('sha256', $bytes);
        // Skip signature logos and other small inline images, and repeats.
        if (strlen($bytes) < MIN_IMAGE_BYTES || activity_find_by_hash($conn, $hash)) {
            continue;
        }

        $ext = ['image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? 'jpg';
        $image_url = 'images/uploads/mail_' . substr($hash, 0, 16) . '.' . $ext;
        if (!is_dir(__DIR__ . '/images/uploads')) {
            mkdir(__DIR__ . '/images/uploads', 0755, true);
        }
        file_put_contents(__DIR__ . '/' . $image_url, $bytes);

        $reader_copy = inbox_shrink_for_reader(__DIR__ . '/' . $image_url);
        try {
            $fields = poster_read($reader_copy, activity_types($conn), activity_places($conn), $note);
        } catch (Throwable $e) {
            unlink(__DIR__ . '/' . $image_url);
            throw $e;
        } finally {
            if ($reader_copy !== __DIR__ . '/' . $image_url) {
                unlink($reader_copy);
            }
        }

        if (empty($fields['is_activity_poster'])) {
            unlink(__DIR__ . '/' . $image_url);
            continue;
        }
        $created[] = activity_create_pending($conn, $fields, $image_url, $hash, $mail['from']);
    }

    if (!$created) {
        inbox_reply($mail, 'புதிய போஸ்டர் இல்லை', 'இந்த போஸ்டர் ஏற்கனவே பெறப்பட்டது, அல்லது செயல்பாட்டு போஸ்டர் போல் தெரியவில்லை.');
        return 0;
    }

    $site = rtrim(hinduupm_config()['site_url'], '/');
    $body = '';
    foreach ($created as $id) {
        $body .= activity_summary(activity_get($conn, $id)) . "\n" . $site . '/pendingActivities.php?id=' . $id . "\n\n";
    }
    foreach (mail_config()['approvers'] as $approver) {
        try {
            mail_send($approver, 'ஒப்புதலுக்கு புதிய போஸ்டர்', "சரிபார்த்து வெளியிட இணைப்பை திறக்கவும்:\n\n" . $body . 'அனுப்பியவர்: ' . $mail['from']);
        } catch (Throwable $e) {
            inbox_log('mail to ' . $approver . ': ' . $e->getMessage());
        }
    }
    if (!mail_is_approver($mail['from'])) {
        inbox_reply($mail, 'போஸ்டர் பெறப்பட்டது', 'போஸ்டர் பெறப்பட்டது. ஒப்புதலுக்குப் பிறகு இணையதளத்தில் வெளியிடப்படும். நன்றி!');
    }
    return count($created);
}

function inbox_reply(array $mail, $subject, $text) {
    try {
        mail_send($mail['from'], $subject, $text);
    } catch (Throwable $e) {
        inbox_log('mail to ' . $mail['from'] . ': ' . $e->getMessage());
    }
}

// Returns a copy small enough for Claude, or the original if it already is.
function inbox_shrink_for_reader($path) {
    if (filesize($path) <= MAX_IMAGE_BYTES || !function_exists('imagecreatefromstring')) {
        return $path;
    }
    $img = imagecreatefromstring(file_get_contents($path));
    $scale = min(1, 2000 / max(imagesx($img), imagesy($img)));
    $small = imagescale($img, (int) (imagesx($img) * $scale), (int) (imagesy($img) * $scale));
    $out = tempnam(sys_get_temp_dir(), 'poster') . '.jpg';
    imagejpeg($small, $out, 85);
    return $out;
}

// Errors go to the PHP error log and to the cron output.
function inbox_log($message) {
    error_log('hinduupm ' . $message);
    echo $message . "\n";
}
?>
