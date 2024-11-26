<?php
include 'db_connection.php'; // Include your database connection file

// Query to fetch all activities, ordered by date (newest first)
$query = "SELECT * FROM spiritual_activities ORDER BY activity_date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Loop through each activity and display it
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>"; // Activity title
        echo "<p>" . htmlspecialchars($row['description']) . "</p>"; // Activity description

        // Display image if it exists
        if (!empty($row['image_url'])) {
            echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' style='max-width: 100%; height: auto;' />";
        }

        echo "<p><small>Date: " . htmlspecialchars($row['activity_date']) . "</small></p>"; // Activity date
        echo "</div>";
    }
} else {
    echo "<p>No activities found.</p>";
}

$conn->close(); // Close the database connection
?>
