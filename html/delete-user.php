<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['id'];

    // Delete user from the database
    $query = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $user_id);

    if ($stmt->execute()) {
        // Insert activity log entry
        $activity_type = "User Deleted";
        $log_description = "The user with ID ($user_id) has been deleted.";
        $badge_color = "bg-label-danger";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        $_SESSION['toast'] = ['message' => 'User account deleted successfully.', 'type' => 'success'];
    } else {
        $_SESSION['toast'] = ['message' => 'Failed to delete user account.', 'type' => 'danger'];
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>