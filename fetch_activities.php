<?php
include 'db_connection.php';

$query = "SELECT a.activity_date, t.type_name AS activity_type, p.place_name,
                 a.location, a.description, a.image_url
          FROM spiritual_activities a
          JOIN activity_types t ON a.activity_type_id = t.id
          JOIN activity_place p ON p.place_id = a.activity_place_id
          ORDER BY a.activity_date DESC LIMIT 10";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date     = htmlspecialchars($row['activity_date']);
        $type     = htmlspecialchars($row['activity_type']);
        $place    = htmlspecialchars($row['place_name']);
        $location = htmlspecialchars($row['location']);
        $desc     = htmlspecialchars($row['description']);
        $img      = htmlspecialchars($row['image_url']);

        echo "<div style='border-left:3px solid #8693ab;padding:8px 12px;margin-bottom:12px;background:#fff;border-radius:4px;'>";
        echo "<div style='font-size:0.8rem;color:#888;'>$date &nbsp;|&nbsp; <strong>$type</strong> &nbsp;|&nbsp; $location, $place</div>";
        if ($desc) {
            echo "<div style='font-size:0.9rem;margin-top:4px;'>$desc</div>";
        }
        if ($img) {
            echo "<img src='$img' alt='' style='max-width:100%;height:auto;margin-top:6px;border-radius:4px;'>";
        }
        echo "</div>";
    }
} else {
    echo "<p style='color:#aaa;font-size:0.9rem;'>No recent activities.</p>";
}

$conn->close();
?>
