<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ziaulsunnah';

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
