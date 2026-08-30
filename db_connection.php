<?php
// Database connection
// Local (MAMP): host=127.0.0.1, port=8889
// Production (cPanel): host=127.0.0.1, port=3306
$servername = "127.0.0.1";
$port = 8889; // Change to 3306 on production cPanel
$username = "u276642767_hinduupm";
$password = "Srisarguru@2026";
$dbname = "u276642767_hinduupm_db";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>