<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
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

if(isset($_REQUEST['bank_details']))
{
$bank_name=$_POST['bank_name'];
$bank_no=$_POST['bank_no'];
$ifsc_code=$_POST['ifsc_code'];
$pan_no=$_POST['pan_no'];
$old_bank_details=$_POST['old_bank_details'];
	
$personal_info_sql = "select * from bank_details WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
	
if(mysqli_num_rows($personal_info_resu) > 0){

$query="update bank_details SET bank_name='$bank_name',bank_no='$bank_no',ifsc_code='$ifsc_code',
pan_no='$pan_no',status='0',old_bank_details='$old_bank_details',admin_id='$cont_hr_id' WHERE profile_id=$customerchechlogin_id";
mysqli_query($link,$query);

}
	else{
	
$querybord="insert into bank_details (bank_name,bank_no,ifsc_code,pan_no,status,profile_id,old_bank_details,admin_id,us_id) 
values('$bank_name','$bank_no','$ifsc_code','$pan_no','0','$customerchechlogin_id','$old_bank_details','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);
	}
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
?>