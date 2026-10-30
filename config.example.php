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

    // Public address of the site, used in links in the review emails.
    'site_url' => 'https://hinduupm.org',

    // Mailbox that receives the posters. Volunteers send posters to
    // poster_address; only mail sent to that address is read.
    'mail' => [
        'username'       => 'hinduupm.updates@gmail.com',
        'app_password'   => '',   // Google Account > Security > App passwords
        'poster_address' => 'hinduupm.updates@gmail.com',
        'imap_host'      => 'ssl://imap.gmail.com',
        'imap_port'      => 993,
        'smtp_host'      => 'ssl://smtp.gmail.com',
        'smtp_port'      => 465,
        'approvers'      => [],   // email addresses that review and publish posters
        'submitters'     => [],   // addresses that may send posters (approvers always may)
    ],

    // Claude API key from platform.claude.com, used to read the posters.
    'anthropic' => [
        'api_key' => '',
        'model'   => 'claude-opus-5-5',   // or 'claude-haiku-5-5', much cheaper
        'effort'  => 'low',
    ],
];
