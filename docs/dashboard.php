<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
   
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Awareness</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .content {
            max-width: 900px;
            margin: 0 auto;
        }
        .logout-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #f44336;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Mental Health Awareness</h1>
    <div class="content">
        <h2>Understanding Mental Health</h2>
        <p>Mental health includes our emotional, psychological, and social well-being. It affects how we think, feel, and act. It also helps determine how we handle stress, relate to others, and make choices.</p>

        <h3>Common Mental Health Issues</h3>
        <ul>
            <li>Depression</li>
            <li>Anxiety</li>
            <li>Stress</li>
            <li>Post-Traumatic Stress Disorder (PTSD)</li>
            <li>Bipolar Disorder</li>
        </ul>

        <h3>Tips for Maintaining Good Mental Health</h3>
        <ol>
            <li>Exercise regularly to improve mood and reduce stress.</li>
            <li>Talk to someone you trust about your feelings.</li>
            <li>Get enough sleep and practice relaxation techniques.</li>
            <li>Eat a balanced diet and avoid harmful substances.</li>
            <li>Engage in activities that bring joy and satisfaction.</li>
        </ol>

        <button class="logout-btn" onclick="logout()">Logout</button>
    </div>

    <script>
        // Logout function to end the session and close the page
        function logout() {
            <?php session_destroy(); ?> // Destroy session to log out
            window.close(); // Close the page
        }
    </script>
</body>
</html>
