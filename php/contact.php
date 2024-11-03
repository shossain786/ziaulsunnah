<?php
header('Content-Type: application/json');

// Validate input fields
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if (!$name || !$email || !$subject || !$message) {
    echo json_encode(['success' => false, 'message' => 'Please fill all fields correctly.']);
    exit;
}

// Prepare the email
$to = "sddmhossain786@gmail.com";
$emailSubject = "Contact Form: $subject";
$emailBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";
$headers = "From: $email";

// Send the email
if (mail($to, $emailSubject, $emailBody, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again.']);
}
?>
