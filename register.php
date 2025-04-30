<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        // Passwords don't match, redirect with an error
        header("Location: register.html?error=Passwords do not match.");
        exit();
    }

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, redirect with an error
        header("Location: register.html?error=Email already exists.");
        exit();
    } else {
        // Password is hashed before inserting
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $insert_sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($insert_stmt->execute()) {
            // Successfully registered, redirect to login page
            header("Location: login.html");
            exit();
        } else {
            // Registration failed
            header("Location: register.html?error=Registration failed.");
            exit();
        }
    }
}
?>
