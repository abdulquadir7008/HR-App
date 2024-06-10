<?php include('config.php')?>
<?php
$city_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($city_id <> "") {
    $sql = "SELECT * FROM project WHERE  client= '$city_id' ORDER BY project_name ASC";
    $result_cms2=mysqli_query($link,$sql); 

    if (count($result_cms2) > 0) {
        ?>
         
                <?php while($row_cms2=mysqli_fetch_array($result_cms2)) { ?>
                    <option value="<?php echo $row_cms2["id"]; ?>"><?php echo $row_cms2["project_name"]; ?></option>
                <?php } ?>
           
        <?php
    }
}
?>

