<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section_name = $_POST['section_name'];
    $grade_level = $_POST['grade_level'];
    $room = $_POST['room'];
    $schedule = $_POST['schedule'];
    $adviser_id = $_POST['adviser_id'];
    $strand = $_POST['strand'];

    // Find the maximum existing section_id and increment it by one
    $maxIdQuery = "SELECT MAX(section_id) AS max_id FROM sections";
    $maxIdResult = $conn->query($maxIdQuery);
    $maxIdRow = $maxIdResult->fetch_assoc();
    $new_section_id = $maxIdRow['max_id'] + 1;

    $query = "INSERT INTO sections (section_id, section_name, grade_level, room, schedule, adviser_id, strand) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $new_section_id, $section_name, $grade_level, $room, $schedule, $adviser_id, $strand);

    if ($stmt->execute()) {
        // Insert activity log entry
        $activity_type = "New Section Added";
        $description = "A new section ($section_name) has been added to $strand $grade_level.";
        $badge_color = "bg-label-success";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        $_SESSION['toast'] = [
            'message' => 'Section added successfully!',
            'type' => 'success'
        ];
    } else {
        $_SESSION['toast'] = [
            'message' => 'Failed to add section.',
            'type' => 'danger'
        ];
    }

    $stmt->close();
    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
