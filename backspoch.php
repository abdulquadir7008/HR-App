<?php
include("config.php");
if(isset($_POST["id"])) {
	$product_id = $_POST["id"];
	$query="delete from revenues WHERE revnue_id=$product_id";
mysqli_query($link,$query);
			}

else if(isset($_POST["edel"])) {
	$expenpro = $_POST["edel"];
	$query1="delete from expenses WHERE expensive_id=$expenpro";
mysqli_query($link,$query1);
	
			}
    ?>
    