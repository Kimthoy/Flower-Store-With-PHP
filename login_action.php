<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'shop_db';
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // Password is hashed using MD5

    // Query database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check role
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        
        // Check user role and redirect accordingly
        if ($user['role'] == 'admin') {
            $_SESSION['role'] = 'admin';
            header("Location:admin.php"); // Admin page
        } else {
            $_SESSION['role'] = 'user';
            header("Location:index.php"); // User page
        }
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
