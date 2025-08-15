<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update user information in the database
    $query = "UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, password_hash = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $first_name, $middle_name, $last_name, $password, $user_id);

    if ($stmt->execute()) {
        // Insert activity log entry
        $activity_type = "User Updated";
        $log_description = "The user with ID ($user_id) has been updated.";
        $badge_color = "bg-label-warning";
        $log_stmt = $conn->prepare("INSERT INTO activity_log (activity_type, description, badge_color) VALUES (?, ?, ?)");
        $log_stmt->bind_param("sss", $activity_type, $log_description, $badge_color);
        $log_stmt->execute();
        $log_stmt->close();

        $_SESSION['toast'] = ['message' => 'User account updated successfully.'];
    } else {
        $_SESSION['toast'] = ['message' => 'Failed to update user account.'];
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>