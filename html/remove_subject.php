<?php
include 'db_connection.php';

$enrollmentId = $_GET['enrollment_id'];
$query = "DELETE FROM enrollments WHERE enrollment_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $enrollmentId);

if ($stmt->execute()) {
    echo "Subject removed successfully.";
} else {
    echo "Failed to remove subject.";
}
?>