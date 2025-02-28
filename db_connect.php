<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "Hari@2004";      // Change if needed
$dbname = "smartvillage"; // Change to your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
