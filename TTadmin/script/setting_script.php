<?php include("../../config.php"); include('../allfunction.php'); 
$admin_id=$_REQUEST['admin_id'];
$username=$_REQUEST['username'];
$email_address=$_REQUEST['email_address'];
$url=$_REQUEST['url'];
$image=$_REQUEST['image'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$fblink=$_REQUEST['fblink'];
$yulink=$_REQUEST['yulink'];
$twlink=$_REQUEST['twlink'];
$lilink=$_REQUEST['lilink'];
$copyright=$_REQUEST['copyright'];
$metatitle=$_REQUEST['metatitle'];
$metakeywords=$_REQUEST['metakeywords'];
$metadescription=$_REQUEST['metadescription'];
$gplus=$_REQUEST['gplus'];

$fbchk=$_REQUEST['fbchk'];
$twchk=$_REQUEST['twchk'];
$lichk=$_REQUEST['lichk'];
$gpchk=$_REQUEST['gpchk'];
$yuchk=$_REQUEST['yuchk'];

$address=$_REQUEST['address'];
$phone=$_REQUEST['phone'];
$time=$_REQUEST['time'];

$altemail=$_REQUEST['altemail'];
$altphone=$_REQUEST['altphone'];

$footer_description=$_REQUEST['footer_description'];

$password=md5($_REQUEST['password']);

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
$image="../../$path".$rand1.$_FILES["image"]["name"];
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


if(isset($_REQUEST['update']))
{
$query="update admin_login SET username='$username', email_address='$email_address', password='$password', url='$url', image='$image0', firstname='$firstname', lastname='$lastname',copyright='$copyright', metatitle='$metatitle', metakeywords='$metakeywords', metadescription='$metadescription', fblink='$fblink', yulink='$yulink', twlink='$twlink', lilink='$lilink', gplus='$gplus', fbchk='$fbchk', twchk='$twchk', lichk='$lichk', gpchk='$gpchk', yuchk='$yuchk',address='$address',phone='$phone',time='$time',footer_description='$footer_description',altemail='$altemail',altphone='$altphone'  WHERE admin_id=$admin_id";
mysqli_query($link,$query);
header('location:../profile.php?cms=1');

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record modified successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{
$query="insert into admin_login(password,username,image,metatitle,metakeyword,metadescription,copyright,other1,other2) values('$password','$username','$image0','$metatitle','$metakeyword','$metadescription','$copyright','$other1','$other2')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record Add successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['admin_id']) || isset($_REQUEST['admin_id1']))
{
if(isset($_REQUEST['admin_id']))
{
$admin_id=$_REQUEST['admin_id'];
$status='0';
}
else if(isset($_REQUEST['admin_id1']))
{
$admin_id=$_REQUEST['admin_id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update admin_login SET status='$status' WHERE admin_id='$admin_id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from admin_login WHERE admin_id=$id";
mysqli_query($link,$query);
}
?>
