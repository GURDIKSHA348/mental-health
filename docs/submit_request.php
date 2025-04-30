<?php
// Database connection
$servername = "localhost";  // Change if your DB server is different
$username = "root";         // Change to your DB username
$password = "";             // Change to your DB password
$dbname = "emergency_requests";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user_name = $_POST['user_name'];
$location = $_POST['location'];
$mental_health_issue = $_POST['mental_health_issue'];
$contact_number = $_POST['contact_number'];

// Prepare SQL statement to insert the request into the database
$sql = "INSERT INTO requests (user_name, location, mental_health_issue, contact_number)
        VALUES ('$user_name', '$location', '$mental_health_issue', '$contact_number')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Emergency request submitted successfully. Ambulance will be dispatched shortly.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
