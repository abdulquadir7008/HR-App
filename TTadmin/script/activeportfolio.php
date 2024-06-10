<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"update portfolio SET status='1' WHERE page_id='" . $_POST["users"][$i] . "'");
}
header("Location:../portfolio_manage.php");


?>