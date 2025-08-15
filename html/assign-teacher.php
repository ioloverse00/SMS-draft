<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $teacher_id = isset($_POST['user_id']) ? $conn->real_escape_string($_POST['user_id']) : '';
    $strand = isset($_POST['strand']) ? $conn->real_escape_string($_POST['strand']) : '';
    $subject = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : '';
    $sections = isset($_POST['sections']) ? $_POST['sections'] : [];
    $schedules = isset($_POST['schedule']) ? $_POST['schedule'] : [];
    
    // Check if essential data is provided
    if (empty($teacher_id) || empty($strand) || empty($subject) || empty($sections)) {
        $_SESSION['toast'] = [
            'type' => 'error', 
            'message' => 'All required fields must be filled out.'
        ];
        header("Location: teachers_info.php");
        exit();
    }

    // Validate teacher_id
    $teacherQuery = "SELECT COUNT(*) AS count FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($teacherQuery);
    $stmt->bind_param("s", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Invalid teacher ID.'
        ];
        header("Location: teachers_info.php");
        exit();
    }
    
    // Validate subject exists
    $subjectQuery = "SELECT COUNT(*) AS count FROM subjects WHERE subject_code = ?";
    $stmt = $conn->prepare($subjectQuery);
    $stmt->bind_param("s", $subject);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['count'] == 0) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Invalid subject code.'
        ];
        header("Location: teachers_info.php");
        exit();
    }

    // Start transaction
    $conn->begin_transaction();
    
    try {
        $success = true;
        $assigned_count = 0;
        $error_messages = [];
        
        foreach ($sections as $section) {
            $section = intval($section); // Ensure section_id is an integer
            $schedule = isset($schedules[$section]) ? $conn->real_escape_string($schedules[$section]) : null;
            
            if (empty($schedule)) {
                $error_messages[] = "Section ID $section requires a schedule.";
                $success = false;
                continue;
            }
            
            // Check if section exists
            $sectionQuery = "SELECT COUNT(*) AS count FROM sections WHERE section_id = ?";
            $stmt = $conn->prepare($sectionQuery);
            $stmt->bind_param("i", $section);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if ($row['count'] == 0) {
                $error_messages[] = "Invalid section ID: $section.";
                $success = false;
                continue;
            }
            
            // Check if assignment already exists
            $checkQuery = "SELECT COUNT(*) AS count FROM section_subject_teacher 
                         WHERE section_id = ? AND subject_code = ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("is", $section, $subject);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if ($row['count'] > 0) {
                // Delete the existing assignment
                $deleteQuery = "DELETE FROM section_subject_teacher 
                              WHERE section_id = ? AND subject_code = ?";
                $stmt = $conn->prepare($deleteQuery);
                $stmt->bind_param("is", $section, $subject);
                
                if (!$stmt->execute()) {
                    $error_messages[] = "Failed to update existing assignment for section: $section.";
                    $success = false;
                    continue;
                }
            }
            
            // Insert new assignment
            $query = "INSERT INTO section_subject_teacher (section_id, subject_code, teacher_id, schedule) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isss", $section, $subject, $teacher_id, $schedule);
            
            if (!$stmt->execute()) {
                $error_messages[] = "Failed to assign teacher to section: $section. Error: " . $conn->error;
                $success = false;
                continue;
            }
            
            $assigned_count++;
        }
        
        if ($success && $assigned_count > 0) {
            $conn->commit();
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => "Teacher assigned successfully to $assigned_count section(s)!"
            ];
        } else {
            $conn->rollback();
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => "Failed to assign teacher. " . implode(" ", $error_messages)
            ];
        }
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'An error occurred: ' . $e->getMessage()
        ];
    }
    
    header("Location: teachers_info.php");
    exit();
}

// If accessed directly without POST data
$_SESSION['toast'] = [
    'type' => 'error',
    'message' => 'Invalid access method.'
];
header("Location: teachers_info.php");
exit();
?>