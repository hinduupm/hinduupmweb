<?php
// Reads an activity poster with Claude and returns the fields for a pending activity.
// Uses the HTTP API directly because the cPanel deploy only copies top-level PHP
// files, so a Composer vendor folder would not reach the server.
require_once __DIR__ . '/config_loader.php';

function poster_read($image_path, array $types, array $places, $caption = '') {
    $cfg = hinduupm_config()['anthropic'];

    $type_lines = array_map(function ($t) {
        return $t['id'] . ': ' . $t['type_name'] . ($t['description'] ? ' (' . $t['description'] . ')' : '');
    }, $types);
    $place_lines = array_map(function ($p) {
        return $p['place_id'] . ': ' . $p['place_name'];
    }, $places);

    $prompt = "This is a poster from Hindu UPM (இந்து ஒருங்கிணைப்பு மேம்பாட்டு இயக்கம்) reporting a spiritual activity. "
        . "It usually has a title banner, photos, and a box with மாவட்டம் (district, sometimes with a village after a dash), "
        . "இடம் (temple or place) and நாள் (date, day-month-year).\n\n"
        . "Read the poster and fill in the fields:\n"
        . "- is_activity_poster: false if this is not such a poster.\n"
        . "- title: the banner title exactly as written in Tamil.\n"
        . "- activity_type_id: the best match from the activity types below, or 0 if none fits. "
        . "Annadhanam at temples is Temple Annadhanam, at hospitals Hospital Annadhanam.\n"
        . "- district: the மாவட்டம் line exactly as written in Tamil.\n"
        . "- place_id: the activity place below that is the same district, or 0 if none is.\n"
        . "- new_place_name: when place_id is 0, the district's usual English name (for example Ranipet), else empty.\n"
        . "- location: the இடம் line in Tamil, followed by ', ' and the village from the district line if there is one.\n"
        . "- activity_date: the date as YYYY-MM-DD, or empty if unreadable.\n"
        . "- description: one or two plain Tamil sentences describing what was done, where and when, based only on the poster.\n"
        . "- notes: anything you were unsure about, in Tamil, or empty.\n\n"
        . "Activity types:\n" . implode("\n", $type_lines) . "\n\n"
        . "Activity places:\n" . implode("\n", $place_lines);
    if (trim($caption) !== '') {
        $prompt .= "\n\nThe person who sent the poster added this note; where it corrects the poster, follow the note:\n" . $caption;
    }

    $schema = [
        'type' => 'object',
        'properties' => [
            'is_activity_poster' => ['type' => 'boolean'],
            'title'              => ['type' => 'string'],
            'activity_type_id'   => ['type' => 'integer'],
            'district'           => ['type' => 'string'],
            'place_id'           => ['type' => 'integer'],
            'new_place_name'     => ['type' => 'string'],
            'location'           => ['type' => 'string'],
            'activity_date'      => ['type' => 'string'],
            'description'        => ['type' => 'string'],
            'notes'              => ['type' => 'string'],
        ],
        'required' => ['is_activity_poster', 'title', 'activity_type_id', 'district', 'place_id',
                       'new_place_name', 'location', 'activity_date', 'description', 'notes'],
        'additionalProperties' => false,
    ];

    $request = [
        'model'         => $cfg['model'] ?? 'claude-opus-5-5',
        'max_tokens'    => 16000,
        'output_config' => [
            'effort' => $cfg['effort'] ?? 'low',
            'format' => ['type' => 'json_schema', 'schema' => $schema],
        ],
        'messages' => [[
            'role'    => 'user',
            'content' => [
                [
                    'type'   => 'image',
                    'source' => [
                        'type'       => 'base64',
                        'media_type' => poster_media_type($image_path),
                        'data'       => base64_encode(file_get_contents($image_path)),
                    ],
                ],
                ['type' => 'text', 'text' => $prompt],
            ],
        ]],
    ];

    $headers = [
        'content-type: application/json',
        'x-api-key: ' . $cfg['api_key'],
        'anthropic-version: 2026-10-21',
    ];
    // Retry a safety decline on another model; Haiku has no server-side fallback.
    if (strpos($request['model'], 'haiku') === false) {
        $request['fallbacks'] = 'default';
        $headers[] = 'anthropic-beta: server-side-fallback-2026-07-01';
    }

    $ch = curl_init(($cfg['base_url'] ?? 'https://api.anthropic.com') . '/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 300,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_POSTFIELDS     => json_encode($request),
    ]);
    $body   = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error  = curl_error($ch);
    curl_close($ch);

    if ($body === false) {
        throw new RuntimeException('Claude API request failed: ' . $error);
    }
    $response = json_decode($body, true);
    if ($status !== 200) {
        throw new RuntimeException('Claude API returned ' . $status . ': ' . ($response['error']['message'] ?? $body));
    }
    if (($response['stop_reason'] ?? '') === 'refusal') {
        throw new RuntimeException('Claude declined to read this poster');
    }
    if (($response['stop_reason'] ?? '') === 'max_tokens') {
        throw new RuntimeException('Claude response was cut off');
    }

    $text = '';
    foreach ($response['content'] as $block) {
        if ($block['type'] === 'text') {
            $text .= $block['text'];
        }
    }
    $fields = json_decode($text, true);
    if (!is_array($fields)) {
        throw new RuntimeException('Claude returned unreadable output');
    }

    // Keep only ids that really exist, and a well-formed date.
    $type_ids  = array_map('intval', array_column($types, 'id'));
    $place_ids = array_map('intval', array_column($places, 'place_id'));
    if (!in_array((int) $fields['activity_type_id'], $type_ids, true)) {
        $fields['activity_type_id'] = 0;
    }
    if (!in_array((int) $fields['place_id'], $place_ids, true)) {
        $fields['place_id'] = 0;
    }
    $date = DateTime::createFromFormat('!Y-m-d', $fields['activity_date']);
    if (!$date || $date->format('Y-m-d') !== $fields['activity_date']) {
        $fields['activity_date'] = '';
    }

    return $fields;
}

function poster_media_type($path) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $path);
    finfo_close($finfo);
    return $mime;
}
?>
