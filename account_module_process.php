<?php
include( "config.php" );
$sql_module_hr="select * from account_module_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='accounting'){
		$data = "accounting='$id'";
	}
	else if($mid=='sales'){
		$data = "sales='$id'";
	}
	else if($mid=='ac_leave'){
		$data = "ac_leave='$id'";
	}
	else if($mid=='requesthr'){
		$data = "requesthr='$id'";
	}
	else
	{
		$data='';
	}
		$queryatleast = "update account_module_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
