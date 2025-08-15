<?php
// filepath: c:\xampp\htdocs\SMS - Ong\sneat-1.0.0\html\delete_student.php

// Start session
session_start();

// Include database connection
include 'db_connection.php';

// Check if the form is submitted and student_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
    // Get the student ID from the POST request
    $student_id = $conn->real_escape_string($_POST['student_id']);

    // Prepare the DELETE query
    $query = "DELETE FROM students WHERE student_id = '$student_id'";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        // Redirect back with a success message
        $_SESSION['success_message'] = "Student removed successfully.";
        header('Location: students_11.php');
        exit();
    } else {
        // Redirect back with an error message
        $_SESSION['error_message'] = "Error removing student: " . $conn->error;
        header('Location: students_11.php');
        exit();
    }
} else {
    // Redirect back if the request is invalid
    $_SESSION['error_message'] = "Invalid request.";
    header('Location: students_11.php');
    exit();
}

// Close the database connection
$conn->close();
?>