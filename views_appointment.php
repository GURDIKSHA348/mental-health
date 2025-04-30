<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $appointment_date = $_POST['appointment_date'];
    $notes = $_POST['notes'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital_management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into database
    $sql = "INSERT INTO appointments (patient_name, email, phone, doctor, appointment_date, notes) 
            VALUES ('$patient_name', '$email', '$phone', '$doctor', '$appointment_date', '$notes')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>