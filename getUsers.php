<?php 

include "config.php";

$departid = 0;

if(isset($_POST['depart'])){
   $departid = mysqli_real_escape_string($link,$_POST['depart']); // department id
}

$users_arr = array();

if($departid > 0){
   $sql = "SELECT depart_id,dep_name FROM department WHERE parent_id=".$departid;

   $result = mysqli_query($link,$sql);

   while( $row = mysqli_fetch_array($result) ){
      $userid = $row['depart_id'];
      $name = $row['dep_name'];

      $users_arr[] = array("id" => $userid, "name" => $name);
   }
}
// encoding array to json format
echo json_encode($users_arr);
?>