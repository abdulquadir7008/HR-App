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

if(isset($_POST['add'])){
$taxe_name = $_REQUEST['taxe_name'];
$tax_perctange = $_REQUEST['tax_perctange'];
$status = $_REQUEST['status'];
$querybord="insert into taxes (taxe_name,tax_perctange,status,admin_id,ac_id) values('$taxe_name','$tax_perctange','$status','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Tax Add Successfully.</span></div>";
$errflag = true;
$_SESSION['taxeserror'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$taxe_name = $_REQUEST['taxe_name'];
$tax_perctange = $_REQUEST['tax_perctange'];
$status = $_REQUEST['status'];
$taxes_id = $_REQUEST['taxes_id'];
$query="update taxes SET taxe_name='$taxe_name',tax_perctange='$tax_perctange',status='$status' WHERE taxes_id=$taxes_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Tax Update Successfully.</span></div>";
$errflag = true;
$_SESSION['taxeserror'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from taxes WHERE taxes_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Tax Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['taxeserror'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['act']))
{
	$act=$_REQUEST['act'];
	$query="update taxes SET status='1' WHERE taxes_id=$act";
mysqli_query($link,$query);
	$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Tax Active Successfully.</span></div>";
$errflag = true;
$_SESSION['taxeserror'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['inact']))
{
	$inact=$_REQUEST['inact'];
	$query="update taxes SET status='0' WHERE taxes_id=$inact";
mysqli_query($link,$query);
	$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Tax In Active Successfully.</span></div>";
$errflag = true;
$_SESSION['taxeserror'] = $errmsg_arr;
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
if( isset($_SESSION['taxeserror']) && is_array($_SESSION['taxeserror']) && count($_SESSION['taxeserror']) >0 ) {
foreach($_SESSION['taxeserror'] as $msg) {
echo $msg;  
}
unset($_SESSION['taxeserror']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Taxes</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Taxes</li>
								</ul>
							</div>
							<?php if($list_account_permission['taxes_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_tax"><i class="fa fa-plus"></i> Add Tax</a>
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
											<th>#</th>
											<th>Tax Name </th>
											<th>Tax Percentage (%) </th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$k = 1;
										$SQDepart="select * from taxes where admin_id=$cont_hr_id order by taxes_id DESC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
										?>
										<tr>
											<td><?php echo $k;?></td>
											<td><?php echo $ListDepart['taxe_name'];?></td>
											<td><?php echo $ListDepart['tax_perctange'];?>%</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<?php if($ListDepart['status'] == '0'){?>
														<i class="fa fa-dot-circle-o text-danger"></i> Inactive
														<?php } else{?>
														<i class="fa fa-dot-circle-o text-success"></i> Active
														<?php } ?>
													</a>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="taxes.php?act=<?php echo $ListDepart['taxes_id'];?>"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="taxes.php?inact=<?php echo $ListDepart['taxes_id'];?>"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_account_permission['taxes_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_tax<?php echo $ListDepart['taxes_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_account_permission['taxes_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_tax<?php echo $ListDepart['taxes_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td>
										</tr>
										
					<div id="edit_tax<?php echo $ListDepart['taxes_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Tax</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="taxes.php">
									<div class="form-group">
										<label>Tax Name <span class="text-danger">*</span></label>
										<input class="form-control" name="taxe_name" type="text" value="<?php echo $ListDepart['taxe_name'];?>" required>
									</div>
									<div class="form-group">
										<label>Tax Percentage (%) <span class="text-danger">*</span></label>
										<input class="form-control" name="tax_perctange" value="<?php echo $ListDepart['tax_perctange'];?>" type="text" required>
									</div>
									<div class="form-group">
										<label>Status <span class="text-danger">*</span></label><br>
										<select class="select" name="status">
											<option value="0" <?php if($ListDepart['status'] == '0'){?>selected<?php } ?> >Pending</option>
											<option value="1" <?php if($ListDepart['status'] == '1'){?>selected<?php } ?>>Approved</option>
										</select>
									</div>
									<div class="submit-section">
										<input type="hidden" name="taxes_id" value="<?php echo $ListDepart['taxes_id'];?>">
										<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
										
										<div class="modal custom-modal fade" id="delete_tax<?php echo $ListDepart['taxes_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Tax</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="taxes.php?del=<?php echo $ListDepart['taxes_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
										
										<?php $k++; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Tax Modal -->
				<div id="add_tax" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Tax</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="taxes.php">
									<div class="form-group">
										<label>Tax Name <span class="text-danger">*</span></label>
										<input class="form-control" name="taxe_name" type="text" required>
									</div>
									<div class="form-group">
										<label>Tax Percentage (%) <span class="text-danger">*</span></label>
										<input class="form-control" name="tax_perctange" type="text" required>
									</div>
									<div class="form-group">
										<label>Status <span class="text-danger">*</span></label>
										<select class="select" name="status">
											<option value="0">Pending</option>
											<option value="1">Approved</option>
										</select>
									</div>
									<div class="submit-section">
										<button type="submit" name="add" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Tax Modal -->
				
				<!-- Edit Tax Modal -->
				
				<!-- /Edit Tax Modal -->
				
				<!-- Delete Tax Modal -->
				
				<!-- /Delete Tax Modal -->
				
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

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>