<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Query the database to fetch the data
$sql = "SELECT username, email, phone, symptoms FROM registrations"; // Replace 'registrations' with your actual table name
$result = $conn->query($sql);

// Step 3: Display the total number of records
$total_query = "SELECT COUNT(*) AS total FROM registrations";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
echo "<h2>Total Registrations: " . $total_row['total'] . "</h2>";

// Step 4: Display the data in an HTML table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Symptoms</th>
            </tr>";
    
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['username'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['symptoms'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
