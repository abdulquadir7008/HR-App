<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"DELETE FROM banner WHERE id='" . $_POST["users"][$i] . "'");
}
@header("Location:../banner_manage.php");


?>