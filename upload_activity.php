<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: addActivity.php");
    exit;
}

include 'db_connection.php';

$type          = intval($_POST['type']);
$place         = intval($_POST['place']);
$description   = trim($_POST['description']);
$activity_date = trim($_POST['activity_date']);
$location      = trim($_POST['location']);
$image_url     = '';

// Handle optional image upload
if (!empty($_FILES['image']['name'])) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo   = finfo_open(FILEINFO_MIME_TYPE);
    $mime    = finfo_file($finfo, $_FILES['image']['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowed)) {
        header("Location: addActivity.php?message=upload_error");
        exit;
    }

    $ext         = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename    = uniqid('act_', true) . '.' . $ext;
    $target_dir  = "images/uploads/";
    $target_file = $target_dir . $filename;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        header("Location: addActivity.php?message=upload_error");
        exit;
    }
    $image_url = $target_file;
}

$stmt = $conn->prepare(
    "INSERT INTO spiritual_activities
     (activity_type_id, activity_place_id, location, description, image_url, activity_date, created_at)
     VALUES (?, ?, ?, ?, ?, ?, NOW())"
);
$stmt->bind_param("iissss", $type, $place, $location, $description, $image_url, $activity_date);

if ($stmt->execute()) {
    header("Location: viewactivities.php?message=success");
} else {
    header("Location: addActivity.php?message=error");
}
$stmt->close();
$conn->close();
?>
