<?php
// filepath: c:\xampp\htdocs\SMS - Ong\sneat-1.0.0\html\edit-teacher.php

session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    // Prepare and execute the update query
    $query = "UPDATE users 
              SET first_name = ?, middle_name = ?, last_name = ?, phone = ?, address = ?, gender = ?, birthdate = ? 
              WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $first_name, $middle_name, $last_name, $phone, $address, $gender, $birthdate, $user_id);

    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['toast'] = [
            'message' => 'Teacher information updated successfully!',
            'type' => 'success'
        ];
    } else {
        // Set error message in session
        $_SESSION['toast'] = [
            'message' => 'Failed to update teacher information. Please try again.',
            'type' => 'error'
        ];
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the teachers_info.php page
    header("Location: teachers_info.php");
    exit();
} else {
    // Redirect if accessed directly
    header("Location: teachers_info.php");
    exit();
}
?>