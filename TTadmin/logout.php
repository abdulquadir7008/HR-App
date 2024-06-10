<?php session_start();
$userseeion=$_REQUEST['username'];
unset($_SESSION['SESS_ADMIN_ID']);
$_SESSION['SESS_ADMIN_USER'] = $userseeion;
header("location:index.php");
?>