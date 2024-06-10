<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }

$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
if($customerchechlogin_row['account_type']=='1'){
	$cont_hr_id = $customerchechlogin_id;
}
else{
	$cont_hr_id = $customerchechlogin_row['parent_admin'];
}
$sql_hr_req="select * from counter WHERE admin_id=$cont_hr_id";
$result_hr_req=mysqli_query($link,$sql_hr_req);
$list_hr_req=mysqli_fetch_array($result_hr_req);
$hr_id = $list_hr_req['id'];

if(isset($_POST['update']) || isset($_POST['add'])){
$budget_title = $_REQUEST['budget_title'];
$budget_type = $_REQUEST['budget_type'];
$budget_start_date = $_REQUEST['budget_start_date'];
$budget_end_date = $_REQUEST['budget_end_date'];
$tax_amount = $_REQUEST['tax_amount'];
$budgetid = $_REQUEST['budget_id'];
}


if(isset($_POST['add'])){


$querybord="insert into budgets (budget_title,budget_type,budget_start_date,budget_end_date,tax_amount,status,admin_id,ac_id) values('$budget_title','$budget_type','$budget_start_date','$budget_end_date','$tax_amount','1','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);
	$last_id = mysqli_insert_id($link);
	
foreach($_POST['revenue_title'] as $index => $revnue) {
		$revenue_amount =$_POST['revenue_amount'][$index];
  	$query1001 = "INSERT INTO revenues(revenue_title,revenue_amount,budget_id) values ('$revnue','$revenue_amount','$last_id')";
  mysqli_query($link,$query1001);
}
	
foreach($_POST['expenses_title'] as $index => $expenses) {
		$expenses_amount =$_POST['expenses_amount'][$index];
  	$query10011 = "INSERT INTO expenses(expenses_title,expenses_amount,budget_id) values ('$expenses','$expenses_amount','$last_id')";
  mysqli_query($link,$query10011);
}	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>budgets Add Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$query="update budgets SET budget_title='$budget_title',budget_type='$budget_type',budget_start_date='$budget_start_date',budget_end_date='$budget_end_date',tax_amount='$tax_amount' WHERE budget_id=$budgetid";
mysqli_query($link,$query);
	
	foreach($_POST['revenue_title'] as $index2 => $revnue2) {
		$revenue_amount =$_POST['revenue_amount'][$index2];
		$ider =$_POST['ider'][$index2];
		echo $revenue_title =$_POST['revenue_title'][$index2];
		
	if($ider){
  	$query100="update revenues SET revenue_title='$revenue_title',revenue_amount='$revenue_amount' WHERE revnue_id=$ider";
 mysqli_query($link,$query100);
		}
		else if(empty($revenue_title)){
  	$query="delete from revenues WHERE revnue_id=$ider";
mysqli_query($link,$query);
	}
		else
		{
			
		$query1001 = "INSERT INTO revenues(revenue_title,revenue_amount,budget_id) values ('$revenue_title','$revenue_amount','$budgetid')";
  mysqli_query($link,$query1001);
			
		}
	
	
}

foreach($_POST['expenses_title'] as $index3 => $revnue3) {
		$expenses_amount =$_POST['expenses_amount'][$index3];
		$ider2 =$_POST['ider2'][$index3];
		$expenses_title =$_POST['expenses_title'][$index3];
	echo $revnue3;
		
	if($ider2){
  	$query100="update expenses SET expenses_title='$expenses_title',expenses_amount='$expenses_amount' WHERE expensive_id=$ider2";
 mysqli_query($link,$query100);
		}
		else if(empty($expenses_title)){
  	$query="delete from expenses WHERE expensive_id=$ider2";
mysqli_query($link,$query);
	}
		else
		{
			
		$query1001 = "INSERT INTO expenses(expenses_title,expenses_amount,budget_id) values ('$expenses_title','$expenses_amount','$budgetid')";
  mysqli_query($link,$query1001);
			
		}
	
}
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>budgets Update Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from budgets WHERE budget_id=$del";
mysqli_query($link,$query);
$queryex="delete from expenses WHERE budget_id=$del";
mysqli_query($link,$queryex);
$queryrev="delete from revenues WHERE budget_id=$del";
mysqli_query($link,$queryrev);	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>budgets Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$sql_module_account_permission = "select * from account_fun_permission";
$result_account_permission = mysqli_query( $link, $sql_module_account_permission );
$list_account_permission = mysqli_fetch_array( $result_account_permission );
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
		
	
	?>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<?php include("include/header.php");?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include("include/sidebar.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Budgets</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Accounts</li>
								</ul>
							</div>
							<?php if($list_account_permission['budgets_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_categories"><i class="fa fa-plus"></i> Add Budgets</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>Budget No</th>
											<th>Budget Title</th>
											<th>Budget Type</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Total Revenue</th>
											<th>Total Expenses</th>
											<th>Tax Amount</th>
											<th>Budget Amount</th>
					                        <th class="text-right">Action</th>
					                    </tr>
									</thead>
									<tbody>
										<?php
										$k = 1;
										$totalrev='0';
										$totalexpensive='0';
										$checked ='';
												$checked1 ='';
										$SQDepart="select * from budgets WHERE  admin_id=$cont_hr_id and status='1' order by budget_id DESC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
											$budgetid = $ListDepart['budget_id'];
											if($ListDepart['budget_type']=='category'){
												$checked1 ='checked';
											}
											else if($ListDepart['budget_type']=='project'){
												$checked ='checked';
											}else{
												
											}
											
										?>
										<tr>
											<td><?php echo $k;?></td>
					                        <td><?php echo $ListDepart['budget_title'];?></td>
					                        <td><?php echo $ListDepart['budget_type'];?></td>
					                        <td><?php echo $ListDepart['budget_start_date'];?></td>
					                        <td><?php echo $ListDepart['budget_end_date'];?></td>
					                        <td>
											<?php 
											
											$SQLrevenue="select * from revenues WHERE budget_id='$budgetid'";
										$ResultRevenue=mysqli_query($link,$SQLrevenue);
										while($listrevenue=mysqli_fetch_array($ResultRevenue)){
										$totalrev = ($totalrev + $listrevenue['revenue_amount']);	
										} echo $totalrev; ?>
											</td>
					                        <td><?php 
											
											$SQLexpensive="select * from expenses WHERE budget_id='$budgetid'";
										$Resultexpensive=mysqli_query($link,$SQLexpensive);
										while($listexpensive=mysqli_fetch_array($Resultexpensive)){
										$totalexpensive = ($totalexpensive + $listexpensive['expenses_amount']);	
										} echo $totalexpensive; ?></td>
					                        <td><?php echo $ListDepart['tax_amount'];?></td>
					                        <td><?php echo $expectprofit = ($totalrev - $totalexpensive)-$ListDepart['tax_amount']; ?></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_account_permission['budgets_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_categories<?php echo $budgetid;?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_account_permission['budgets_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete<?php echo $budgetid;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td>
										</tr>
										
										<div class="modal custom-modal fade" id="edit_categories<?php echo $budgetid;?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Budget</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" action="budgets.php">
							<div class="form-group">
								<label>Budget Title</label>
								<input class="form-control" type="text" name="budget_title" placeholder="Budgets Title" value="<?php echo $ListDepart['budget_title'];?>">
							</div>

								<label>Choose Budget Respect Type</label>
							<div class="form-group">
								<div class="form-check form-check-inline">
								  <input class="form-check-input BudgetType" type="radio" name="budget_type" id="project1" value="project" <?php echo $checked;?> >
								  <label class="form-check-label" for="project1">Project</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input BudgetType" type="radio" name="budget_type" id="category" value="category"<?php echo $checked1;?>>
								  <label class="form-check-label" for="category">Category</label>
								</div>
						
							</div>

							<div class="form-group">
								<label>Start Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="budget_start_date" placeholder="Start Date" value="<?php echo $ListDepart['budget_start_date'];?>"></div>
							</div>
							<div class="form-group">
								<label>End Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="budget_end_date" placeholder="End Date" value="<?php echo $ListDepart['budget_end_date'];?>"></div>
							</div>

							<div class="form-group">
								<label>Expected Revenues</label>
							</div>
								<?php $ResultRevenue=mysqli_query($link,$SQLrevenue);
										while($listrevenue=mysqli_fetch_array($ResultRevenue)){
											?>
									<div class="boxdelete row">
									<input type="hidden" name="ider[]" value="<?php echo $listrevenue['revnue_id'];?>">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Revenue Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control RevenuETitle" value="<?php echo $listrevenue['revenue_title'];?>" placeholder="Revenue Title" name="revenue_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Revenue Amount <span class="text-danger">*</span></label>
											<input type="text" name="revenue_amount[]" placeholder="Amount" value="<?php echo $listrevenue['revenue_amount'];?>" class="form-control RevenuEAmount txtCal" autocomplete="off">
										</div>
									</div>
									<a href="#" id="<?php echo $listrevenue['revnue_id'];?>" class="remove-field3 btn-remove-customer kadelete"><i class="fa fa-minus-circle"></i></a>
									</div>
									<?php } ?>
								
							<div class="AllRevenuesClass" id="myTable">
								
								
								
							
								
								
								<div class="row customer_records3">
									
									
									<div class="col-sm-6">
										<div class="form-group">
											<label>Revenue Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control RevenuETitle" placeholder="Revenue Title" name="revenue_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Revenue Amount <span class="text-danger">*</span></label>
											<input type="text" name="revenue_amount[]" placeholder="Amount" class="form-control RevenuEAmount txtCal" autocomplete="off">
										</div>
									</div>
									
									
								</div>
								<div class="customer_records_dynamic3"></div>
								<div class="col-sm-4 mb-4">
									<div class="add-more">
											<a class="add_more_revenue extra-fields-customer3" title="Add Revenue" style="cursor: pointer;"><i class="fa fa-plus-circle"></i> Revenues</a>
										</div>
										
									</div>
								<div class="form-group">
								<label>Overall Revenues <span class="text-danger">(A)</span></label>
								<input class="form-control" type="text" name="overall_revenues" id="total_sum_value" placeholder="Overall Revenues" readonly="" value="<?php echo $totalrev;?>" style="cursor: not-allowed;">
							</div>
								
							</div>	
							

							<div class="form-group">
								<label>Expected Expenses</label>
							</div>
								
								<?php $Resultexpensive=mysqli_query($link,$SQLexpensive);
										while($listexpensive=mysqli_fetch_array($Resultexpensive)){
											?>
									<div class="boxdelete2 row">
									<input type="hidden" name="ider2[]" value="<?php echo $listexpensive['expensive_id'];?>">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Expenses Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control RevenuETitle" value="<?php echo $listexpensive['expenses_title'];?>" placeholder="Revenue Title" name="expenses_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Expenses Amount <span class="text-danger">*</span></label>
											<input type="text" name="expenses_amount[]" placeholder="Amount" value="<?php echo $listexpensive['expenses_amount'];?>" class="form-control RevenuEAmount txtCal2" autocomplete="off">
										</div>
									</div>
									<a href="#" id="<?php echo $listexpensive['expensive_id'];?>" class="remove-field3 btn-remove-customer chandel"><i class="fa fa-minus-circle"></i></a>
									
								</div>
									<?php } ?>
								
							<div class="AllExpensesClass" id="myTable2">
								
								
								
								

								
								<div class="row AlLExpenses customer_records4">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Expenses Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control EXpensesTItle" value="" placeholder="Expenses Title" name="expenses_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Expenses Amount <span class="text-danger">*</span></label>
											<input type="text" name="expenses_amount[]" placeholder="Amount" value="" class="form-control EXpensesAmount txtCal2" autocomplete="off">
										</div>
									</div>
									
								</div>
								<div class="customer_records_dynamic4"></div>
								<div class="col-sm-4 mb-4">
									<div class="add-more">
											<a class="add_more_revenue extra-fields-customer4" title="Add Revenue" style="cursor: pointer;"><i class="fa fa-plus-circle"></i> Expenses</a>
										</div>
										
									</div>
								
								
								<div class="form-group">
								<label>Overall Expense <span class="text-danger">(B)</span></label>
								<input class="form-control" type="text" name="overall_expenses" id="total_sum_value2" placeholder="Overall Expenses" readonly="" value="<?php echo $totalexpensive;?>" style="cursor: not-allowed;">
							</div>
								
								
							</div>

							


							<div class="form-group">
								<label>Expected Profit <span class="text-danger">( C = A - B )</span> </label>
								<input class="form-control" type="text" name="expected_profit" id="totalSum" placeholder="Expected Profit" readonly="" value="<?php echo $totalrev-$totalexpensive;?>" style="cursor: not-allowed;">
							</div>

							<div class="form-group">
								<label>Tax <span class="text-danger">(D)</span></label>
								<input class="form-control" type="text" name="tax_amount" id="tax_amount1" value="<?php echo $ListDepart['tax_amount'];?>" placeholder="Tax Amount">
							</div>

							<div class="form-group">
								<label>Budget Amount <span class="text-danger">( E = C - D )</span> </label>
								<input class="form-control" type="text" name="budget_amount" id="budget_amount1" placeholder="Budget Amount" readonly="" value="<?php echo $expectprofit = ($totalrev - $totalexpensive)-$ListDepart['tax_amount']; ?>" style="cursor: not-allowed;">
							</div>
							<div class="submit-section">
								<input type="hidden" name="budget_id" value="<?php echo $ListDepart['budget_id'];?>">
								<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
							</div>
						</form>
							</div>
						</div>
					</div>
				</div>
									
										
										<div class="modal custom-modal fade" id="delete<?php echo $budgetid;?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Department</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="budgets.php?del=<?php echo $ListDepart['budget_id'];?>" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
										
										
										<?php $k++; }?>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Modal -->
				<div class="modal custom-modal fade" id="add_categories" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Budget</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="budgets.php">
							<div class="form-group">
								<label>Budget Title</label>
								<input class="form-control" type="text" name="budget_title" placeholder="Budgets Title">
							</div>

								<label>Choose Budget Respect Type</label>
							<div class="form-group">
								<div class="form-check form-check-inline">
								  <input class="form-check-input BudgetType" type="radio" name="budget_type" id="project2" value="project">
								  <label class="form-check-label" for="project2">Project</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input BudgetType" type="radio" name="budget_type" id="category1" value="category">
								  <label class="form-check-label" for="category1">Category</label>
								</div>
						
							</div>

							<div class="form-group">
								<label>Start Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="budget_start_date" placeholder="Start Date"></div>
							</div>
							<div class="form-group">
								<label>End Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="budget_end_date" placeholder="End Date"></div>
							</div>

							<div class="form-group">
								<label>Expected Revenues</label>
							</div>
							<div class="AllRevenuesClass" id="myTable">
								
								<div class="row customer_records">
									
									
									<div class="col-sm-6">
										<div class="form-group">
											<label>Revenue Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control RevenuETitle" value="" placeholder="Revenue Title" name="revenue_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Revenue Amount <span class="text-danger">*</span></label>
											<input type="text" name="revenue_amount[]" placeholder="Amount" value="" class="form-control RevenuEAmount txtCal" autocomplete="off">
										</div>
									</div>
									
								</div>
								<div class="customer_records_dynamic"></div>
								<div class="col-sm-4 mb-4">
									<div class="add-more">
											<a class="add_more_revenue extra-fields-customer" title="Add Revenue" style="cursor: pointer;"><i class="fa fa-plus-circle"></i> Revenues</a>
										</div>
										
									</div>
								<div class="form-group">
								<label>Overall Revenues <span class="text-danger">(A)</span></label>
								<input class="form-control" type="text" name="overall_revenues" id="total_sum_value" placeholder="Overall Revenues" readonly="" style="cursor: not-allowed;">
							</div>
								
							</div>


									
							

							<div class="form-group">
								<label>Expected Expenses</label>
							</div>
							<div class="AllExpensesClass" id="myTable2">
								<div class="row AlLExpenses customer_records2">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Expenses Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control EXpensesTItle" value="" placeholder="Expenses Title" name="expenses_title[]" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Expenses Amount <span class="text-danger">*</span></label>
											<input type="text" name="expenses_amount[]" placeholder="Amount" value="" class="form-control EXpensesAmount txtCal2" autocomplete="off">
										</div>
									</div>
									
								</div>
								<div class="customer_records_dynamic2"></div>
								<div class="col-sm-4 mb-4">
									<div class="add-more">
											<a class="add_more_revenue extra-fields-customer2" title="Add Revenue" style="cursor: pointer;"><i class="fa fa-plus-circle"></i> Expenses</a>
										</div>
										
									</div>
								
								<div class="form-group">
								<label>Overall Expense <span class="text-danger">(B)</span></label>
								<input class="form-control" type="text" name="overall_expenses" id="total_sum_value2" placeholder="Overall Expenses" readonly="" style="cursor: not-allowed;">
							</div>
							</div>

							


							<div class="form-group">
								<label>Expected Profit <span class="text-danger">( C = A - B )</span> </label>
								<input class="form-control" type="text" name="expected_profit" id="totalSum" placeholder="Expected Profit" readonly="" style="cursor: not-allowed;">
							</div>

							<div class="form-group">
								<label>Tax <span class="text-danger">(D)</span></label>
								<input class="form-control" type="text" name="tax_amount" id="tax_amount1" placeholder="Tax Amount">
							</div>

							<div class="form-group">
								<label>Budget Amount <span class="text-danger">( E = C - D )</span> </label>
								<input class="form-control" type="text" name="budget_amount" id="budget_amount1" placeholder="Budget Amount" readonly="" style="cursor: not-allowed;">
							</div>
							<div class=" submit-section">
								<button type="submit" name="add" class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Modal -->

				<!-- Edit Modal -->
				
				<!-- /Edit Modal -->

				<!-- Delete Holiday Modal -->
				<div class="modal custom-modal fade" id="delete" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete </h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Holiday Modal -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(function() {
$(".kadelete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "backspoch.php",
   data: info,
	  _method: 'DELETE',
   success: function(){
 }
});
  $(this).parents(".boxdelete").animate({ backgroundColor: "blue" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
	
$(function() {
$(".chandel").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'edel=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "backspoch.php",
   data: info,
	  _method: 'DELETE',
   success: function(){
 }
});
  $(this).parents(".boxdelete2").animate({ backgroundColor: "blue" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
});	
	
</script>
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets\js\select2.min.js"></script>
		
		<!-- Datatable JS -->
		<script src="assets\js\jquery.dataTables.min.js"></script>
		<script src="assets\js\dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
<script src="assets/js/form-repeater.int.js"></script> 
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
		
		
		
		<script>
			

			
			
$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-field btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic > .single').attr("class", "row AlLRevenues remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});
			
			
			
$('.extra-fields-customer2').click(function() {
  $('.customer_records2').clone().appendTo('.customer_records_dynamic2');
  $('.customer_records_dynamic2 .customer_records2').addClass('single2 remove2');
  $('.single2 .extra-fields-customer2').remove();
  $('.single2').append('<a href="#" class="remove-field2 btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic2 > .single2').attr("class", "row AlLRevenues remove2");

  $('.customer_records_dynamic2 input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field2', function(e) {
  $(this).parent('.remove2').remove();
  e.preventDefault();
});
			

$('.extra-fields-customer3').click(function() {
  $('.customer_records3').clone().appendTo('.customer_records_dynamic3');
  $('.customer_records_dynamic3 .customer_records3').addClass('single3 remove3');
  $('.single3 .extra-fields-customer3').remove();
  $('.single3').append('<a href="#" class="remove-field3 btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic3 > .single3').attr("class", "row AlLRevenues remove3");

  $('.customer_records_dynamic3 input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field3', function(e) {
  $(this).parent('.remove3').remove();
  e.preventDefault();
});
			

$('.extra-fields-customer4').click(function() {
  $('.customer_records4').clone().appendTo('.customer_records_dynamic4');
  $('.customer_records_dynamic4 .customer_records4').addClass('single4 remove4');
  $('.single4 .extra-fields-customer4').remove();
  $('.single4').append('<a href="#" class="remove-field4 btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic4> .single4').attr("class", "row AlLRevenues remove4");

  $('.customer_records_dynamic4 input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field4', function(e) {
  $(this).parent('.remove4').remove();
  e.preventDefault();
});			
	
			
	</script>
		
		<script>
$(document).ready(function(){	
$("#myTable").on('input', '.txtCal', function () {
       var calculated_total_sum = 0;
     
       $("#myTable .txtCal").each(function () {
           var get_textbox_value = $(this).val();
           if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });
              $("#total_sum_value").val(calculated_total_sum);
       });
	
	$("#myTable2").on('input', '.txtCal2', function () {
       var calculated_total_sum = 0;
     
       $("#myTable2 .txtCal2").each(function () {
           var get_textbox_value = $(this).val();
           if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });
              $("#total_sum_value2").val(calculated_total_sum);
       });

});
			
	$(function() {
      $('input.txtCal2').keyup(function() {
            var sumget = parseFloat($('#total_sum_value').val()); // Or parseInt if integers only
            var sumret = parseFloat($('#total_sum_value2').val());
            $('#totalSum').val(sumget - sumret);
      });
});		
$(function() {
      $('input#tax_amount1').keyup(function() {
            var sum1 = parseFloat($('#totalSum').val()); // Or parseInt if integers only
            var sum2 = parseFloat($('#tax_amount1').val());
            $('#budget_amount1').val(sum1 - sum2);
      });
});	
	
</script>

    </body>
</html>