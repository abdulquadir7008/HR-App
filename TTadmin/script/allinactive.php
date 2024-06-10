<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"update cms_pages SET status='0' WHERE page_id='" . $_POST["users"][$i] . "'");
}
header("Location:../cms_manage.php");


?>