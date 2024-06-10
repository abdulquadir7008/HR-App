<?php 
include("../../config.php");


if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query2="update inboxdata SET star='1' WHERE id='$id'";
mysqli_query($link,$query2);
}
if(isset($_REQUEST['del2']))
{
$id1=$_REQUEST['del2'];
$query21="update inboxdata SET star='0' WHERE id='$id1'";
mysqli_query($link,$query21);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
