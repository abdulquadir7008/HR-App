<?php include("../../config.php");
if(isset($_REQUEST['login_button']))
{

	
$username = $_POST['username'];
$password = $_POST['password'];
	
if($username!='' && $password!='')
{
$qry="SELECT * FROM admin_login WHERE username='$username' AND password='".md5($_POST['password'])."' AND status=1";
$result=mysqli_query($link,$qry);

if($result) {
if(mysqli_num_rows($result) == 1) {
$member = mysqli_fetch_assoc($result);
$_SESSION['SESS_ADMIN_ID'] = $member['admin_id'];
//$_SESSION['SESS_ADMIN_USER'] = $member['username'];   
//$_SESSION['SESS_PASS_WD'] = $member['password'];
session_write_close();
header("location:../index.php");
exit();
}
else
{
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = 'incorrect password.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();		
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
}
else 
{
header("location:../index.php");
}
}
else
{
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = 'Please fill in password.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();		
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}
}
else
{
header("location:../index.php");	
}
mysqli_close($link);
?>