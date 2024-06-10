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
$noted = $_REQUEST['noted'];
$amount = $_REQUEST['amount'];
$expense_date = $_REQUEST['expense_date'];
$category = $_REQUEST['category'];
$expensive_id = $_REQUEST['expensive_id'];

if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="$path0".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}	

	
}


if(isset($_POST['add'])){


$querybord="insert into budget_expensive (noted,amount,expense_date,category,image,status,admin_id,ac_id) values('$noted','$amount','$expense_date','$category','$image0','1','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Expenses Add Successfully.</span></div>";
$errflag = true;
$_SESSION['budget_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$query="update budget_expensive SET noted='$noted',amount='$amount',expense_date='$expense_date',category='$category',image='$image0' WHERE expensive_id=$expensive_id";
mysqli_query($link,$query);
	
	
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Expenses Update Successfully.</span></div>";
$errflag = true;
$_SESSION['budget_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from budget_expensive WHERE expensive_id=$del";
mysqli_query($link,$query);

	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Expenses Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['budget_expensive'] = $errmsg_arr;
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
				<?php
if( isset($_SESSION['budget_expensive']) && is_array($_SESSION['budget_expensive']) && count($_SESSION['budget_expensive']) >0 ) {
foreach($_SESSION['budget_expensive'] as $msg) {
echo $msg;  
}
unset($_SESSION['budget_expensive']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Budgets Expenses</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Accounts</li>
								</ul>
							</div>
							<?php if($list_account_permission['expenses_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_categories"><i class="fa fa-plus"></i> Add Expenses</a>
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
											<th>No</th>
											<th>Notes</th>                    
											<th>Category Name</th>
											<th>Attached</th>
											<th>Amount</th>
											<th>Expenses Date</th>
					                        <th class="text-right">Action</th>
					                    </tr>
									</thead>
									<tbody>
										<?php
										$k = 1;
										$SQDepart="select * from budget_expensive WHERE admin_id=$cont_hr_id and status='1' order by expensive_id DESC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
											?>
										<tr>
											<td><?php echo $k;?></td>
					                        <td><?php echo $ListDepart['noted'];?></td>
					                        <td><?php $cat_parent = $ListDepart['category'];
												$SQLrevenue="select * from ac_category WHERE ac_cat_id='$cat_parent'";
													$ResultRevenue=mysqli_query($link,$SQLrevenue);
														$listrevenue=mysqli_fetch_array($ResultRevenue);
											echo $listrevenue['catname'];
												?></td>
					                        <td><img src="uploads/<?php echo $ListDepart['image'];?>" width="50"></td>
					                        <td><?php echo $ListDepart['amount'];?></td>
                       						<td><?php echo $ListDepart['expense_date'];?></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_account_permission['expenses_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_categories<?php echo $ListDepart['expensive_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_account_permission['expenses_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete<?php echo $ListDepart['expensive_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td>
										</tr>
										
										<div class="modal custom-modal fade" id="edit_categories<?php echo $ListDepart['expensive_id'];?>" role="dialog">
				    <div class="modal-dialog modal-dialog-centered" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h5 class="modal-title">Edit Expenses</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
								<form method="post" action="budget_expenses.php" enctype="multipart/form-data">
				                <div class="form-group form-row">
				                    
				                    <div class="col-lg-6">
										<label class="col-lg-12 control-label">Amount <span class="text-danger">*</span></label>
				                        <input type="text" class="form-control" name="amount" value="<?php echo $ListDepart['amount'];?>">
				                    </div>
				                    <div class="col-lg-6">
				                         <label class="col-lg-12 control-label">Expense Date <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <input class="datetimepicker form-control" type="text" name="expense_date" value="<?php echo $ListDepart['expense_date'];?>">
				                    </div>
				                    </div>
				                </div>
				                <div class="form-group form-row">
				                    <label class="col-lg-12 control-label">Notes <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <textarea class="form-control ta" name="noted"><?php echo $ListDepart['noted'];?></textarea>
				                    </div>
				                </div>
				               
				                <div class="form-group form-row">
				                    <label class="col-lg-12 control-label">Category <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <select name="category" class="form-control m-b" id="main_category">
				                            <option value="" disabled="" selected="">Choose Category</option>
				                           <?php
											$SqlExpensive="select * from ac_category order by catname ASC";
												$MysqlExpensive=mysqli_query($link,$SqlExpensive);
													while($ResultExpensive=mysqli_fetch_array($MysqlExpensive)){
											?>
									<option value="<?php echo $ResultExpensive['ac_cat_id'];?>" <?php if($ListDepart['category'] == $ResultExpensive['ac_cat_id']){?>selected<?php } ?> ><?php echo $ResultExpensive['catname'];?></option>
				                           <?php } ?>
				                        </select>
				                    </div>
				                </div>
				                		
				                <div class="form-group form-row  position-relative">
				                    <label class="col-lg-12 control-label">Attach File</label>
									
									<input type="file" class="upload" name="image"/>
									<input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
				                    <div class="col-md-12 mt-3">
									<?php if($ListDepart['image']!='') { ?>
                      <img class="inline-block" src="uploads/<?php echo $ListDepart['image'];?>" width="80" />
                      <?php }?>
										</div>
				                </div>
				                <div class="submit-section">
									<input type="hidden" name="expensive_id" value="<?php echo $ListDepart['expensive_id'];?>">
				                    <button name="update" type="submit" class="btn btn-primary submit-btn">Update</button>
				                </div>
								</form>
				            </div>
				        </div>
				    </div>
				</div>
										<div class="modal custom-modal fade" id="delete<?php echo $ListDepart['expensive_id'];?>" role="dialog">
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
											<a href="budget_expenses.php?del=<?php echo $ListDepart['expensive_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
				                <h5 class="modal-title">Add Expenses</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
								<form method="post" action="budget_expenses.php" enctype="multipart/form-data">
				                <div class="form-group form-row">
				                    
				                    <div class="col-lg-6">
										<label class="col-lg-12 control-label">Amount <span class="text-danger">*</span></label>
				                        <input type="text" class="form-control" name="amount">
				                    </div>
				                    <div class="col-lg-6">
				                         <label class="col-lg-12 control-label">Expense Date <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <input class="datetimepicker form-control" type="text" name="expense_date">
				                    </div>
				                    </div>
				                </div>
				                <div class="form-group form-row">
				                    <label class="col-lg-12 control-label">Notes <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <textarea class="form-control ta" name="noted"></textarea>
				                    </div>
				                </div>
				               
				                <div class="form-group form-row">
				                    <label class="col-lg-12 control-label">Category <span class="text-danger">*</span></label>
				                    <div class="col-lg-12">
				                        <select name="category" class="form-control m-b" id="main_category">
				                            <option value="" disabled="" selected="">Choose Category</option>
				                           <?php
											$SqlExpensive="select * from ac_category order by catname ASC";
												$MysqlExpensive=mysqli_query($link,$SqlExpensive);
													while($ResultExpensive=mysqli_fetch_array($MysqlExpensive)){
											?>
									<option value="<?php echo $ResultExpensive['ac_cat_id'];?>"><?php echo $ResultExpensive['catname'];?></option>
				                           <?php } ?>
				                        </select>
				                    </div>
				                </div>
				                		
				                <div class="form-group form-row  position-relative">
				                    <label class="col-lg-12 control-label">Attach File</label>
				                    <div class="col-lg-12">
				                        
				                        <input type="file" class="form-control" name="image">
										
				                    </div>
				                </div>
				                <div class="submit-section">
				                    <button name="add" type="submit" class="btn btn-primary submit-btn">Submit</button>
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
				
				<!-- /Delete Holiday Modal -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>

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
		
		
		
		
		
		
		
		

    </body>
</html>