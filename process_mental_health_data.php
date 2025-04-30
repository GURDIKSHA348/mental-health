<?php
// Database connection details
$servername = "localhost"; // your database server
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "mental_health_tracker"; // your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$user_id = $_POST['user_id'];
$date = $_POST['date'];
$water = $_POST['water'];
$stress_level = $_POST['stress_level'];
$exercis = $_POST['exercise'];
$blood = $_POST['blood'];
$comments = $_POST['comments'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO mental_health_data (user_id, date, water, stress_level, exercise, blood, comments) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiiss", $user_id, $date, $water, $stress_level, $exercis, $blood, $comments);

// Execute the query and check if the data was inserted
if ($stmt->execute()) {
    echo "Data saved successfully!";
    echo "<br><a href='trackerr.html'>Go back to the form</a>";
} else 
    echo "Error: " . $stmt->error;


// Close the statement and connection
$stmt->close();
$conn->close();
?>
