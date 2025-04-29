<?php
include 'db_connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $appointment_date = $_POST['appointment_date'];

    // Prepare an SQL query to insert the appointment
    $sql = "INSERT INTO appointments (patient_name, email, appointment_date)
            VALUES ('$patient_name', '$email', '$appointment_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
