<?php
// Start session if not already started
session_start();

// Database connection
require_once 'db_connection.php';

// Function to validate and sanitize input
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize required fields
    $first_name = isset($_POST['first_name']) ? sanitize_input($_POST['first_name']) : '';
    $middle_name = isset($_POST['middle_name']) ? sanitize_input($_POST['middle_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_input($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $role = isset($_POST['role']) ? sanitize_input($_POST['role']) : '';
    
    // Optional fields
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : null;
    $address = isset($_POST['address']) ? sanitize_input($_POST['address']) : null;
    $gender = isset($_POST['gender']) && !empty($_POST['gender']) ? sanitize_input($_POST['gender']) : null;
    $birthdate = isset($_POST['birthdate']) && !empty($_POST['birthdate']) ? sanitize_input($_POST['birthdate']) : null;

    // Validation
    $errors = array();

    // Check required fields
    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($role) || !in_array($role, ['Admin', 'Teacher', 'Parent'])) {
        $errors[] = "Valid role is required";
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $errors[] = "Email already exists. Please use a different email.";
    }
    $stmt->close();

    // If no errors, proceed with user creation
    if (empty($errors)) {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the SQL statement
        $sql = "INSERT INTO users (first_name, middle_name, last_name, email, phone, address, gender, birthdate, role, password_hash) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $email, $phone, $address, $gender, $birthdate, $role, $password_hash);
        
        // Execute the statement
        if ($stmt->execute()) {
            // User created successfully
            $_SESSION['success_message'] = "User account created successfully!";
            // No need to query again, since the trigger automatically sets the user_id
            // Just get the last inserted user_id directly
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $_SESSION['success_message'] .= " User ID: " . $row['user_id'];
            }
        } else {
            // Error occurred
            $_SESSION['error_message'] = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        // Store errors in session
        $_SESSION['error_message'] = implode("<br>", $errors);
    }
    
    // Redirect based on role
    switch($role) {
        case 'Teacher':
        case 'Parent':
        case 'Admin':
            // Redirect back to the referring page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            break;
        default:
            // Redirect to the referring page for invalid roles
            header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    exit();
} else {
    // If not a POST request, redirect to the referring page
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>