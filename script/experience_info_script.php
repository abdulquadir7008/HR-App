<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}

$company_name=$_POST['company_name'];
$location=$_POST['location'];
$job_position=$_POST['job_position'];
$period_form=$_POST['period_form'];
$period_to=$_POST['period_to'];
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

if(isset($_REQUEST['exp_update_button']))
{
$exp_id=$_POST['exp_id'];
$query="update experience_info SET company_name='$company_name',location='$location',job_position='$job_position',
period_form='$period_form',period_to='$period_to',status='0',admin_id='$cont_hr_id' WHERE exp_id=$exp_id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
else if(isset($_REQUEST['add_experience']))
{
	
$querybord="insert into experience_info (company_name,location,job_position,period_form,period_to,status,profile_id,admin_id,us_id) 
values('$company_name','$location','$job_position','$period_form','$period_to','0','$customerchechlogin_id','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
	}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from experience_info WHERE exp_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Delete - </b>Data Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['salary_msg'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
	


?>