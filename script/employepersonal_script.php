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
if(isset($_REQUEST['add_personal']))
{
$passportno=$_POST['passportno'];
$expire_date=$_POST['expire_date'];
$tel_phone=$_POST['tel_phone'];
$nationality=$_POST['nationality'];
$religion=$_POST['religion'];
$marital_status=$_POST['marital_status'];
$employment_of_pouse=$_POST['employment_of_pouse'];
$no_of_child=$_POST['no_of_child'];
	
$personal_info_sql = "select * from personal_info WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
	
if(mysqli_num_rows($personal_info_resu) > 0){

$query="update personal_info SET passportno='$passportno',expire_date='$expire_date',tel_phone='$tel_phone',
nationality='$nationality',religion='$religion',marital_status='$marital_status',employment_of_pouse='$employment_of_pouse',no_of_child='$no_of_child',status='0',admin_id='$cont_hr_id' WHERE profile_id=$customerchechlogin_id";
mysqli_query($link,$query);

}
	else{
	
$querybord="insert into personal_info (passportno,expire_date,tel_phone,nationality,religion,marital_status,employment_of_pouse,no_of_child,profile_id,status,admin_id,us_id) 
values('$passportno','$expire_date','$tel_phone','$nationality','$religion','$marital_status','$employment_of_pouse','$no_of_child','$customerchechlogin_id','0','$cont_hr_id','$ac_id')";
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