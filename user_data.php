<?php
// Include the database connection code
include('db_config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $water = $_POST['water'];
    $date = $_POST['date'];
    $excise = $_POST['excise'];
    $blood = $_POST['blood'];
    $notes = $_POST['notes'];

    // Insert data into the database
    $sql = "INSERT INTO user_data (water, date, excise, blood, notes)
            VALUES ('$water', '$date', '$excise', '$blood', '$notes')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>