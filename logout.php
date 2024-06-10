<?PHP include("config.php");
ob_start();
$sess=session_id();
if($_SESSION['id']) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
$iderget=$customerchechlogin_row['id'];
unset($_SESSION['id']);
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();
exit();
?>
