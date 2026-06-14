<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hindu UPM — Add Daily Activity</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body { background: #f5f7fa; }
        .card { border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .card-header { background: linear-gradient(315deg, #bdd4e7 0%, #8693ab 74%); color: #fff; border-radius: 10px 10px 0 0; }
        .activity-card { border-left: 4px solid #8693ab; margin-bottom: 10px; }
        .badge-type { font-size: 0.75rem; }
        img.thumb { width: 80px; height: 60px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php
            include 'db_connection.php';

            $success = $error = '';

            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $date        = $conn->real_escape_string(trim($_POST['activity_date']));
                $type_id     = (int) $_POST['activity_type_id'];
                $place_id    = (int) $_POST['activity_place_id'];
                $location    = $conn->real_escape_string(trim($_POST['location']));
                $description = $conn->real_escape_string(trim($_POST['description']));
                $image_url   = $conn->real_escape_string(trim($_POST['image_url']));

                if ($date && $type_id && $place_id && $location) {
                    $sql = "INSERT INTO spiritual_activities
                            (activity_date, activity_type_id, activity_place_id, location, description, image_url)
                            VALUES ('$date', $type_id, $place_id, '$location', '$description', '$image_url')";
                    if ($conn->query($sql)) {
                        $success = "Activity added successfully!";
                    } else {
                        $error = "Error: " . $conn->error;
                    }
                } else {
                    $error = "Please fill in all required fields (Date, Type, Place, Location).";
                }
            }

            // Load lookup data for dropdowns
            $types  = $conn->query("SELECT id, type_name FROM activity_types ORDER BY type_name");
            $places = $conn->query("SELECT place_id, place_name FROM activity_place ORDER BY place_name");
            ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <!-- ADD ACTIVITY FORM -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Add Daily Activity</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Date <span class="text-danger">*</span></label>
                                <input type="date" name="activity_date" class="form-control"
                                       value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Activity Type <span class="text-danger">*</span></label>
                                <select name="activity_type_id" class="form-control" required>
                                    <option value="">— Select Type —</option>
                                    <?php if ($types && $types->num_rows > 0):
                                        while ($t = $types->fetch_assoc()): ?>
                                        <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['type_name']) ?></option>
                                    <?php endwhile; endif; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Place / District <span class="text-danger">*</span></label>
                                <select name="activity_place_id" class="form-control" required>
                                    <option value="">— Select Place —</option>
                                    <?php if ($places && $places->num_rows > 0):
                                        while ($p = $places->fetch_assoc()): ?>
                                        <option value="<?= $p['place_id'] ?>"><?= htmlspecialchars($p['place_name']) ?></option>
                                    <?php endwhile; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Specific Location (Village / Area) <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control"
                                   placeholder="e.g. Palani Main Road, Nathanellur" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Brief description of the activity…"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image URL <small class="text-muted">(optional — paste a web link or relative path like images/act/photo.jpg)</small></label>
                            <input type="text" name="image_url" class="form-control"
                                   placeholder="https://… or images/activities/photo.jpg">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Save Activity
                        </button>
                    </form>
                </div>
            </div>

            <!-- RECENT ACTIVITIES LIST -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activities (last 20)</h5>
                </div>
                <div class="card-body p-2">
                    <?php
                    $recent = $conn->query(
                        "SELECT a.activity_date, t.type_name, p.place_name, a.location, a.description, a.image_url
                         FROM spiritual_activities a
                         JOIN activity_types t ON a.activity_type_id = t.id
                         JOIN activity_place p ON p.place_id = a.activity_place_id
                         ORDER BY a.activity_date DESC LIMIT 20"
                    );
                    if ($recent && $recent->num_rows > 0):
                        while ($row = $recent->fetch_assoc()): ?>
                    <div class="card activity-card p-2 d-flex flex-row align-items-start">
                        <?php if (!empty($row['image_url'])): ?>
                        <img src="<?= htmlspecialchars($row['image_url']) ?>" class="thumb mr-3" alt="">
                        <?php endif; ?>
                        <div>
                            <strong><?= htmlspecialchars($row['activity_date']) ?></strong>
                            <span class="badge badge-secondary badge-type ml-1"><?= htmlspecialchars($row['type_name']) ?></span><br>
                            <small class="text-muted"><?= htmlspecialchars($row['location']) ?>, <?= htmlspecialchars($row['place_name']) ?></small>
                            <?php if (!empty($row['description'])): ?>
                            <p class="mb-0 mt-1 small"><?= htmlspecialchars($row['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile;
                    else: ?>
                    <p class="text-muted p-3">No activities yet. Add the first one above!</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php $conn->close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
