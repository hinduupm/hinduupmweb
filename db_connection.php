<?php
// Database connection. Credentials live in the private config file,
// see config.example.php.
require_once __DIR__ . '/config_loader.php';

$db = hinduupm_config()['db'];

try {
    $conn = new mysqli($db['host'], $db['username'], $db['password'], $db['name'], (int) $db['port']);
} catch (mysqli_sql_exception $e) {
    $conn = null;
    $error = $e->getMessage();
}

// Check connection
if (!$conn || $conn->connect_error) {
    error_log('hinduupm: database connection failed: ' . ($conn ? $conn->connect_error : $error));
    http_response_code(500);
    die("Database connection failed.");
}

$conn->set_charset('utf8mb4');
?>
