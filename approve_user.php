<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE users SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User approved successfully!";
    } else {
        $_SESSION['error'] = "Failed to approve user.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: manage_users.php");
exit();
?>
