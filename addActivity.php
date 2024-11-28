<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Activity</title>
</head>
<body>
    <h2>Upload Activity</h2>
    <form action="upload_activity.php" method="POST" enctype="multipart/form-data">

        <label for="type">Activity Type:</label>
        <select name="type" id="type" required>
        <option value="Hospital_Annadhanam">Hospital_Annadhanam</option>
        <option value="Auto_Sticker">Auto_Sticker</option>
        <option value="Temple_Painting">Temple_Painting</option>      
        <option value="Temple_Annadhanam">Temple_Annadhanam</option>
        <option value="Wall_Painting">Wall_Painting</option>
        </select><br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea><br><br>
        
        <label for="date">Date:</label>
        <input type="date" name="activity_date" id="date" required><br><br>
        
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>
        
        <button type="submit">Submit</button>
    </form>

     <!-- Display message -->
    <?php if (isset($_GET['message'])): ?>
        <div style="color: <?= ($_GET['message'] === 'success') ? 'green' : 'red'; ?>">
            <?php
            if ($_GET['message'] === 'success') {
                echo "Activity uploaded successfully!";
            } elseif ($_GET['message'] === 'error') {
                echo "Error adding activity: " . htmlspecialchars($_GET['details']);
            } elseif ($_GET['message'] === 'upload_error') {
                echo "Error uploading the image.";
            }
            ?>
        </div>
    <?php endif; ?>
</body>
</html>
