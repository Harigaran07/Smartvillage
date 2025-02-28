<?php
session_start();
include 'db_connect.php'; // Include your database connection

$email = $_POST['email'];
$password = $_POST['password'];

// Check in Admin Table
$adminQuery = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$adminQuery->bind_param("s", $email);
$adminQuery->execute();
$adminResult = $adminQuery->get_result();

if ($adminResult->num_rows > 0) {
    $admin = $adminResult->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['fullname'];
        header("Location: admin_dashboard.php");
        exit();
    }
}

// Check in User Table
$userQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
$userQuery->bind_param("s", $email);
$userQuery->execute();
$userResult = $userQuery->get_result();

if ($userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        header("Location: user_dashboard.php");
        exit();
    }
}

// If no match found
header("Location: login.php?error=Invalid credentials");
exit();
?>
