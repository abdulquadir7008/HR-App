<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"DELETE FROM portfolio WHERE page_id='" . $_POST["users"][$i] . "'");
}
@header("Location:../portfolio_manage.php");


?>