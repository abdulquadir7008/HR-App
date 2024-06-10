<?php
include( "config.php" );
$sql_module_hr="select * from employee_fun_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='leave_em_per_red'){
		$data = "leave_em_per_red='$id'";
	}
	else if($mid=='leave_em_per_wr'){
		$data = "leave_em_per_wr='$id'";
	}
	else if($mid=='leave_em_per_del'){
		$data = "leave_em_per_del='$id'";
	}
	else if($mid=='cancel_leave_red'){
		$data = "cancel_leave_red='$id'";
	}
	else if($mid=='cancel_leave_wr'){
		$data = "cancel_leave_wr='$id'";
	}
	else if($mid=='cancel_leave_del'){
		$data = "cancel_leave_del='$id'";
	}
	
	else
	{
		$data='';
	}
		$queryatleast = "update employee_fun_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
