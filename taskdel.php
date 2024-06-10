<?php
include("config.php");
if(isset($_POST["id"])) {
	$product_id = $_POST["id"];
	$query="delete from task_board WHERE task_id=$product_id";
mysqli_query($link,$query);
			}

else if(isset($_POST["edel"])) {
	$expenpro = $_POST["edel"];
$query1="update task_board SET status='0' WHERE task_id=$expenpro";
mysqli_query($link,$query1);
	
			}
else if(isset($_POST["inedel"])) {
	$expenproin = $_POST["inedel"];
$query10="update task_board SET status='1' WHERE task_id=$expenproin";
mysqli_query($link,$query10);
	
			}
    ?>
    