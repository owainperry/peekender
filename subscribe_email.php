<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Load configuration from ini file
$config = parse_ini_file('config.ini', true);

if ($config && isset($config['send_grid'])) {
    $host = $config['send_grid']['host'];
    $user = $config['send_grid']['user'];
    $password = $config['send_grid']['password'];
    $port = $config['send_grid']['port'];
    $from_email = $config['send_grid']['from_email'];
    $from_name = $config['send_grid']['from_name'];
    $to_email = 'peekender.info@gmail.com';  // Fixed email address
} else {
    header('Location: connect_fail_config.html');
    exit;
}

// Check if form data is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscriber_email']) && isset($_POST['subscriber_name'])) {
    // Sanitize input
    $subscriber_email = filter_var($_POST['subscriber_email'], FILTER_SANITIZE_EMAIL);
    $subscriber_name = htmlspecialchars($_POST['subscriber_name'], ENT_QUOTES, 'UTF-8');

    if (!filter_var($subscriber_email, FILTER_VALIDATE_EMAIL)) {
        header('Location: connect_fail_bademail.html');
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $port;

        // Recipients
        $mail->setFrom($from_email, $from_name);
        $mail->addAddress($to_email);  // Fixed recipient address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Subscriber';
        $mail->Body    = "Name: $subscriber_name<br>Email: $subscriber_email";

        $mail->send();
        header('Location: connect_success.html');
    } catch (Exception $e) {
        header('Location: connect_fail_smtp.html');
    }
} else {
    header('Location: connect_fail_data.html');
}
?>