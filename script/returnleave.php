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
if(isset($_REQUEST['submit']))
{
$join_date=$_POST['join_date'];
$comment=$_POST['comment'];
$userid=$_POST['userid'];
$querybord="insert into return_leave (join_date,comment,userid,,admin_id,hr_id) 
values('$join_date','$comment','$userid','$cont_hr_id','$hr_id')";
mysqli_query($link,$querybord);
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> Leave Return Application Successfully.</span></div></div>";
$errflag = true;
$_SESSION['return_leave_error'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
?>