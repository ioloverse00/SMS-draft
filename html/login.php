<?php
// filepath: c:\xampp\htdocs\SMS - Ong\login.php
session_start();
require_once 'db_connection.php'; // Include your database connection file

// Hardcoded credentials for super admin
$super_admin_user_id = "superadmin";
$super_admin_password = "superadmin123"; // Plain text password for super admin
$super_admin_role = "Super Admin";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Check if the user is the super admin
    if ($user_id === $super_admin_user_id && $password === $super_admin_password) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $super_admin_role;
        header("Location: index.php");
        exit();
    }

    // Query the database for the user
    $stmt = $conn->prepare("SELECT user_id, password_hash, role FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            switch ($user['role']) {
                case 'Admin':
                    header("Location: index.php");
                    break;
                case 'Teacher':
                    header("Location: tc-dashboard.php");
                    break;
                case 'Parent':
                    header("Location: p-dashboard.php");
                    break;
                default:
                    header("Location: login.php?error=invalid_role");
                    break;
            }
            exit();
        } else {
            header("Location: login.php?error=invalid_password");
            exit();
        }
    } else {
        header("Location: login.php?error=user_not_found");
        exit();
    }
}
?>