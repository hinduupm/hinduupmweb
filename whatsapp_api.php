<?php
// Minimal WhatsApp Business Cloud API client.
require_once __DIR__ . '/config_loader.php';

function wa_config() {
    return hinduupm_config()['whatsapp'];
}

function wa_is_approver($number) {
    return in_array($number, wa_config()['approvers'], true);
}

function wa_is_submitter($number) {
    return wa_is_approver($number) || in_array($number, wa_config()['submitters'], true);
}

// Checks the X-Hub-Signature-256 header Meta sends with every webhook call.
function wa_signature_valid($raw_body, $header) {
    $secret = wa_config()['app_secret'];
    if (!$secret || !$header || strpos($header, 'sha256=') !== 0) {
        return false;
    }
    return hash_equals('sha256=' . hash_hmac('sha256', $raw_body, $secret), $header);
}

function wa_graph($method, $path, $payload = null, $raw = false) {
    $cfg = wa_config();
    $url = preg_match('#^https?://#', $path) ? $path : ($cfg['graph_base_url'] ?? 'https://graph.facebook.com') . '/' . $cfg['graph_version'] . '/' . $path;

    $ch = curl_init($url);
    $headers = ['Authorization: Bearer ' . $cfg['access_token']];
    if ($payload !== null) {
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    }
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_HTTPHEADER     => $headers,
    ]);
    $body   = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($raw) {
        if ($body === false || $status !== 200) {
            throw new RuntimeException('WhatsApp media download failed (' . $status . ')');
        }
        return $body;
    }
    $data = json_decode((string) $body, true) ?: [];
    if ($status >= 300) {
        $err = $data['error'] ?? [];
        throw new WhatsAppError($err['message'] ?? ('HTTP ' . $status), (int) ($err['code'] ?? 0));
    }
    return $data;
}

class WhatsAppError extends RuntimeException {}

// Returns the sent message's id.
function wa_send_text($to, $text) {
    $data = wa_graph('POST', wa_config()['phone_number_id'] . '/messages', [
        'messaging_product' => 'whatsapp',
        'to'                => $to,
        'type'              => 'text',
        'text'              => ['body' => $text, 'preview_url' => true],
    ]);
    return $data['messages'][0]['id'] ?? null;
}

// Sends free text, or the review template when the 24-hour window is closed.
function wa_send_review($to, $summary) {
    $cfg = wa_config();
    try {
        return wa_send_text($to, $summary . "\n\nவெளியிட 1, திருத்த 2, நிராகரிக்க 3 என்று பதில் அனுப்பவும்.");
    } catch (WhatsAppError $e) {
        // 131047: more than 24 hours since this person last messaged the bot.
        if ($e->getCode() !== 131047 || empty($cfg['review_template'])) {
            throw $e;
        }
    }
    $data = wa_graph('POST', $cfg['phone_number_id'] . '/messages', [
        'messaging_product' => 'whatsapp',
        'to'                => $to,
        'type'              => 'template',
        'template'          => [
            'name'       => $cfg['review_template'],
            'language'   => ['code' => $cfg['template_language']],
            'components' => [[
                'type'       => 'body',
                'parameters' => [['type' => 'text', 'text' => str_replace("\n", ' | ', $summary)]],
            ]],
        ],
    ]);
    return $data['messages'][0]['id'] ?? null;
}

function wa_download_media($media_id) {
    $meta = wa_graph('GET', $media_id);
    return [wa_graph('GET', $meta['url'], null, true), $meta['mime_type'] ?? ''];
}
?>
