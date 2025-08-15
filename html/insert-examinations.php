<?php
include 'dashboard-data.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: auth-login-basic.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_code = $_POST['subject_code'] ?? null;
    $recorded_by = $_SESSION['user_id'];

    if ($subject_code && isset($_POST['examinations'])) {
        foreach ($_POST['examinations'] as $student_id => $examScores) {
            foreach ($examScores as $examType => $score) {
                if ($score !== null && $score !== '') {
                    $task_type = $examType === 'midterm' ? 'Midterm Examination' : 'Final Examination';

                    // Check if the score already exists and is the same
                    $checkQuery = "SELECT score FROM activities_performance_tasks 
                                   WHERE student_id = ? AND subject_code = ? AND term = '1st' AND task_type = ?";
                    $checkStmt = $conn->prepare($checkQuery);
                    $checkStmt->bind_param("sss", $student_id, $subject_code, $task_type);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    $existingScore = null;
                    if ($checkResult && $checkResult->num_rows > 0) {
                        $row = $checkResult->fetch_assoc();
                        $existingScore = $row['score'];
                    }

                    // Only proceed if the score is new or has changed
                    if ($existingScore === null || $existingScore != $score) {
                        // Insert or update examination score
                        $query = "INSERT INTO activities_performance_tasks (student_id, subject_code, term, task_type, score, recorded_by, created_at)
                                  VALUES (?, ?, '1st', ?, ?, ?, NOW())
                                  ON DUPLICATE KEY UPDATE score = VALUES(score), recorded_by = VALUES(recorded_by), created_at = NOW()";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("sssds", $student_id, $subject_code, $task_type, $score, $recorded_by);

                        if ($stmt->execute()) {
                            // Fetch student's name and parent's ID
                            $studentQuery = "
                                SELECT students.parent_id, students.first_name, students.last_name, subjects.subject_name
                                FROM students
                                JOIN subjects ON subjects.subject_code = ?
                                WHERE students.student_id = ?
                            ";
                            $studentStmt = $conn->prepare($studentQuery);
                            $studentStmt->bind_param("ss", $subject_code, $student_id);
                            $studentStmt->execute();
                            $studentResult = $studentStmt->get_result();

                            if ($studentResult && $studentResult->num_rows > 0) {
                                $studentRow = $studentResult->fetch_assoc();
                                $parentId = $studentRow['parent_id'];
                                $studentName = $studentRow['first_name'] . ' ' . $studentRow['last_name'];
                                $subjectName = $studentRow['subject_name'];

                                // Insert notification for the parent
                                $notificationMessage = "Your child, $studentName, got $score in the $task_type for $subjectName.";
                                $notificationQuery = "
                                    INSERT INTO notifications (parent_id, student_id, message, is_read, created_at, type)
                                    VALUES (?, ?, ?, 0, NOW(), 'Examination')
                                ";
                                $notificationStmt = $conn->prepare($notificationQuery);
                                $notificationStmt->bind_param("sss", $parentId, $student_id, $notificationMessage);
                                $notificationStmt->execute();
                            }
                        } else {
                            echo "Error inserting data for Student ID: $student_id, Exam Type: $examType. Error: " . $stmt->error;
                        }
                    }
                }
            }
        }
        // Redirect back to the referring page
        echo "<script>
                alert('Examination data processed successfully.');
                window.location.href = document.referrer;
              </script>";
    } else {
        echo "<script>
                alert('Subject code and at least one examination score are required.');
                window.location.href = document.referrer;
              </script>";
    }
}
?>