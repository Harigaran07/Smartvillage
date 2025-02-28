<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $work = $_POST['work'];
    $family_members = $_POST['family_members'];
    $status = 'pending'; // Default status

    // Check if email already exists
    $check_query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already exists!";
        header("Location: manage_users.php");
        exit();
    }
    $stmt->close();

    // Insert new user
    $query = "INSERT INTO users (fullname, email, password, role, address, mobile, work, family_members, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssis", $fullname, $email, $password, $role, $address, $mobile, $work, $family_members, $status);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add user.";
    }

    $stmt->close();
    $conn->close();
    header("Location: manage_users.php");
    exit();
}
?>
