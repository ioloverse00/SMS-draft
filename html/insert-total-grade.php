<?php
// filepath: c:\xampp\htdocs\SMS - Ong\sneat-1.0.0\html\insert-total-grade.php
include 'dashboard-data.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: auth-login-basic.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? null;
    $subject_code = $_POST['subject_code'] ?? null;
    $term = $_POST['term'] ?? null;
    $total_grade = $_POST['total_grade'] ?? null;

    if ($student_id && $subject_code && $term && $total_grade !== null) {
        // Insert or update the total grade
        $query = "INSERT INTO grades (student_id, subject_code, grade, term, created_at)
                  VALUES (?, ?, ?, ?, NOW())
                  ON DUPLICATE KEY UPDATE grade = VALUES(grade), created_at = NOW()";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssds", $student_id, $subject_code, $total_grade, $term);

        if ($stmt->execute()) {
            echo "<script>
            alert('Activity data processed successfully.');
            window.location.href = document.referrer;
          </script>";
        } else {
            echo "Error inserting total grade: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
}
?>