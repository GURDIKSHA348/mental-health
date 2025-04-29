<?php
 $background_image= 'content.jpg';
 ?>
 <?php
// Include database connection
include('process_appoitment.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $comments = $_POST['comments'];

    // Prepare SQL query
    $sql = "INSERT INTO appointments (name, email, phone, appointment_date, comments) 
            VALUES ('$name', '$email', '$phone', '$appointment_date', '$comments')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "New appointment booked successfully!";
        echo "<br><a href='view_appointments.php'>View All Appointments</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
}
?>

    

