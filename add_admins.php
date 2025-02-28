<?php
include 'db_connect.php'; // Ensure this file connects to your MySQL database

$admins = [
    ['fullname' => 'SRIKRISHANAN', 'email' => 'rsrikrishanan5@gmail.com', 'password' => 'Sri@2005'],
    ['fullname' => 'SABARINATHAN', 'email' => 'sabarielumalai434@gmail.com', 'password' => 'Sabari@2007']
];

foreach ($admins as $admin) {
    $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admin (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $admin['fullname'], $admin['email'], $hashedPassword);
    
    if ($stmt->execute()) {
        echo "Admin " . $admin['fullname'] . " added successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
