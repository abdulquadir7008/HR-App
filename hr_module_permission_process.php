<?php
include( "config.php" );
$sql_module_hr="select * from hr_fun_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='employee_red'){
		$data = "employee_red='$id'";
	}
	else if($mid=='employee_wr'){
		$data = "employee_wr='$id'";
	}
	else if($mid=='employee_del'){
		$data = "employee_del='$id'";
	}
	else if($mid=='holiday_red'){
		$data = "holiday_red='$id'";
	}
	else if($mid=='holiday_wr'){
		$data = "holiday_wr='$id'";
	}
	else if($mid=='holiday_del'){
		$data = "holiday_del='$id'";
	}
	else if($mid=='leave_red'){
		$data = "leave_red='$id'";
	}
	else if($mid=='leave_wr'){
		$data = "leave_wr='$id'";
	}
	else if($mid=='leave_del'){
		$data = "leave_del='$id'";
	}
	else if($mid=='attendance_red'){
		$data = "attendance_red='$id'";
	}
	else if($mid=='attendance_wr'){
		$data = "attendance_wr='$id'";
	}
	else if($mid=='attendance_del'){
		$data = "attendance_del='$id'";
	}
	else if($mid=='department_red'){
		$data = "department_red='$id'";
	}
	else if($mid=='department_wr'){
		$data = "department_wr='$id'";
	}
	else if($mid=='department_del'){
		$data = "department_del='$id'";
	}
	else if($mid=='designation_red'){
		$data = "designation_red='$id'";
	}
	else if($mid=='designation_wr'){
		$data = "designation_wr='$id'";
	}
	else if($mid=='designation_del'){
		$data = "designation_del='$id'";
	}
	else if($mid=='clients_red'){
		$data = "clients_red='$id'";
	}
	else if($mid=='clients_wr'){
		$data = "clients_wr='$id'";
	}
	else if($mid=='clients_del'){
		$data = "clients_del='$id'";
	}
	else if($mid=='projects_red'){
		$data = "projects_red='$id'";
	}
	else if($mid=='projects_wr'){
		$data = "projects_wr='$id'";
	}
	else if($mid=='projects_del'){
		$data = "projects_del='$id'";
	}
	else if($mid=='task_red'){
		$data = "task_red='$id'";
	}
	else if($mid=='task_wr'){
		$data = "task_wr='$id'";
	}
	else if($mid=='task_del'){
		$data = "task_del='$id'";
	}
	else if($mid=='salary_red'){
		$data = "salary_red='$id'";
	}
	else if($mid=='salary_wr'){
		$data = "salary_wr='$id'";
	}
	else if($mid=='salary_del'){
		$data = "salary_del='$id'";
	}
	else
	{
		$data='';
	}
		$queryatleast = "update hr_fun_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
