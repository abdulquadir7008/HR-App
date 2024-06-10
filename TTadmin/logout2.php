<?php session_start();
unset($_SESSION['SESS_ADMIN_ID']);
$_SESSION['SESS_ADMIN_USER'];
header("location:lockscreen.php");
?>