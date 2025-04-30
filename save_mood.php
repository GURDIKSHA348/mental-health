<?php
// Database credentials
$host = "localhost";
$dbname = "mental_health_tracker";
$username = "root";
$password = "";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$mood = $_POST['mood'];
$notes = $_POST['notes'];
$log_date = date('Y-m-d'); // Current date

// Insert into database
$sql = "INSERT INTO mood_logs (mood, log_date, notes) VALUES ('$mood', '$log_date', '$notes')";
if ($conn->query($sql) === TRUE) {
    echo "Mood log saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
