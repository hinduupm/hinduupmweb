<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Activity</title>
    <style>
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
        color: #333;
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #007BFF;
        outline: none;
    }

    .upload-section {
        margin-top: 20px;
    }

    .btn-submit {
        background: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    .btn-submit:hover {
        background: #0056b3;
    }

    .message {
        text-align: center;
        font-size: 16px;
        color: green;
        margin-top: 10px;
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
    <div class="form-container">
    
    <h1>Upload Activity</h1>
    <form action="upload_activity.php" method="POST" enctype="multipart/form-data">


    <label for="type">Activity Type:</label>
    <select name="type" id="type" required>
        <?php while ($row = $activityList->fetch_assoc()): ?>
            <option value="<?= $row['id']; ?>"><?= $row['type_name']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="place">Activity Place:</label>
    <select name="place" id="place" required>
        <?php while ($row = $placesList->fetch_assoc()): ?>
            <option value="<?= $row['place_id']; ?>"><?= $row['place_name']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

        <!-- <label for="type">Activity Type:</label>
        <select name="type" id="type" required>
        <option value="Hospital_Annadhanam">Hospital_Annadhanam</option>
        <option value="Auto_Sticker">Auto_Sticker</option>
        <option value="Temple_Painting">Temple_Painting</option>      
        <option value="Temple_Annadhanam">Temple_Annadhanam</option>
        <option value="Wall_Painting">Wall_Painting</option>
        </select><br><br> -->

        <label for="location">Location Details :</label>
        <input type="text" name="location" id="location" required><br><br>

        
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea><br><br>
        
        <label for="date">Date:</label>
        <input type="date" name="activity_date" id="date" required><br><br>
        
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*" ><br><br>
        
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
     </div>
</body>
</html>
