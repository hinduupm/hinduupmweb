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
    <nav class="navbar navbar-dark" style="background: linear-gradient(315deg,#bdd4e7,#8693ab);">
        <span class="navbar-brand mb-0 h1 ms-3">Hindu UPM — Admin</span>
        <div class="ms-auto me-3">
            <a href="viewactivities.php" class="btn btn-light btn-sm me-2">View Activities</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add New Spiritual Activity</h1>
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
                <div class="input-group">
                    <select class="form-select" name="place" id="place" required>
                        <?php while ($row = $placesList->fetch_assoc()): ?>
                            <option value="<?= $row['place_id']; ?>"><?= $row['place_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addPlaceModal" title="Add New Location">
                        + Add New
                    </button>
                </div>
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
                <a href="viewactivities.php" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>

    <!-- Add New Location Modal -->
    <div class="modal fade" id="addPlaceModal" tabindex="-1" aria-labelledby="addPlaceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlaceModalLabel">Add New Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_place_name" class="form-label">Place Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new_place_name" placeholder="e.g. New Jersey">
                    </div>
                    <div class="mb-3">
                        <label for="new_sabai" class="form-label">Sabai</label>
                        <input type="text" class="form-control" id="new_sabai" placeholder="e.g. USA">
                    </div>
                    <div id="place_modal_msg"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="savePlaceBtn">Save Location</button>
                </div>
            </div>
        </div>
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
        document.getElementById('savePlaceBtn').addEventListener('click', function () {
            const placeName = document.getElementById('new_place_name').value.trim();
            const sabai = document.getElementById('new_sabai').value.trim();
            const msgDiv = document.getElementById('place_modal_msg');

            if (!placeName) {
                msgDiv.innerHTML = '<p class="text-danger">Place name is required.</p>';
                return;
            }

            const btn = this;
            btn.disabled = true;
            btn.textContent = 'Saving...';

            const formData = new FormData();
            formData.append('place_name', placeName);
            formData.append('sabai', sabai);

            fetch('add_place.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const select = document.getElementById('place');
                        const option = new Option(data.place_name + (data.sabai ? ' (' + data.sabai + ')' : ''), data.place_id, true, true);
                        select.add(option);
                        bootstrap.Modal.getInstance(document.getElementById('addPlaceModal')).hide();
                        document.getElementById('new_place_name').value = '';
                        document.getElementById('new_sabai').value = '';
                        msgDiv.innerHTML = '';
                    } else {
                        msgDiv.innerHTML = '<p class="text-danger">' + data.message + '</p>';
                    }
                })
                .catch(() => {
                    msgDiv.innerHTML = '<p class="text-danger">Failed to save. Please try again.</p>';
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = 'Save Location';
                });
        });

        // Reset modal fields when closed
        document.getElementById('addPlaceModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('new_place_name').value = '';
            document.getElementById('new_sabai').value = '';
            document.getElementById('place_modal_msg').innerHTML = '';
        });

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

