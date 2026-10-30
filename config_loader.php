<?php
// Loads site configuration from a file kept out of the public repository.
// Lookup order: HINDUUPM_CONFIG env var, ../hinduupm_config.php (outside
// public_html), then config.local.php next to this file (local development).
function hinduupm_config() {
    static $config = null;
    if ($config !== null) {
        return $config;
    }

    $candidates = array_filter([
        getenv('HINDUUPM_CONFIG') ?: null,
        dirname(__DIR__) . '/hinduupm_config.php',
        __DIR__ . '/config.local.php',
    ]);

    foreach ($candidates as $path) {
        if (is_readable($path)) {
            $config = require $path;
            return $config;
        }
    }

    error_log('hinduupm: no config file found; see config.example.php');
    http_response_code(500);
    exit('Site configuration is missing.');
}
?>
