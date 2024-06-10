<?php
$to = "rctechsup12@gmail.com"; 
$subject = "Test mail"; 
$message = "Hello! This is a simple email message."; 
$from = "noreplay@splendidcrms.com"; 
$headers = "From:" . $from; mail($to,$subject,$message,$headers); 
echo "Mail Sent.";
?>