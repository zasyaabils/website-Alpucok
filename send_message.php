<?php
header('Content-Type: application/json');

// Get the form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Validate the data
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Process the message (in a real app, you would save to database and send email)
$messageId = uniqid();

// Prepare response
$response = [
    'success' => true,
    'message' => 'Message received successfully',
    'message_id' => $messageId,
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'date' => date('Y-m-d H:i:s')
];

// In a real application, you would:
// 1. Save the message to a database
// 2. Send notification email to admin
// 3. Send confirmation email to the sender

echo json_encode($response);
?>