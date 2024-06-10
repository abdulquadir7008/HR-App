<?php include("../config.php");

$fullname = $_POST['fullname'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$emirateid = $_POST['emirateid'];
$address = $_POST['address'];
$country = $_POST['country'];
$city = $_POST['city'];
$cusid = $_POST['cusid'];

if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="../$path0".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}
echo $image0;
if(isset($_REQUEST['profup']))
{
    

$query="update users SET fullname='$fullname',dob='$dob', phone='$phone',emirateid='$emirateid', 
address='$address',country='$country',city='$city',image='$image0' WHERE id=$cusid";
    mysqli_query($link,$query);
$errmsg_arr[] = '<div class="massgerrpr">Error: Please enter your valid email and password.</div>';
$errflag = true;
$_SESSION['profilerror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>