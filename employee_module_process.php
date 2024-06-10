<?php
include( "config.php" );
$sql_module_hr="select * from employe_module_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='attendance'){
		$data = "attendance='$id'";
	}
	else if($mid=='sales'){
		$data = "sales='$id'";
	}
	else if($mid=='emp_leaves'){
		$data = "emp_leaves='$id'";
	}
	else if($mid=='emp_request'){
		$data = "emp_request='$id'";
	}
	else
	{
		$data='';
	}
		$queryatleast = "update employe_module_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
