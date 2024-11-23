<?php
// Database connection parameters
$host = '127.0.0.1:3306'; // Replace with your DB host
$username = 'u675809678_ziaulsunnah'; // Replace with your DB username
$password = 'Ziaulsunnah@92'; // Replace with your DB password
$database = 'u675809678_ziaulsunnah'; // Replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If connection fails, display an error message and terminate the script
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character set to UTF-8 to handle special characters
$conn->set_charset("utf8");
?>
