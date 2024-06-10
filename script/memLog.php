<?php include("../config.php");
ob_start();
$email = $_POST['email'];
$password = $_POST['password'];
$type_role = $_POST['type_role'];
if($email!='' || $password!='' || $type_role!='')
{	
$qry="SELECT * FROM users WHERE email='$email' AND password='".$password."' AND type_role='$type_role' AND status='1'";
$result=mysqli_query($link,$qry);
if(mysqli_num_rows($result) == 1) {
$member = mysqli_fetch_assoc($result);
$id=$_SESSION['id'] = $member['id'];
//$query="insert into membersonline(member_id,account_type) values('$id','$account_type')";
//mysqli_query($link,$query);
header("Location:../index.php");
}
else 
{
$errmsg_arr[] = '<div class="massgerrpr">Error: Please enter your valid email and password.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

}
else 
{
$errmsg_arr[] = 'Error: This email/password combination is incorrect.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();

?>