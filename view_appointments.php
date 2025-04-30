<?php
// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$appointment_id = $_GET['id']; // Get the appointment ID from the URL

// Fetch appointment details
$sql = "SELECT * FROM appointments WHERE id = $appointment_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
    echo "<h2>Your Appointment Details</h2>";
    echo "Name: " . $appointment['name'] . "<br>";
    echo "Email: " . $appointment['email'] . "<br>";
    echo "Phone: " . $appointment['phone'] . "<br>";
    echo "Appointment Date: " . $appointment['appointmentDate'] . "<br>";
    echo "Appointment Time: " . $appointment['appointmentTime'] . "<br>";
    echo "Notes: " . $appointment['note'] . "<br>";

    // Fetch user medications
    $user_id = $appointment['id'];
    $medications_sql = "SELECT * FROM user_medications WHERE user_id = $user_id";
    $medications_result = $conn->query($medications_sql);

    if ($medications_result->num_rows > 0) {
        echo "<h3>Previous Medications</h3>";
        while ($medication = $medications_result->fetch_assoc()) {
            echo "Medication: " . $medication['medication_name'] . "<br>";
            echo "Date Prescribed: " . $medication['date_prescribed'] . "<br><br>";
        }
    } else {
        echo "<p>No previous medications found.</p>";
    }
} else {
    echo "No appointment found.";
}

$conn->close();
?>
