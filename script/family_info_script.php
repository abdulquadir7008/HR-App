<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}
$fam_name=$_POST['fam_name'];
$fam_realtion=$_POST['fam_realtion'];
$fam_dob=$_POST['fam_dob'];
$fam_phone=$_POST['fam_phone'];
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

if(isset($_REQUEST['family_update_btn']))
{
$fam_id=$_POST['fam_id'];
$query="update familiy_info SET fam_name='$fam_name',fam_realtion='$fam_realtion',fam_dob='$fam_dob',
fam_phone='$fam_phone',status='0',admin_id='$cont_hr_id' WHERE fam_id=$fam_id";
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
else if(isset($_REQUEST['family_add_btn']))
{
	
$querybord="insert into familiy_info (fam_name,fam_realtion,fam_dob,fam_phone,status,profile_id,admin_id,us_id) 
values('$fam_name','$fam_realtion','$fam_dob','$fam_phone','0','$customerchechlogin_id','$cont_hr_id','$ac_id')";
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
$query="delete from familiy_info WHERE fam_id=$del";
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