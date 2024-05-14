<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

$mail = new PHPMailer();
$mail->isSMTP();
//$mail->Host = 'email-smtp.eu-west-1.amazonaws.com';
$mail->Host = 'smtp.sendgrid.net';
$mail->Port = 587;

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

$mail->SMTPAuth = true;
$mail->Username = 'apikey';
$mail->Password = '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';

$mail->setFrom('peekender.info@gmail.com', 'Peek Info');
$mail->addReplyTo('peekender.info@gmail.com', 'Peek Info');
$mail->addAddress('peekender.info@gmail.com', 'Info');
//$mail->addAddress('andyward.1970@gmail.com', 'Andy Ward');
//$mail->addAddress('success@simulator.amazonses.com', 'Success');
//$mail->addAddress('bounce@simulator.amazonses.com', 'Bounce');
//$mail->addAddress('ooto@simulator.amazonses.com', 'OOTO');
$mail->Subject = 'Peek News Subscribe request';

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$success = "https://peekender.uk/connect_success.html"
$fail = "https://peekender.uk/connect_fail.html"

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
$mail->Body = 'Name: $name, Email: $email';


//send the message, go to success or fail page
if (!$mail->send()) {
    header( "Location: $fail" );
} else {
	header( "Location: $success" );
}
echo '\n';
?>
