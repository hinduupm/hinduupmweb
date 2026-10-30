<?php
// Shared helpers for activities that arrive as WhatsApp posters.

function activity_types(mysqli $conn) {
    return $conn->query("SELECT id, type_name, description FROM activity_types ORDER BY id")->fetch_all(MYSQLI_ASSOC);
}

function activity_places(mysqli $conn) {
    return $conn->query("SELECT place_id, place_name FROM activity_place ORDER BY place_name")->fetch_all(MYSQLI_ASSOC);
}

function activity_get(mysqli $conn, $id) {
    $stmt = $conn->prepare(
        "SELECT a.*, t.type_name, p.place_name
         FROM spiritual_activities a
         LEFT JOIN activity_types t ON a.activity_type_id = t.id
         LEFT JOIN activity_place p ON p.place_id = a.activity_place_id
         WHERE a.id = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row;
}

function activity_find_by_hash(mysqli $conn, $hash) {
    $stmt = $conn->prepare("SELECT id FROM spiritual_activities WHERE image_hash = ?");
    $stmt->bind_param("s", $hash);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ? (int) $row['id'] : null;
}

// $fields comes from the poster reader; ids of 0 mean "not matched".
function activity_create_pending(mysqli $conn, array $fields, $image_url, $image_hash, $submitted_by) {
    $type_id  = !empty($fields['activity_type_id']) ? (int) $fields['activity_type_id'] : null;
    $place_id = !empty($fields['place_id']) ? (int) $fields['place_id'] : null;
    $date     = !empty($fields['activity_date']) ? $fields['activity_date'] : null;
    $new_place = $place_id ? null : (trim($fields['new_place_name'] ?? '') ?: null);

    $stmt = $conn->prepare(
        "INSERT INTO spiritual_activities
         (activity_type_id, activity_place_id, location, description, image_url, activity_date, created_at,
          status, source, title, district, new_place_name, image_hash, submitted_by, reader_notes)
         VALUES (?, ?, ?, ?, ?, ?, NOW(), 'pending', 'whatsapp', ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "iissssssssss",
        $type_id, $place_id, $fields['location'], $fields['description'], $image_url, $date,
        $fields['title'], $fields['district'], $new_place, $image_hash, $submitted_by, $fields['notes']
    );
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

// Returns null on success, or a short reason why the activity can't be published yet.
function activity_publish(mysqli $conn, $id, $reviewer) {
    $activity = activity_get($conn, $id);
    if (!$activity || $activity['status'] !== 'pending') {
        return 'already handled';
    }
    if (empty($activity['activity_type_id'])) {
        return 'activity type is missing';
    }
    if (empty($activity['activity_date'])) {
        return 'date is missing';
    }

    $place_id = $activity['activity_place_id'];
    if (empty($place_id)) {
        if (empty($activity['new_place_name'])) {
            return 'district is missing';
        }
        $place_id = activity_place_id_for($conn, $activity['new_place_name']);
    }

    $stmt = $conn->prepare(
        "UPDATE spiritual_activities
         SET status = 'published', activity_place_id = ?, new_place_name = NULL, reviewed_by = ?, reviewed_at = NOW()
         WHERE id = ? AND status = 'pending'"
    );
    $stmt->bind_param("isi", $place_id, $reviewer, $id);
    $stmt->execute();
    $stmt->close();
    return null;
}

function activity_reject(mysqli $conn, $id, $reviewer) {
    $stmt = $conn->prepare(
        "UPDATE spiritual_activities SET status = 'rejected', reviewed_by = ?, reviewed_at = NOW()
         WHERE id = ? AND status = 'pending'"
    );
    $stmt->bind_param("si", $reviewer, $id);
    $stmt->execute();
    $changed = $stmt->affected_rows > 0;
    $stmt->close();
    return $changed;
}

// Finds a place by name, adding it when it is new.
function activity_place_id_for(mysqli $conn, $name) {
    $stmt = $conn->prepare("SELECT place_id FROM activity_place WHERE place_name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($row) {
        return (int) $row['place_id'];
    }

    $stmt = $conn->prepare("INSERT INTO activity_place (place_name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

// One-message summary used in WhatsApp replies.
function activity_summary(array $activity) {
    $place = $activity['place_name'] ?: (($activity['new_place_name'] ?? '') ? $activity['new_place_name'] . ' (புதியது)' : '?');
    $lines = [
        $activity['title'] ?: ($activity['type_name'] ?: 'செயல்பாடு'),
        'வகை: ' . ($activity['type_name'] ?: '?'),
        'மாவட்டம்: ' . ($activity['district'] ?: '?') . ' → ' . $place,
        'இடம்: ' . ($activity['location'] ?: '?'),
        'நாள்: ' . ($activity['activity_date'] ? date('d-m-Y', strtotime($activity['activity_date'])) : '?'),
    ];
    if (!empty($activity['reader_notes'])) {
        $lines[] = 'குறிப்பு: ' . $activity['reader_notes'];
    }
    return implode("\n", $lines);
}
?>
