<?php
include( "config.php" );
$sql_module_hr="select * from account_fun_permission";
if ( isset( $_POST[ "id" ] ) ) {
	$id=$_POST[ "id" ];
	$mid=$_POST[ "mid" ];
$hr_empl_res=mysqli_query($link,$sql_module_hr);
$list_hr_empl=mysqli_fetch_array($hr_empl_res);
	$empid = $list_hr_empl['id'];
	if($mid=='categories_red'){
		$data = "categories_red='$id'";
	}
	else if($mid=='categories_wr'){
		$data = "categories_wr='$id'";
	}
	else if($mid=='categories_del'){
		$data = "categories_del='$id'";
	}
	else if($mid=='budgets_red'){
		$data = "budgets_red='$id'";
	}
	else if($mid=='budgets_wr'){
		$data = "budgets_wr='$id'";
	}
	else if($mid=='budgets_del'){
		$data = "budgets_del='$id'";
	}
	else if($mid=='expenses_red'){
		$data = "expenses_red='$id'";
	}
	else if($mid=='expenses_wr'){
		$data = "expenses_wr='$id'";
	}
	else if($mid=='expenses_del'){
		$data = "expenses_del='$id'";
	}
	else if($mid=='revenues_red'){
		$data = "revenues_red='$id'";
	}
	else if($mid=='revenues_wr'){
		$data = "revenues_wr='$id'";
	}
	else if($mid=='revenues_del'){
		$data = "revenues_del='$id'";
	}
	else if($mid=='estimates_red'){
		$data = "estimates_red='$id'";
	}
	else if($mid=='estimates_wr'){
		$data = "estimates_wr='$id'";
	}
	else if($mid=='estimates_del'){
		$data = "estimates_del='$id'";
	}
	else if($mid=='invoice_red'){
		$data = "invoice_red='$id'";
	}
	else if($mid=='invoice_wr'){
		$data = "invoice_wr='$id'";
	}
	else if($mid=='invoice_del'){
		$data = "invoice_del='$id'";
	}
	else if($mid=='payments_red'){
		$data = "payments_red='$id'";
	}
	else if($mid=='payments_wr'){
		$data = "payments_wr='$id'";
	}
	else if($mid=='payments_del'){
		$data = "payments_del='$id'";
	}
	else if($mid=='taxes_red'){
		$data = "taxes_red='$id'";
	}
	else if($mid=='taxes_wr'){
		$data = "taxes_wr='$id'";
	}
	else if($mid=='taxes_del'){
		$data = "taxes_del='$id'";
	}
	else if($mid=='leaves_red'){
		$data = "leaves_red='$id'";
	}
	else if($mid=='leaves_wr'){
		$data = "leaves_wr='$id'";
	}
	else if($mid=='leaves_del'){
		$data = "leaves_del='$id'";
	}
	else
	{
		$data='';
	}
		$queryatleast = "update account_fun_permission SET $data WHERE id='$empid'";
      mysqli_query( $link, $queryatleast );
	
 } ?>
