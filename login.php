<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, check the password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Login successful, redirect to the dashboard
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.html");
        } else {
            // Invalid password
            header("Location: login.html?error=Incorrect password.");
        }
    } else {
        // No account found with the email
        header("Location: login.html?error=No account found with that email.");
    }
}
?>
