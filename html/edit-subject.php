<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $description = $_POST['description'];

    $query = "UPDATE subjects SET subject_name = ? WHERE subject_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $description, $code);

    if ($stmt->execute()) {
        // Insert activity log entry
        $activity_type = "Subject Updated";
        $log_description = "The subject with code ($code) has been updated to ($description).";
        $badge_color = "bg-label-warning";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        $_SESSION['toast'] = ['message' => 'Subject updated successfully!'];
    } else {
        $_SESSION['toast'] = ['message' => 'Failed to update subject.'];
    }

    $stmt->close();
    $conn->close();

    header("Location: abm-subjects.php");
    exit();
}
?>