<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Activities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'fetch_activities.php'; // Your PHP file to retrieve and display data ?>
    </div>
</body>
</html>
