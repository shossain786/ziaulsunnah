<?php
// Database connection
$host = 'localhost'; // Replace with your DB host
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password
$database = 'ziaulsunnah'; // Replace with your DB name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch data from sawalat table
$sql = "SELECT id, sawal AS question, jawab AS answer, category FROM sawalat";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Organize data by category
        if (!isset($categories[$row['category']])) {
            $categories[$row['category']] = [
                'name' => $row['category'],
                'questions' => []
            ];
        }
        $categories[$row['category']]['questions'][] = [
            'question' => $row['question'],
            'answer' => $row['answer']
        ];
    }
}

// Convert to JSON and send as response
header('Content-Type: application/json');
echo json_encode(['categories' => array_values($categories)]);

$conn->close();
?>
