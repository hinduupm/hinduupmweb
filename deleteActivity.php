<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

// Check if the `id` parameter is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the activity to get the image path (if any)
    $sql = "SELECT image_url FROM spiritual_activities WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = $row['image_url'];

        // Delete the activity
        $delete_sql = "DELETE FROM spiritual_activities WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);

        if ($delete_stmt->execute()) {
            // Delete the associated image file if it exists
            if (!empty($image_path) && file_exists($image_path)) {
                unlink($image_path); // Deletes the image file
            }

            // Redirect with success message
            header("Location: viewActivities.php?message=Activity deleted successfully!&type=success");
        } else {
            // Redirect with error message
            header("Location: viewActivities.php?message=Error deleting activity!&type=error");
        }
    } else {
        // Redirect if activity not found
        header("Location: viewActivities.php?message=Activity not found!&type=error");
    }
} else {
    // Redirect if no `id` parameter
    header("Location: viewActivities.php?message=Invalid request!&type=error");
}
exit;
?>
