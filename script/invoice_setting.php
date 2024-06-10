<?php include("../config.php");

$invocie_prifix = $_POST['invocie_prifix'];
$invoice_id = $_POST['invoice_id'];

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

if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} 

if(isset($_REQUEST['update']))
{
	
$query="update invoice_setting SET invocie_prifix='$invocie_prifix',image='$image0' WHERE invoice_id=$invoice_id";
mysqli_query($link,$query);
	
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Invoice Details Update Successfully.</span></div></div>";
$errflag = true;
$_SESSION['invoicesetting'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['add']))
{
	
$querybord="insert into invoice_setting (invocie_prifix,image,user_id,user_type) 
values('$invocie_prifix','$image0','$customerchechlogin_id','1')";
mysqli_query($link,$querybord);
	
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Invoice Setting Successfully.</span></div></div>";
$errflag = true;
$_SESSION['invoicesetting'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>