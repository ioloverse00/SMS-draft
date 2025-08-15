<?php
// Start session
session_start();

// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['addStudentName'];
    $gender = $_POST['addStudentGender'];
    $birthdate = $_POST['addStudentBirthdate'];
    $address = $_POST['addStudentAddress'];
    $section = $_POST['addStudentSection'];
    $parentId = $_POST['addStudentParent'];
    $gradeLevel = $_POST['grade_level'];

    // Split full name into first, middle, and last name
    $nameParts = explode(' ', $fullName);
    $firstName = $nameParts[0];
    $middleName = isset($nameParts[1]) ? $nameParts[1] : '';
    $lastName = isset($nameParts[2]) ? $nameParts[2] : '';

    // Fetch the strand_id associated with the selected section_id
    $strandQuery = "SELECT strand FROM sections WHERE section_id = ?";
    $strandStmt = $conn->prepare($strandQuery);
    $strandStmt->bind_param('s', $section);
    $strandStmt->execute();
    $strandResult = $strandStmt->get_result();

    if ($strandResult->num_rows > 0) {
        $strandRow = $strandResult->fetch_assoc();
        $strandId = $strandRow['strand'];
    } else {
        // Handle case where no strand is found for the section
        $_SESSION['error'] = "Invalid section selected. No strand found.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Insert student data into the database
    $query = "INSERT INTO students (first_name, middle_name, last_name, gender, birthdate, address, section_id, parent_id, grade_level, strand, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssssss', $firstName, $middleName, $lastName, $gender, $birthdate, $address, $section, $parentId, $gradeLevel, $strandId);

    if ($stmt->execute()) {
        // Redirect back to the students page with a success message
        $_SESSION['success'] = "Student added successfully!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Redirect back with an error message
        $_SESSION['error'] = "Failed to add student. Please try again.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // Close the statement and connection
    $stmt->close();
    $strandStmt->close();
    $conn->close();
} else {
    // Redirect back if the request method is not POST
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>