<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $description = $_POST['description'];
    $strand = $_POST['strand'];
    $subject_type = $_POST['subject_type'];

    $query = "INSERT INTO subjects (subject_code, subject_name, strand, subject_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $code, $description, $strand, $subject_type);

    if ($stmt->execute()) {
        // Insert activity log entry
        $activity_type = "New Subject Added";
        $log_description = "A new subject ($description) has been added to $strand.";
        $badge_color = "bg-label-success";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        $_SESSION['toast'] = ['message' => 'Subject added successfully!', 'type' => 'success'];
    } else {
        $_SESSION['toast'] = ['message' => 'Failed to add subject.', 'type' => 'danger'];
    }

    $stmt->close();
    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
