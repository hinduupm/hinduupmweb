<?php
include 'db_connection.php'; 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $place = $_POST['place'];
    $description = $_POST['description'];
    $activity_date = $_POST['activity_date'];
    $location = $_POST['location'];

    // Handle image upload
    $target_dir = "images/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO spiritual_activities (activity_type_id, activity_place_id, location, description, image_url, activity_date, created_at) 
                VALUES ('$type', '$place', '$location', '$description', '$target_file', '$activity_date', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Activity uploaded successfully!";
            header("Location: addActivity.php?message=success");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location: addActivity.php?message=error&details=" . urlencode($conn->error));
            exit;
        }
    } else {
        echo "Error uploading image.";
        header("Location: addActivity.php?message=upload_error");
    }
}

$conn->close();
?>
