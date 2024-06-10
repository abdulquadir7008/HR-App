<?php
include("../config.php");
ob_start();
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
if($customerchechlogin_row['account_type']=='1'){
	$cont_hr_id = $customerchechlogin_id;
}
else{
	$cont_hr_id = $customerchechlogin_row['parent_admin'];
}
$sql_hr_req="select * from counter WHERE admin_id=$cont_hr_id";
$result_hr_req=mysqli_query($link,$sql_hr_req);
$list_hr_req=mysqli_fetch_array($result_hr_req);
$hr_id = $list_hr_req['id'];

if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from holiday WHERE holiday_id=$id";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['upd_holiday']) || isset($_REQUEST['add_holiday']) || isset($_REQUEST['add_holiday_send']) || isset($_REQUEST['update_holiday_send'])){ 
$holiday_name=$_POST['holiday_name'];
$holiday_date=$_POST['holiday_date'];
$holiday_id=$_POST['holiday_id'];
$message=$_POST['message'];	
}
if(isset($_REQUEST['add_holiday_send']) || isset($_REQUEST['update_holiday_send'])){
	$mailsql="select * from users WHERE status='1'";
$mail_result=mysqli_query($link,$mailsql);
while($list_mail=mysqli_fetch_array($mail_result)){
	if($kt == '1'){
		$kad_email = $list_mail['email'];
	}else{
	$kad_email .= ",".$list_mail['email'];
	}
	$kt++;
}
	$email_to = "$kad_email";
    $email_subject = "[Holiday] - $holiday_name";
	$email_massage="<div style='box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; padding: 30px;'><div><img src='https://www.splendid.ae/images/logo-2.png' style='width: 150px'></div><p><strong>Dear All,</strong></p><p><strong>$holiday_name</strong></p>$message<div><p><strong>Thanks</strong>,<br>Splendid Design It Technology LLC.<br>Central HR Group.</p></div></div>";
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: www.splendid.ae"."<hr@splendid.ae>\r\n";
	mail($email_to, $email_subject, $email_massage, $headers); 
}
if(isset($_REQUEST['upd_holiday']) || isset($_REQUEST['update_holiday_send']))
{

$query="update holiday SET holiday_name='$holiday_name',holiday_date='$holiday_date',message='$message' WHERE holiday_id=$holiday_id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['add_holiday']) || isset($_REQUEST['add_holiday_send']))
{
$querybord="insert into holiday (holiday_name,holiday_date,status,message,admin_id,hr_id) 
values('$holiday_name','$holiday_date','1','$message','$cont_hr_id','$hr_id')";
mysqli_query($link,$querybord);

$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Acount Successfully.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Warning - </b> Filled the form Correctly.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();
?>