<?php
$servername = "localhost";  // Change this if you're using a different host
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "your_database_name";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
