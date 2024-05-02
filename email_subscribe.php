<?php
if (isset($_POST['submit'])) { 
	$name = $_POST['name'];
	$email = $_POST['email'];
	$recipient = 'peekender.info@gmail.com';
	$sender = $recipient;
	$subject = 'Peek News Sunscribe request';
	$body .= "Name: ".$_REQUEST['name']." \n";
	$body .= "Email: ".$_REQUEST['email']." \n";	
	$location = "connect_success.html";
	mail( $recipient, $subject, $body, "From: $sender" ) or die ("Mail could not be sent.");	
	header( "Location: $location" );
}
?>