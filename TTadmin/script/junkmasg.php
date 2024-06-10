<?php include("../../config.php"); ?>
<?php

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($link,"update inboxdata SET status='5' WHERE id='" . $_POST["users"][$i] . "'");
}
header("Location:../mailbox.php");


?>