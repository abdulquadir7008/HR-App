<?php include("../config.php");

$company_name = $_POST['company_name'];
$contact_person = $_POST['contact_person'];
$address = $_POST['address'];
$country = $_POST['country'];
$city = $_POST['city'];
$postal_code = $_POST['postal_code'];
$alt_email = $_POST['alt_email'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$url = $_POST['url'];
$company_id = $_POST['company_id'];

if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} 

if(isset($_REQUEST['update']))
{
$query="update company_details SET company_name='$company_name',contact_person='$contact_person',address='$address',country='$country', 
city='$city',postal_code='$postal_code',alt_email='$alt_email',phone='$phone',mobile='$mobile',fax='$fax',url='$url' WHERE company_id=$company_id";
mysqli_query($link,$query);
	
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Company Details Update Successfully.</span></div></div>";
$errflag = true;
$_SESSION['companysetting'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['add']))
{
	
$querybord="insert into company_details (company_name,contact_person,address,country,city,postal_code,alt_email,phone,mobile,fax,url,user_id,user_type) 
values('$company_name','$contact_person','$address','$country','$city','$postal_code','$alt_email','$phone','$mobile','$fax','$url','$customerchechlogin_id','1')";
mysqli_query($link,$querybord);
	
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Company Setting Successfully.</span></div></div>";
$errflag = true;
$_SESSION['companysetting'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>