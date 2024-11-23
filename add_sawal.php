<?php
// Database connection
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'ziaulsunnah'; // Replace with your database name

$connection = new mysqli($host, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $connection->connect_error]));
}

// Get POST data
$sawal = isset($_POST['sawal']) ? $connection->real_escape_string($_POST['sawal']) : '';
$jawab = isset($_POST['jawab']) ? $connection->real_escape_string($_POST['jawab']) : '';
$category = isset($_POST['category']) ? $connection->real_escape_string($_POST['category']) : '';

// Validate data
if (empty($sawal) || empty($jawab) || empty($category)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Insert into database
$query = "INSERT INTO sawalat (sawal, jawab, category) VALUES ('$sawal', '$jawab', '$category')";

if ($connection->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Sawal added successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $connection->error]);
}

$connection->close();
?>
