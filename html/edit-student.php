<?php
// filepath: c:\xampp\htdocs\SMS - Ong\sneat-1.0.0\html\edit-student.php

// Start session
session_start();

// Include database connection
include 'db_connection.php';

// Check if the form is submitted and required fields are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
    // Get the form data
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $full_name = $conn->real_escape_string($_POST['editStudentName']);
    $gender = $conn->real_escape_string($_POST['editStudentGender']);
    $birthdate = $conn->real_escape_string($_POST['editStudentBirthdate']);
    $address = $conn->real_escape_string($_POST['editStudentAddress']);
    $section_id = $conn->real_escape_string($_POST['editStudentSection']);
    $parent_id = $conn->real_escape_string($_POST['editStudentParent']);

    // Split the full name into first, middle, and last names
    $name_parts = explode(' ', $full_name);
    $first_name = $name_parts[0];
    $middle_name = isset($name_parts[1]) ? $name_parts[1] : '';
    $last_name = isset($name_parts[2]) ? $name_parts[2] : '';

    // Start transaction to ensure data consistency
    $conn->begin_transaction();
    
    try {
        // Prepare the UPDATE query for student details
        $query = "
            UPDATE students 
            SET 
                first_name = '$first_name',
                middle_name = '$middle_name',
                last_name = '$last_name',
                gender = '$gender',
                birthdate = '$birthdate',
                address = '$address',
                section_id = '$section_id',
                parent_id = '$parent_id'
            WHERE student_id = '$student_id'
        ";

        // Execute the query
        $conn->query($query);
        
        // Handle subject enrollments
        
        // First, delete all existing subject enrollments for this student
        $delete_query = "DELETE FROM student_subjects WHERE student_id = '$student_id'";
        $conn->query($delete_query);
        
        // Get the selected core subjects
        $core_subjects = isset($_POST['coreSubjects']) ? $_POST['coreSubjects'] : array();
        
        // Get the selected specialized subjects
        $specialized_subjects = isset($_POST['specializedSubjects']) ? $_POST['specializedSubjects'] : array();
        
        // Combine all selected subjects
        $all_subjects = array_merge($core_subjects, $specialized_subjects);
        
        // Insert the selected subjects
        if (!empty($all_subjects)) {
            $insert_values = array();
            
            foreach ($all_subjects as $subject_code) {
                $subject_code = $conn->real_escape_string($subject_code);
                $insert_values[] = "('$student_id', '$subject_code')";
            }
            
            if (!empty($insert_values)) {
                $insert_query = "INSERT INTO student_subjects (student_id, subject_code) VALUES " . implode(", ", $insert_values);
                $conn->query($insert_query);
            }
        }
        
        // Commit the transaction
        $conn->commit();
        
        // Redirect back with a success message
        $_SESSION['success_message'] = "Student information and subject enrollments updated successfully.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        
        // Redirect back with an error message
        $_SESSION['error_message'] = "Error updating student information: " . $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // Redirect back if the request is invalid
    $_SESSION['error_message'] = "Invalid request.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Close the database connection
$conn->close();
?>