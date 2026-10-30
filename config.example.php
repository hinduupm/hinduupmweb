<?php
// Copy this file to ../hinduupm_config.php (one level ABOVE public_html, so it
// is never served or committed) and fill in the real values.
// For local MAMP development you can instead copy it to config.local.php in
// this folder; that name is ignored by git.
//
// To create admin_password_hash, run once: php -r 'echo password_hash("your-password", PASSWORD_DEFAULT);'
// or temporarily upload a page that echoes password_hash(...) and delete it straight after.
return [
    'db' => [
        'host'     => '127.0.0.1',
        'port'     => 3306,          // 8889 on local MAMP
        'username' => '',
        'password' => '',
        'name'     => '',
    ],
    'admin' => [
        'username'      => '',
        'password_hash' => '',
    ],

    // Public address of the site, used in links sent over WhatsApp.
    'site_url' => 'https://hinduupm.org',

    // WhatsApp Business Cloud API (developers.facebook.com > your app > WhatsApp > API Setup).
    'whatsapp' => [
        'phone_number_id' => '',
        'access_token'    => '',   // permanent System User token
        'app_secret'      => '',   // App settings > Basic > App secret, used to verify webhook calls
        'verify_token'    => '',   // any random string; enter the same one in the webhook setup
        'graph_version'   => 'v24.0',
        // Numbers in international format without "+", e.g. 919876543210.
        'approvers'       => [],   // may publish posters
        'submitters'      => [],   // may forward posters (approvers are always allowed)
        // Optional approved template used to reach an approver who has not
        // messaged the bot in the last 24 hours. Its body takes one parameter:
        // the poster summary.
        'review_template' => '',
        'template_language' => 'ta',
    ],

    // Claude API key from platform.claude.com, used to read the posters.
    'anthropic' => [
        'api_key' => '',
        'model'   => 'claude-opus-5-5',
        'effort'  => 'low',
    ],
];
