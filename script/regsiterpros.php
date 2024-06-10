<?php
include( "../config.php" );
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
set_error_handler( "var_dump" );
ini_set( "mail.log", "/tmp/mail.log" );
ini_set( "mail.add_x_header", TRUE );
$sess = session_id();
$to = $_REQUEST[ 'email' ];
$password = $_REQUEST[ 'password' ];
$sess = session_id();
$subject = "Register confirm Email";
if ( $to != '' ) {
  $sql = "select * from users where email='$to'";
  $result = mysqli_query( $link, $sql );
  if ( mysqli_num_rows( $result ) == 0 ) {
    $query = "insert into users(email,password,status,create_date,sesion,account_type)values('$to','$password','0',now(),'$sess','1')";
    mysqli_query( $link, $query );
    //$user_id=$_SESSION['id']=mysqli_insert_id($link);
    $message = "<div style='background:#f3f3f3; padding:40px; text-align:center;'>
  <div style='width:700px; padding:20px; background:#fff; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:14px;'>
    <div align='center'><img src='https://crm.hostsplendid.com/images/logo-sign.png' width='100'></div>
    <p><strong>Hi,</strong></p>
    <div>Thank you create account in <strong> Splendid CRM. Please filled the all details Below link.</strong></div>
    <div style='background:#09F; padding:10px 20px; font-weight:bold; text-align:center; font-size:15px; font-weight:bold; width:270px; margin:20px auto;'><a href='$domain_url/register-fill-form.php?temp=$sess&&email=$to' style=' display:block;color:#fff; text-decoration:none;'>Click here to Verify Your Account</a>
	</div>
	<p>OR</p>
	<P><strong>Copy here: $domain_url/register-fill-form.php?temp=$sess&&email=$to</strong></p>
  </div>
</div>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Verify" . "<noreplay@splendidcrms.com>\r\n";
	$headers .= "X-Priority: 3\r\n";
	$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
    mail( $to, $subject, $message, $headers );


    $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Please verify your email.</div>';
    $errflag = true;
    $_SESSION[ 'registerpro' ] = $errmsg_arr;
    session_write_close();
    header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
  } else {
    $errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> This Email is already use</div>';
    $errflag = true;
    $_SESSION[ 'registerpro' ] = $errmsg_arr;
    session_write_close();
    header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );

  }
} else {
  $errmsg_arr[] = 'Error: Please filled the Register form.';
  $errflag = true;
  $_SESSION[ 'registerpro' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}
?>