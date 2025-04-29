<?php
$url = 'the.jpg';
?>
<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username']; 
        header("Location: home.html"); 
        exit();
    } else {
        echo "❌ Invalid email or password! <a href='login1.html'>Try again</a>";
    }
}
?>
