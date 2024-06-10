<?php
include( "config.php" );
$sql_module_hr="select * from hr_module_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='employes'){
		$data = "employes='$id'";
	}
	else if($mid=='clients'){
		$data = "clients='$id'";
	}
	else if($mid=='project'){
		$data = "project='$id'";
	}
	else if($mid=='payroll'){
		$data = "payroll='$id'";
	}
	else if($mid=='gratuity'){
		$data = "gratuity='$id'";
	}
	else if($mid=='request'){
		$data = "request='$id'";
	}
	else
	{
		$data='';
	}
		$queryatleast = "update hr_module_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
