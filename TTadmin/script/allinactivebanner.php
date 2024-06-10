<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"update banner SET status='0' WHERE id='" . $_POST["users"][$i] . "'");
}
header("Location:../banner_manage.php");


?>