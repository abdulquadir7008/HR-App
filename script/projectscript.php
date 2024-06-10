<?php 
include("../config.php");
$sess=session_id();
$project_name=$_POST['project_name'];
$employee=$_POST['employee'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$rate=$_POST['rate'];
$priority=$_POST['priority'];
$description=$_POST['description'];
$horuly_rate=$_POST['horuly_rate'];
$id=$_POST['id'];



if(isset($_REQUEST['update']))
{


$query="update project SET project_name='$project_name',employee='$employee',start_date='$start_date',end_date='$end_date',rate='$rate',priority='$priority',description='$description',horuly_rate='$horuly_rate' WHERE id=$id";
mysqli_query($link,$query);


	

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $project_name create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ../manage-project.php');
}
else if(isset($_REQUEST['add']))
{
$querybord="insert into project(project_name,employee,start_date,end_date,rate,priority,description,horuly_rate) values('$project_name','$employee','$start_date','$end_date','$rate','$priority','$description','$horuly_rate')";
mysqli_query($link,$querybord);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////



//header('Location: ' . $_SERVER['HTTP_REFERER']);
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $project_name create Acount Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ../manage-project.php');
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
