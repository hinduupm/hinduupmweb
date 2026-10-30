<?php
// Webhook for the HinduUPM WhatsApp number.
// Posters are queued for process_inbox.php; replies of 1/2/3 from approvers
// publish, edit or reject the poster they answer.
require_once __DIR__ . '/whatsapp_api.php';
require_once __DIR__ . '/activity_lib.php';

// Meta's one-time verification when the webhook URL is registered.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cfg = wa_config();
    if (($_GET['hub_mode'] ?? '') === 'subscribe' && $cfg['verify_token'] !== ''
        && hash_equals($cfg['verify_token'], (string) ($_GET['hub_verify_token'] ?? ''))) {
        echo $_GET['hub_challenge'] ?? '';
    } else {
        http_response_code(403);
    }
    exit;
}

$raw = file_get_contents('php://input');
if (!wa_signature_valid($raw, $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '')) {
    http_response_code(403);
    exit;
}

include 'db_connection.php';

$payload = json_decode($raw, true) ?: [];
foreach ($payload['entry'] ?? [] as $entry) {
    foreach ($entry['changes'] ?? [] as $change) {
        foreach ($change['value']['messages'] ?? [] as $message) {
            try {
                wa_handle_message($conn, $message);
            } catch (Throwable $e) {
                error_log('hinduupm whatsapp: ' . $e->getMessage());
            }
        }
    }
}

http_response_code(200);
echo 'ok';

function wa_handle_message(mysqli $conn, array $message) {
    $from = $message['from'] ?? '';
    if (!wa_is_submitter($from)) {
        wa_send_text($from, 'மன்னிக்கவும், இந்த எண்ணிலிருந்து பதிவுகளை ஏற்க அனுமதி இல்லை.');
        return;
    }

    $type = $message['type'] ?? '';
    // Posters forwarded as photos, or as image files.
    $media = $type === 'image' ? $message['image'] : ($type === 'document' ? $message['document'] : null);
    if ($media && strpos($media['mime_type'] ?? '', 'image/') === 0) {
        $stmt = $conn->prepare(
            "INSERT IGNORE INTO whatsapp_inbox (message_id, from_number, media_id, caption) VALUES (?, ?, ?, ?)"
        );
        $caption = $media['caption'] ?? '';
        $stmt->bind_param("ssss", $message['id'], $from, $media['id'], $caption);
        $stmt->execute();
        $stmt->close();
        return;
    }

    if ($type === 'text') {
        wa_handle_reply($conn, $from, trim($message['text']['body']), $message['context']['id'] ?? null);
    }
}

function wa_handle_reply(mysqli $conn, $from, $text, $context_id) {
    if (!wa_is_approver($from) || !in_array($text, ['1', '2', '3'], true)) {
        wa_send_text($from, 'செயல்பாட்டு போஸ்டரை இந்த எண்ணுக்கு forward செய்யவும்.');
        return;
    }

    // The summary they replied to, or else the latest one sent to them.
    $activity_id = null;
    if ($context_id) {
        $stmt = $conn->prepare("SELECT activity_id FROM whatsapp_review_messages WHERE wamid = ? AND approver = ?");
        $stmt->bind_param("ss", $context_id, $from);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $activity_id = $row ? (int) $row['activity_id'] : null;
    }
    if (!$activity_id) {
        $stmt = $conn->prepare(
            "SELECT r.activity_id FROM whatsapp_review_messages r
             JOIN spiritual_activities a ON a.id = r.activity_id
             WHERE r.approver = ? AND a.status = 'pending'
             ORDER BY r.created_at DESC LIMIT 1"
        );
        $stmt->bind_param("s", $from);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $activity_id = $row ? (int) $row['activity_id'] : null;
    }
    if (!$activity_id) {
        wa_send_text($from, 'ஒப்புதலுக்காக காத்திருக்கும் பதிவு எதுவும் இல்லை.');
        return;
    }

    $activity = activity_get($conn, $activity_id);
    $edit_url = rtrim(hinduupm_config()['site_url'], '/') . '/pendingActivities.php?id=' . $activity_id;

    if ($text === '2') {
        wa_send_text($from, "திருத்தி வெளியிட இங்கே செல்லவும்:\n" . $edit_url);
        return;
    }
    if ($text === '3') {
        $done = activity_reject($conn, $activity_id, 'whatsapp:' . $from);
        wa_send_text($from, $done ? 'நிராகரிக்கப்பட்டது.' : 'இந்த பதிவு ஏற்கனவே கையாளப்பட்டது.');
        return;
    }

    $problem = activity_publish($conn, $activity_id, 'whatsapp:' . $from);
    if ($problem === 'already handled') {
        wa_send_text($from, 'இந்த பதிவு ஏற்கனவே கையாளப்பட்டது.');
    } elseif ($problem) {
        wa_send_text($from, "வெளியிட முடியவில்லை ($problem). இங்கே திருத்தவும்:\n" . $edit_url);
    } else {
        wa_send_text($from, 'இணையதளத்தில் வெளியிடப்பட்டது: ' . rtrim(hinduupm_config()['site_url'], '/'));
        if ($activity['submitted_by'] && $activity['submitted_by'] !== $from) {
            wa_send_text($activity['submitted_by'], 'நீங்கள் அனுப்பிய போஸ்டர் இணையதளத்தில் வெளியிடப்பட்டது. நன்றி!');
        }
    }
}
?>
