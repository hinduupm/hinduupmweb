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
];
