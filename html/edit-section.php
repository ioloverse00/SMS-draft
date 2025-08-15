<?php
session_start();
include 'db_connection.php';

$original_section_name = $_POST['original_section_name'];
$section_name = $_POST['section_name'];
$grade_level = $_POST['grade_level'];
$room = $_POST['room'];
$schedule = $_POST['schedule'];
$adviser_id = $_POST['adviser_id'];

// Update the section in the database
$query = "UPDATE sections SET section_name = ?, grade_level = ?, room = ?, schedule = ?, adviser_id = ? WHERE section_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssss', $section_name, $grade_level, $room, $schedule, $adviser_id, $original_section_name);

if ($stmt->execute()) {
    // Fetch the updated adviser name
    $adviserQuery = "SELECT CONCAT(first_name, ' ', last_name) AS adviser_name FROM users WHERE user_id = ?";
    $adviserStmt = $conn->prepare($adviserQuery);
    $adviserStmt->bind_param('s', $adviser_id);
    $adviserStmt->execute();
    $adviserResult = $adviserStmt->get_result();
    $adviserName = $adviserResult->fetch_assoc()['adviser_name'];

    // Insert activity log entry
    $activity_type = "Section Updated";
    $log_description = "The section ($original_section_name) has been updated to ($section_name) for grade level $grade_level.";
    $badge_color = "bg-label-warning";
    $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
    $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
    $log_stmt->execute();
    $log_stmt->close();

    $_SESSION['toast'] = ['message' => 'Section updated successfully.'];
    echo json_encode(['success' => true, 'adviser_name' => $adviserName]);
} else {
    $_SESSION['toast'] = ['message' => 'Failed to update section.'];
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>