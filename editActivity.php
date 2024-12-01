<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch activity details
    $sql = "SELECT * FROM spiritual_activities WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_assoc();

    if (!$activity) {
        echo "Activity not found!";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $activity_date = $_POST['activity_date'];
    $activity_type_id = intval($_POST['activity_type']);
    $activity_place_id = intval($_POST['activity_place']);
    $location = $_POST['location'];
    $description = $_POST['description'];

  
    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $target_file = $_POST['existing_image'];
    }

    // Update activity
    $sql = "UPDATE spiritual_activities SET description = ?, activity_type_id = ?, activity_place_id = ?, activity_date = ?, location = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisssi", $description, $activity_type_id, $activity_place_id, $activity_date, $location, $target_file, $id);

    if ($stmt->execute()) {
    header("Location: viewactivities.php?message=success");
    } else {
    header("Location: viewactivities.php?message=error");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Spiritual Activity</h1>
        <form action="editActivity.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $activity['id']; ?>">
             <div class="mb-3">
                <label for="activity_date" class="form-label">Date</label>
                <input type="date" class="form-control" id="activity_date" name="activity_date" value="<?= $activity['activity_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="activity_type" class="form-label">Activity Type</label>
                <select class="form-select" id="activity_type" name="activity_type" required>
                    <?php
                    $types = $conn->query("SELECT id, type_name FROM activity_types");
                    while ($type = $types->fetch_assoc()):
                    ?>
                        <option value="<?= $type['id']; ?>" <?= $type['id'] == $activity['activity_type_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($type['type_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="activity_place" class="form-label">Place</label>
                <select class="form-select" id="activity_place" name="activity_place" required>
                  <?php
                    $placesList = $conn->query("SELECT place_id, place_name FROM activity_place");
                    while ($place = $placesList->fetch_assoc()):
                    ?>
                        <option value="<?= $place['place_id']; ?>" <?= $place['place_id'] == $activity['activity_place_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($place['place_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($activity['location']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($activity['description']); ?></textarea>
            </div>
            
           
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($activity['image_url']); ?>">
                <?php if (!empty($activity['image_url'])): ?>
                    <img src="<?= htmlspecialchars($activity['image_url']); ?>" alt="Current Image" style="width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>