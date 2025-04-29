<?php
// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $medication_name = $_POST['medication_name'];
    $date_prescribed = $_POST['date_prescribed'];

    // Insert medication data into database
    $sql = "INSERT INTO user_medications (user_id, medication_name, date_prescribed)
            VALUES ('$user_id', '$medication_name', '$date_prescribed')";

    if ($conn->query($sql) === TRUE) {
        echo "Medication added successfully. <a href='view_appointment.php?id=$user_id'>View Appointment</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
