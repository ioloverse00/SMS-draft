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

    if ($subject_code && isset($_POST['activities'])) {
        foreach ($_POST['activities'] as $student_id => $weeks) {
            foreach ($weeks as $week => $score) {
                if ($score !== null && $score !== '') { // Only insert if a score is provided
                    // Check if the score for this week already exists and is the same
                    $checkQuery = "SELECT score FROM activities_performance_tasks 
                                   WHERE student_id = ? AND subject_code = ? AND term = '1st' AND week = ? AND task_type = 'Activity'";
                    $checkStmt = $conn->prepare($checkQuery);
                    $checkStmt->bind_param("ssi", $student_id, $subject_code, $week);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    $existingScore = null;
                    if ($checkResult && $checkResult->num_rows > 0) {
                        $row = $checkResult->fetch_assoc();
                        $existingScore = $row['score'];
                    }

                    // Only proceed if the score is new or has changed
                    if ($existingScore === null || $existingScore != $score) {
                        // Insert or update activity score
                        $query = "INSERT INTO activities_performance_tasks (student_id, subject_code, term, week, task_type, score, recorded_by, created_at)
                                  VALUES (?, ?, '1st', ?, 'Activity', ?, ?, NOW())
                                  ON DUPLICATE KEY UPDATE score = VALUES(score), recorded_by = VALUES(recorded_by), created_at = NOW()";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssids", $student_id, $subject_code, $week, $score, $recorded_by);

                        if ($stmt->execute()) {
                            // Fetch student's name and parent's ID
                            $studentQuery = "
                                SELECT students.parent_id, students.first_name, students.last_name, subjects.subject_name
                                FROM students
                                JOIN subjects ON subjects.subject_code = '$subject_code'
                                WHERE students.student_id = '$student_id'
                            ";
                            $studentResult = $conn->query($studentQuery);

                            if ($studentResult && $studentResult->num_rows > 0) {
                                $studentRow = $studentResult->fetch_assoc();
                                $parentId = $studentRow['parent_id'];
                                $studentName = $studentRow['first_name'] . ' ' . $studentRow['last_name'];
                                $subjectName = $studentRow['subject_name'];

                                // Insert notification for the parent
                                $notificationMessage = "Your child, $studentName, got a grade of $score for Activity no. $week in $subjectName.";
                                $notificationQuery = "
                                    INSERT INTO notifications (parent_id, student_id, message, is_read, created_at, type)
                                    VALUES ('$parentId', '$student_id', '$notificationMessage', 0, NOW(), 'Activity')
                                ";
                                $conn->query($notificationQuery);
                            }
                        } else {
                            echo "Error inserting data for Student ID: $student_id, Week: $week. Error: " . $stmt->error;
                        }
                    }
                }
            }
        }
        // Redirect back to the referring page
        echo "<script>
                alert('Activity data processed successfully.');
                window.location.href = document.referrer;
              </script>";
    } else {
        echo "<script>
                alert('Subject code and at least one activity score are required.');
                window.location.href = document.referrer;
              </script>";
    }
}
?>
