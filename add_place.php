<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

include 'db_connection.php';

$place_name = trim($_POST['place_name'] ?? '');
$sabai      = trim($_POST['sabai'] ?? '');

if ($place_name === '') {
    echo json_encode(['success' => false, 'message' => 'Place name is required']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO activity_place (place_name, sabai) VALUES (?, ?)");
$stmt->bind_param("ss", $place_name, $sabai);

if ($stmt->execute()) {
    echo json_encode([
        'success'    => true,
        'place_id'   => $conn->insert_id,
        'place_name' => $place_name,
        'sabai'      => $sabai,
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}
