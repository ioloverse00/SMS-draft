<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section_name = $_POST['section_name'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete the section from the database
        $deleteSectionQuery = "DELETE FROM sections WHERE section_name = ?";
        $stmt = $conn->prepare($deleteSectionQuery);
        $stmt->bind_param("s", $section_name);
        $stmt->execute();

        // Insert activity log entry
        $activity_type = "Section Deleted";
        $log_description = "The section ($section_name) has been deleted.";
        $badge_color = "bg-label-danger";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        // Commit the transaction
        $conn->commit();

        $_SESSION['toast'] = ['message' => 'Section removed successfully!', 'type' => 'success'];
        echo json_encode(['success' => true]);
    } catch (mysqli_sql_exception $exception) {
        // Rollback the transaction on error
        $conn->rollback();
        $_SESSION['toast'] = ['message' => 'Failed to remove section.', 'type' => 'danger'];
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>