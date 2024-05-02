<?php
if (isset($_POST['submit'])) { 
      $name = $_POST['name'];
      $email = $_POST['email'];
      $ToEmail = 'peekender.info@gmail.com';
      $EmailSubject = 'Peek News Sunscribe request'; 
      $mailheader = "From: ".$_POST["email"]."\r\n"; 
      $mailheader .= "Reply-To: ".$_POST["email"]."\r\n"; 
      $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
      $MESSAGE_BODY = "Name: ".$_POST["name"]."<br>"; 
      $MESSAGE_BODY .= "Email: ".$_POST["email"]."<br>"; 
      if(mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader))
      {
		  echo "<script>alert('Subscribe EMail was sent !');</script>";
		  echo "<script>document.location.href='email_subscribe.php'</script>";
      }
      else
      {
		echo "<script>alert('Mail was not sent. Please try again later');</script>";
      }
 }
?>