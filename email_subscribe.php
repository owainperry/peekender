<?php
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $recipient = 'peekender.info@gmail.com';
    $sender = $recipient;
    $subject = 'Peek News Subscribe request';
    $body .= "Name: $name \n";
    $body .= "Email: $email \n";  
    $location = "connect_success.html";
    mail($recipient, $subject, $body, "From: $sender") or die ("Mail could not be sent.");    
    header("Location: $location");
?>
