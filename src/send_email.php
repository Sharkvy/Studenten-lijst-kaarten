<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Load environment variables from .env file
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve SMTP host from environment variable
$smtp_host = $_ENV['SMTP_HOST'];
$smtp_username = $_ENV['SMTP_USERNAME'];
$smtp_password = $_ENV['SMTP_PASSWORD'];
$smtp_port = $_ENV['SMTP_PORT'];


// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $smtp_port;

    // Get the email address of the person whose card was clicked
    $recipient_email = $_POST['email'];

    // Set the recipient email address and name
    $mail->addAddress($recipient_email);
    $mail->addReplyTo($_POST['email'], $_POST['name']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New message from contact form';
    $mail->Body    = 'Name: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'] . '<br>Message: ' . $_POST['message'];
    $mail->AltBody = 'Name: ' . $_POST['name'] . '\nEmail: ' . $_POST['email'] . '\nMessage: ' . $_POST['message'];

    // Send the email
    $mail->send();
    echo 'Message has been sent. <a href="./index.php">Go back to homepage</a>';
} catch (Exception $e) {
    echo 'Message could not be sent. <button onclick="window.location.href=\'./forum.php\'">Go back to forum</button>';
}
?>
</body>
</html>