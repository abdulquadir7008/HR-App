<?php
include('../config.php');

include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
if(isset($_POST["send"])){
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	$image = $_POST["image"];
	$date=time();
	$image="images/".$rand1.$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],$image);
	$mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 
	$mail->Host = SMTP_HOST; //Hostname of the mail server
	$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
	$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = SMTP_PWORD; //Password for SMTP authentication
	$mail->AddReplyTo(SMTP_UNAME, "Reply name"); //reply-to address
	$mail->SetFrom(SMTP_UNAME, "Tangible Technosis"); //From address of the mail
	// put your while loop here like below,
	$mail->Subject = "$subject"; //Subject od your mail
	$mail->AddAddress($email, "TT"); //To address who will receive this email
	$mail->MsgHTML("$message"); //Put your body of the message you can place html code here
	$mail->AddAttachment("$image"); //Attach a file here if any or comment this line, 
	$send = $mail->Send(); //Send the mails
	if($send){
$query="insert into sent(email,subject,message,image,status,date) values('$email','$subject','$message','$image','1','$date')";
mysqli_query($link,$query);
		
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = 'Mail sent successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
header('Location:mailbox.php');
session_write_close();


	}
	else{
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = $mail->ErrorInfo;
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
header('Location:mailbox.php');
session_write_close();


	}
	
}
else if(isset($_POST["discharge"])){
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	$image = $_POST["image"];
	$date=time();
	$image="images/".$rand1.$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],$image);
	$query="insert into sent(email,subject,message,image,status,date) values('$email','$subject','$message','$image','0','$date')";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>

