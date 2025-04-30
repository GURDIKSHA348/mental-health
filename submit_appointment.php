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

// Insert appointment data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $note = $_POST['note'];

    // SQL to insert appointment into the database
    $sql = "INSERT INTO appointments (name, email, phone, appointmentDate, appointmentTime, note) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $appointmentDate, $appointmentTime, $note);

    if ($stmt->execute()) {
        // Get the inserted appointment ID
        $appointment_id = $stmt->insert_id;
        
        // Redirect to appointment_detail.php with the appointment ID in the URL
        header("Location: http://localhost/komal/appointment_details.php?id=" . $appointment_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="time"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Appointment Form</h2>
    <form action="submit_appointment.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="appointmentDate">Appointment Date:</label>
        <input type="date" id="appointmentDate" name="appointmentDate" required>

        <label for="appointmentTime">Appointment Time:</label>
        <input type="time" id="appointmentTime" name="appointmentTime" required>

        <label for="note">Notes:</label>
        <textarea id="note" name="note"></textarea>

        <button type="submit">Submit Appointment</button>
    </form>
</div>

</body>
</html>
