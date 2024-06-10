<?php 
error_reporting(0);
include("../config.php"); 
include('allfunction.php'); 
include('auth.php');

$usen=$_SESSION['SESS_ADMIN_USER'];
$profile_sett="select * from admin_login where username='$usen'"; 
$result_profile=mysqli_query($link,$profile_sett); 
$profile_row=mysqli_fetch_array($result_profile);
$kadirtest=$profile_row['username'];
function vendor($link) {
$vendor_sql="select * from toolbox_login where status=1"; 
$result_vendor=mysqli_query($link,$vendor_sql);
print mysqli_num_rows($result_vendor);
}
function member($link) {
$vendor_sql="select * from toolbox_login where status=5"; 
$result_vendor=mysqli_query($link,$vendor_sql);
print mysqli_num_rows($result_vendor);
}
function Promo($link) {
$sql_cms="select * from promo_request order by id DESC"; 
$result_cms=mysqli_query($link,$sql_cms);
print mysqli_num_rows($result_cms);
}
function sponsor($link) {
$sql_cms="select * from sponsor order by id DESC"; 
$result_cms=mysqli_query($link,$sql_cms); 
print mysqli_num_rows($result_cms);
}

?>
