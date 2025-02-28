<?php
include 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user) {
        // Generate unique token
        $token = bin2hex(random_bytes(50));

        // Store token in database
        $insert = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $insert->execute([$email, $token]);

        // Send reset email (for now, just display the reset link)
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        echo "<p>Reset your password: <a href='$reset_link'>$reset_link</a></p>";
    } else {
        echo "<p>Email not found!</p>";
    }
}
?>
