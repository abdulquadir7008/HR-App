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
$adminAcType = $customerchechlogin_row['account_type'];

if(isset($_POST['add'])){
$leave_type = $_REQUEST['leave_type'];
$number_of_day = $_REQUEST['number_of_day'];
$querybord="insert into leave_type (leave_type,number_of_day,user_id,user_type,status) values('$leave_type','$number_of_day','$customerchechlogin_id','1','1')";
mysqli_query($link,$querybord);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Leave Type Add Successfully.</span></div>";
$errflag = true;
$_SESSION['leaveadd'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$leave_type = $_REQUEST['leave_type'];
$number_of_day = $_REQUEST['number_of_day'];
$leave_id = $_REQUEST['leave_id'];
$query="update leave_type SET leave_type='$leave_type',number_of_day='$number_of_day' WHERE leave_id=$leave_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Leave Type Update Successfully.</span></div>";
$errflag = true;
$_SESSION['leaveadd'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from leave_type WHERE leave_id=$del";
mysqli_query($link,$query);	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Leave Type Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['leaveadd'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
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
            <?php include("include/sidebar2.php");?>
			<!-- Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Leave Type</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Leave Type</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leavetype"><i class="fa fa-plus"></i> Add Leave Type</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<?php
if( isset($_SESSION['leaveadd']) && is_array($_SESSION['leaveadd']) && count($_SESSION['leaveadd']) >0 ) {
foreach($_SESSION['leaveadd'] as $msg) {
echo $msg;  
}
unset($_SESSION['leaveadd']); }?>
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable mb-0">
									<thead>
										<tr>
											
											<th>Leave Type</th>
											<th>Leave Days</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$SQLeaveType="select * from leave_type WHERE user_id='$customerchechlogin_id' and status='1'";
										$ResultLeaveType=mysqli_query($link,$SQLeaveType);
										while($ListTypeLV=mysqli_fetch_array($ResultLeaveType)){
										?>
										<tr>
											
											<td><?php echo $ListTypeLV['leave_type'];?></td>
											<td><?php echo $ListTypeLV['number_of_day'];?></td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<i class="fa fa-dot-circle-o text-success"></i> Active
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="#" class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a href="#" class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leavetype<?php echo $ListTypeLV['leave_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_leavetype<?php echo $ListTypeLV['leave_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										
										<div id="edit_leavetype<?php echo $ListTypeLV['leave_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Leave Type</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="leave-type.php">
									<div class="form-group">
										<label>Leave Type <span class="text-danger">*</span></label>
										<input class="form-control" name="leave_type" type="text" value="<?php echo $ListTypeLV['leave_type'];?>">
									</div>
									<div class="form-group">
										<label>Number of days <span class="text-danger">*</span></label>
										<input class="form-control" name="number_of_day" type="text" value="<?php echo $ListTypeLV['number_of_day'];?>">
									</div>
									<div class="submit-section">
										<input type="hidden" name="leave_id" value="<?php echo $ListTypeLV['leave_id'];?>">
										<button class="btn btn-primary submit-btn" type="submit" name="update">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
										
										<div class="modal custom-modal fade" id="delete_leavetype<?php echo $ListTypeLV['leave_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Leave Type</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="leave-type.php?del=<?php echo $ListTypeLV['leave_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Leavetype Modal -->
				<div id="add_leavetype" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Leave Type</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="leave-type.php">
									<div class="form-group">
										<label>Leave Type <span class="text-danger">*</span></label>
										<input class="form-control" name="leave_type" type="text">
									</div>
									<div class="form-group">
										<label>Number of days <span class="text-danger">*</span></label>
										<input class="form-control" name="number_of_day" type="text">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Leavetype Modal -->
				
			
				
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

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>