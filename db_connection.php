<?php
// Database connection
$servername = "localhost"; // Replace if your hosting specifies a different host
$username = "hinduupm"; // Replace with your database username
$password = "Srisarguru@2024"; // Replace with your database password
$dbname = "hinduupm"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
