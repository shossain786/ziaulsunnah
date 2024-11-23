<?php
session_start();

// Include the database connection
include('db_connection.php'); // Make sure to include the correct path to your db_connection.php file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query the database to check if the username and password match
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    // If user is found
    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin-dashboard.php"); // Redirect to dashboard
    } else {
        echo "Invalid username or password!";
    }
}
?>
