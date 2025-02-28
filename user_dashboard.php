<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Welcome, User!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <hr>
        <h4>User Panel</h4>
        <ul>
            <li><a href="report_issue.php">Report an Issue</a></li>
            <li><a href="view_announcements.php">View Announcements</a></li>
        </ul>
    </div>
</body>
</html>
