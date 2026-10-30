<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
}
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

include 'db_connection.php';
require_once __DIR__ . '/activity_lib.php';
require_once __DIR__ . '/mail_client.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(400);
        exit('Invalid form, please reload the page.');
    }
    $id = intval($_POST['id']);
    $reviewer = 'admin:' . $_SESSION['username'];

    if ($_POST['action'] === 'reject') {
        activity_reject($conn, $id, $reviewer);
        $message = 'Rejected.';
    } else {
        $type_id   = intval($_POST['activity_type']) ?: null;
        $place_id  = intval($_POST['activity_place']) ?: null;
        $new_place = $place_id ? null : (trim($_POST['new_place_name']) ?: null);
        $date      = trim($_POST['activity_date']) ?: null;
        $stmt = $conn->prepare(
            "UPDATE spiritual_activities
             SET activity_type_id = ?, activity_place_id = ?, new_place_name = ?, title = ?, location = ?,
                 description = ?, activity_date = ?
             WHERE id = ? AND status = 'pending'"
        );
        $stmt->bind_param("iisssssi", $type_id, $place_id, $new_place, $_POST['title'], $_POST['location'],
                          $_POST['description'], $date, $id);
        $stmt->execute();
        $stmt->close();

        if ($_POST['action'] === 'publish') {
            $problem = activity_publish($conn, $id, $reviewer);
            $message = $problem ? 'Saved, but not published: ' . $problem . '.' : 'Published.';
            // Let the volunteer who sent the poster know it is live.
            $submitter = $problem ? null : activity_get($conn, $id)['submitted_by'];
            if ($submitter && strpos($submitter, '@') !== false) {
                try {
                    mail_send($submitter, 'போஸ்டர் வெளியிடப்பட்டது',
                        'நீங்கள் அனுப்பிய போஸ்டர் இணையதளத்தில் வெளியிடப்பட்டது: ' . hinduupm_config()['site_url'] . "\nநன்றி!");
                } catch (Throwable $e) {
                    error_log('hinduupm mail to ' . $submitter . ': ' . $e->getMessage());
                }
            }
        } else {
            $message = 'Saved.';
        }
    }
}

$types  = activity_types($conn);
$places = activity_places($conn);
$pending = $conn->query("SELECT id FROM spiritual_activities WHERE status = 'pending' ORDER BY created_at")->fetch_all(MYSQLI_ASSOC);
$focus = isset($_GET['id']) ? intval($_GET['id']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Activities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark" style="background: linear-gradient(315deg,#bdd4e7,#8693ab);">
        <span class="navbar-brand mb-0 h1 ms-3">Hindu UPM — Admin</span>
        <div class="ms-auto me-3">
            <a href="viewactivities.php" class="btn btn-light btn-sm me-2">View Activities</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Posters waiting for approval</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if (!$pending): ?>
            <p class="text-center text-muted">Nothing is waiting for approval.</p>
        <?php endif; ?>

        <?php foreach ($pending as $p): $a = activity_get($conn, (int) $p['id']); ?>
            <form method="POST" class="card mb-4 <?= $focus === (int) $a['id'] ? 'border-primary border-3' : ''; ?>" id="activity-<?= $a['id']; ?>">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="<?= htmlspecialchars($a['image_url']); ?>" target="_blank">
                            <img src="<?= htmlspecialchars($a['image_url']); ?>" class="img-fluid rounded-start" alt="Poster">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $a['id']; ?>">
                            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf']; ?>">
                            <p class="small text-muted mb-2">
                                From <?= htmlspecialchars($a['submitted_by'] ?? 'unknown'); ?> on <?= htmlspecialchars($a['created_at']); ?>
                            </p>
                            <?php if ($a['reader_notes']): ?>
                                <div class="alert alert-warning py-1 small"><?= htmlspecialchars($a['reader_notes']); ?></div>
                            <?php endif; ?>
                            <div class="mb-2">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($a['title'] ?? ''); ?>">
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label">Activity Type</label>
                                    <select class="form-select" name="activity_type">
                                        <option value="0">— choose —</option>
                                        <?php foreach ($types as $t): ?>
                                            <option value="<?= $t['id']; ?>" <?= $t['id'] == $a['activity_type_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($t['type_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="activity_date" value="<?= htmlspecialchars($a['activity_date'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label">Place <span class="text-muted small">(poster: <?= htmlspecialchars($a['district'] ?? ''); ?>)</span></label>
                                    <select class="form-select" name="activity_place">
                                        <option value="0">— new place —</option>
                                        <?php foreach ($places as $pl): ?>
                                            <option value="<?= $pl['place_id']; ?>" <?= $pl['place_id'] == $a['activity_place_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($pl['place_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label">New place name</label>
                                    <input type="text" class="form-control" name="new_place_name" value="<?= htmlspecialchars($a['new_place_name'] ?? ''); ?>" placeholder="Only if not in the list">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($a['location'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($a['description'] ?? ''); ?></textarea>
                            </div>
                            <button type="submit" name="action" value="publish" class="btn btn-success">Publish</button>
                            <button type="submit" name="action" value="save" class="btn btn-outline-primary">Save</button>
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger float-end" onclick="return confirm('Reject this poster?');">Reject</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>
