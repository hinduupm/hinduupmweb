<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Activity</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 50%;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
        }

        h1 {
            text-align: center;
            color: blue;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <?php
    include 'db_connection.php'; 

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $activityList = $conn->query("SELECT id, type_name FROM activity_types");
    $placesList = $conn->query("SELECT place_id, place_name FROM activity_place");
    ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Update Spiritual Activity</h1>
        <form action="upload_activity.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="type">Activity Type:</label>
            <select class="form-select" name="type" id="type" required>
                <?php while ($row = $activityList->fetch_assoc()): ?>
                    <option value="<?= $row['id']; ?>"><?= $row['type_name']; ?></option>
                <?php endwhile; ?>
            </select>
            </div>
            <div class="mb-3">
                <label for="place">Activity Place:</label>
                <select class="form-select" name="place" id="place" required>
                    <?php while ($row = $placesList->fetch_assoc()): ?>
                        <option value="<?= $row['place_id']; ?>"><?= $row['place_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="location">Location Details :</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>
            
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
            </div>

            <div class="mb-3"> 
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="activity_date" id="date" required>
            </div>

            <div class="mb-3">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Message content will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check if a message exists in the URL parameters
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);
            if (params.has('message')) {
                const message = params.get('message');
                const modalBody = document.querySelector('#messageModal .modal-body');
                
                if (message === 'success') {
                    modalBody.innerHTML = '<p class="text-success">Activity uploaded successfully!</p>';
                } else if (message === 'error') {
                    modalBody.innerHTML = '<p class="text-danger">Error adding activity.</p>';
                } else if (message === 'upload_error') {
                    modalBody.innerHTML = '<p class="text-danger">Error uploading the image.</p>';
                }

                // Show the modal
                const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                // Clean up the URL
                history.replaceState(null, '', window.location.pathname);
            }
        });
    </script>
</body>
</html>
