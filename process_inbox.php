<?php
// Cron job: reads queued WhatsApp posters and sends them to the approvers.
// cPanel > Cron Jobs, every minute:
//   php /home/<account>/public_html/process_inbox.php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/whatsapp_api.php';
require_once __DIR__ . '/activity_lib.php';
require_once __DIR__ . '/poster_reader.php';
include __DIR__ . '/db_connection.php';

const MAX_ATTEMPTS = 3;
const MAX_IMAGE_BYTES = 4500000; // Claude accepts images up to 5 MB

// One run at a time, in case a run takes longer than a minute.
$lock = fopen(sys_get_temp_dir() . '/hinduupm_process_inbox.lock', 'c');
if (!flock($lock, LOCK_EX | LOCK_NB)) {
    exit;
}

$rows = $conn->query(
    "SELECT * FROM whatsapp_inbox WHERE status = 'received' AND attempts < " . MAX_ATTEMPTS . " ORDER BY id LIMIT 10"
)->fetch_all(MYSQLI_ASSOC);

foreach ($rows as $row) {
    $conn->query("UPDATE whatsapp_inbox SET attempts = attempts + 1 WHERE id = " . (int) $row['id']);
    try {
        $activity_id = inbox_process($conn, $row);
        $stmt = $conn->prepare("UPDATE whatsapp_inbox SET status = 'done', activity_id = ?, error = NULL WHERE id = ?");
        $stmt->bind_param("ii", $activity_id, $row['id']);
        $stmt->execute();
        $stmt->close();
    } catch (Throwable $e) {
        error_log('hinduupm inbox ' . $row['id'] . ': ' . $e->getMessage());
        $failed = $row['attempts'] + 1 >= MAX_ATTEMPTS;
        $status = $failed ? 'failed' : 'received';
        $msg = $e->getMessage();
        $stmt = $conn->prepare("UPDATE whatsapp_inbox SET status = ?, error = ? WHERE id = ?");
        $stmt->bind_param("ssi", $status, $msg, $row['id']);
        $stmt->execute();
        $stmt->close();
        if ($failed) {
            try {
                wa_send_text($row['from_number'], 'மன்னிக்கவும், இந்த போஸ்டரை படிக்க முடியவில்லை. இணையதள நிர்வாக பக்கத்தில் நேரடியாக சேர்க்கவும்.');
            } catch (Throwable $ignored) {
            }
        }
    }
}

function inbox_process(mysqli $conn, array $row) {
    list($bytes, $mime) = wa_download_media($row['media_id']);
    $hash = hash('sha256', $bytes);

    $existing = activity_find_by_hash($conn, $hash);
    if ($existing) {
        wa_send_text($row['from_number'], 'இந்த போஸ்டர் ஏற்கனவே பெறப்பட்டது.');
        return $existing;
    }

    $ext = ['image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? 'jpg';
    $image_url = 'images/uploads/wa_' . substr($hash, 0, 16) . '.' . $ext;
    if (!is_dir(__DIR__ . '/images/uploads')) {
        mkdir(__DIR__ . '/images/uploads', 0755, true);
    }
    file_put_contents(__DIR__ . '/' . $image_url, $bytes);

    $reader_copy = inbox_shrink_for_reader(__DIR__ . '/' . $image_url);
    try {
        $fields = poster_read($reader_copy, activity_types($conn), activity_places($conn), $row['caption'] ?? '');
    } finally {
        if ($reader_copy !== __DIR__ . '/' . $image_url) {
            unlink($reader_copy);
        }
    }

    if (empty($fields['is_activity_poster'])) {
        unlink(__DIR__ . '/' . $image_url);
        wa_send_text($row['from_number'], 'இது செயல்பாட்டு போஸ்டர் போல் தெரியவில்லை, அதனால் சேர்க்கப்படவில்லை.');
        return null;
    }

    $activity_id = activity_create_pending($conn, $fields, $image_url, $hash, $row['from_number']);
    $summary = activity_summary(activity_get($conn, $activity_id));

    $sent = 0;
    foreach (wa_config()['approvers'] as $approver) {
        try {
            $wamid = wa_send_review($approver, $summary);
            if ($wamid) {
                $stmt = $conn->prepare("INSERT INTO whatsapp_review_messages (wamid, activity_id, approver) VALUES (?, ?, ?)");
                $stmt->bind_param("sis", $wamid, $activity_id, $approver);
                $stmt->execute();
                $stmt->close();
                $sent++;
            }
        } catch (Throwable $e) {
            error_log('hinduupm review to ' . $approver . ': ' . $e->getMessage());
        }
    }

    if (!wa_is_approver($row['from_number'])) {
        wa_send_text($row['from_number'], $sent
            ? 'போஸ்டர் பெறப்பட்டது. ஒப்புதலுக்குப் பிறகு இணையதளத்தில் வெளியிடப்படும்.'
            : 'போஸ்டர் பெறப்பட்டது. நிர்வாகிகள் இணையதளத்தில் சரிபார்த்து வெளியிடுவார்கள்.');
    }
    return $activity_id;
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
?>
