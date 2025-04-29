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

// Get the appointment ID from the URL
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
} else {
    echo "Appointment ID is missing.";
    exit();
}

// Fetch appointment details from the database
$sql = "SELECT * FROM appointments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id); // 'i' means integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
} else {
    echo "<p>No appointment found with the provided ID.</p>";
    exit();
}

// Fetch user medications (if any)
$medications_sql = "SELECT * FROM user_medications WHERE user_id = ?";
$medications_stmt = $conn->prepare($medications_sql);
$medications_stmt->bind_param("i", $appointment_id);
$medications_stmt->execute();
$medications_result = $medications_stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="page.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        b {
            font-weight: bold;
        }

        .medications-details {
            margin-top: 30px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
            color: #4CAF50;
            text-decoration: none;
        }

        .back-link:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

<nav>
      <H4>MENTOR care</H4>
      <div class="header">
          <div class="logo-container">
             <img src="logoo.jpg" class="logo" alt="MENTOR CARE logo"  height="50px">
          </div>
             
      
      <ul class="navbar">
      
       <li><a href="home.html">Home</a></li>
        <li><a href="register.html">Register/login</a></li>
        <li><a href="about us.html">Appointment</a></li>
       
        <li><a href="service.html"> services</a></li>
        <li><a href="blog.html"> Blogs</a></li>
        <li><a href="contact.html">Contact us</a></li>
		     <li><a href="FAQ.html">FAQ</a></li>
         <li><a href="about.html"> About us</a></li>
</ul>
</div>
 </nav>
<br><br><br>
<div class="container">
    <h2>Your Appointment Details</h2>
    
    <p><b>Name:</b> <?php echo htmlspecialchars($appointment['name']); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($appointment['email']); ?></p>
    <p><b>Phone:</b> <?php echo htmlspecialchars($appointment['phone']); ?></p>
    <p><b>Appointment Date:</b> <?php echo htmlspecialchars($appointment['appointmentDate']); ?></p>
    <p><b>Appointment Time:</b> <?php echo htmlspecialchars($appointment['appointmentTime']); ?></p>
    <p><b>Notes:</b> <?php echo nl2br(htmlspecialchars($appointment['note'])); ?></p>

    <div class="medications-details">
        <?php if ($medications_result->num_rows > 0): ?>
            <h3>Previous Medications</h3>
            <?php while ($medication = $medications_result->fetch_assoc()): ?>
                <p><b>Medication:</b> <?php echo htmlspecialchars($medication['medication_name']); ?></p>
                <p><b>Date Prescribed:</b> <?php echo htmlspecialchars($medication['date_prescribed']); ?></p>
                <br>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No previous medications found.</p>
        <?php endif; ?>
    </div>

    <a href="about us.html" class="back-link">Go Back to Appointment Form</a>
</div>

</body>
</html>
