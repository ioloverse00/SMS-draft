<?php
// filepath: c:\xampp\htdocs\SMS - Ong\db_connection.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
?>