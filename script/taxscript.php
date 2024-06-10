<?php 
include("../config.php");
$sess=session_id();
$tax=$_POST['tax'];
$percentage=$_POST['percentage'];
$id=$_POST['id'];



if(isset($_REQUEST['update']))
{


$query="update tax SET tax='$tax',percentage='$percentage' WHERE id=$id";
mysqli_query($link,$query);


	

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $project_name create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ../tax-manage.php');
}
else if(isset($_REQUEST['add']))
{
$querybord="insert into tax(tax,percentage) values('$tax','$percentage')";
mysqli_query($link,$querybord);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////



//header('Location: ' . $_SERVER['HTTP_REFERER']);
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $tax create Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ../tax-manage.php');
}
else
{
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Warning - </b> Filled the form Correctly.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);

}


?>
