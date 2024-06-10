<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"DELETE FROM testimonial WHERE id='" . $_POST["users"][$i] . "'");
}
@header("Location:../testimonial_manage.php");


?>