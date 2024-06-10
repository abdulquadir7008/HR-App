<?php 
include("../config.php");
$sess=session_id();
$employee=$_POST['employee'];
$project=$_POST['project'];
$email=$_POST['email'];
$tax=$_POST['tax'];
$client_address=$_POST['client_address'];
$billing_address=$_POST['billing_address'];
$invoice_date=$_POST['invoice_date'];
$due_date=$_POST['due_date'];
$total=$_POST['total'];
$id=$_POST['id'];



if(isset($_REQUEST['update']))
{


$query="update invoice SET employee='$employee',project='$project',email='$email',client_address='$client_address',billing_address='$billing_address',invoice_date='$invoice_date',due_date='$due_date',total='$total' ,tax='$tax' WHERE invoice_id=$id";
mysqli_query($link,$query);


foreach($_POST['description'] as $index => $postValues) {
	$data2 = $_POST['unit'][$index];
	$data3 = $_POST['price'][$index];
	$ider = $_POST['ider'][$index];
$query100="update invoice_bill SET description='$postValues',unit='$data2',price='$data3' WHERE id=$ider";
 mysqli_query($link,$query100);
}


	

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ../manage-invoice.php');
}
else if(isset($_REQUEST['add']))
{
$querybord="insert into invoice(employee,project,email,tax,client_address,billing_address,invoice_date,due_date,status,total) values('$employee','$project','$email','$tax','$client_address','$billing_address','$invoice_date','$due_date','1','$total')";
mysqli_query($link,$querybord);
$last_id = mysqli_insert_id($link);
 
foreach($_POST['description'] as $index => $postValues) {
	$data2 = $_POST['unit'][$index];
	$data3 = $_POST['price'][$index];
  $query100 = "INSERT INTO invoice_bill(description,invoice_id,unit,price) values ('$postValues','$last_id','$data2','$data3')";
  mysqli_query($link,$query100);
}

$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Acount Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ../manage-invoice.php');
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
