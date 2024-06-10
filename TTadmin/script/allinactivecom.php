<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"update comments SET status='0' WHERE id='" . $_POST["users"][$i] . "'");
}
header("Location:../comment_manage.php");


?>