<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

// Fetch all activities

$sql = "SELECT a.id, a.activity_date,  t.type_name AS activity_type, p.place_name, a.location,  a.description,  a.image_url  
        FROM spiritual_activities a
        JOIN activity_types t ON a.activity_type_id = t.id
        JOIN activity_place p ON p.place_id = activity_place_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Spiritual Activities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">View Spiritual Activities</h1>
         <!-- Add Activity Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- <h1 class="text-center">View Activities</h1> -->
            <a href="addActivity.php" class="btn btn-primary">Add Activity</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Activity Type</th>  
                    <th>Place</th>
                    <th>Location</th>
                    <th>Description</th>                                     
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['activity_date']); ?></td>
                            <td><?= htmlspecialchars($row['activity_type']); ?></td>
                            <td><?= htmlspecialchars($row['place_name']); ?></td>
                            <td><?= htmlspecialchars($row['location']); ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                                                        
                            <td>
                                <?php if (!empty($row['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($row['image_url']); ?>" alt="Activity Image" style="width: 100px;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="editActivity.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="deleteActivity.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No activities found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
                    modalBody.innerHTML = '<p class="text-success">Activity Updated successfully!</p>';
                } else if (message === 'error') {
                    modalBody.innerHTML = '<p class="text-danger">Error updating activity.</p>';
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
