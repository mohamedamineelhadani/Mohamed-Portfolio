<?php
$host = 'localhost';
$db_name = 'contact_db';
$db_user = 'root';
$db_pass = '';

mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    http_response_code(500);
    die('Database connection failed.');
}
$conn->set_charset('utf8mb4');

session_set_cookie_params(['httponly' => true, 'samesite' => 'Strict']);
session_start();