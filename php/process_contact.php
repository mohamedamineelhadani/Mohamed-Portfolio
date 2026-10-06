<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.html#section4');
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$subject   = trim($_POST['subject'] ?? '');
$message   = trim($_POST['message'] ?? '');

if ($full_name === '' || $phone === '' || $subject === '' || $message === ''
    || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    die('Please fill in all fields with valid information. <a href="../index.html#section4" style="display:inline-block;margin-top:12px;padding:10px 24px;background:#e87a1e;color:#140e08;text-decoration:none;font-weight:500;">Go back</a>');
}

$stmt = $conn->prepare('INSERT INTO contacts (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('sssss', $full_name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    header('Location: ../nice.html');
} else {
    http_response_code(500);
    echo 'Something went wrong. Please try again later.';
}
$stmt->close();
$conn->close();