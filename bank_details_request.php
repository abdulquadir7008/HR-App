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

if(isset($_REQUEST['upd_leave']))
{
$bank_name=$_POST['bank_name'];
$bank_no=$_POST['bank_no'];
$ifsc_code=$_POST['ifsc_code'];
$pan_no=$_POST['pan_no'];
$old_bank_details=$_POST['old_bank_details'];
$bk_id=$_POST['bk_id'];
$profile_id=$_POST['profile_id'];	

$query="update bank_details SET bank_name='$bank_name',bank_no='$bank_no',ifsc_code='$ifsc_code',
profile_id='$profile_id',pan_no='$pan_no',old_bank_details='$old_bank_details' WHERE bk_id=$bk_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> Data modified Successfully.</span></div>";
$errflag = true;
$_SESSION['emegency_contact_error'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="update bank_details SET del='1' WHERE bk_id=$del";
mysqli_query($link,$query);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Delete - </b>Salary Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['emegency_contact_error'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['aprove']))
{
$aprove=$_REQUEST['aprove'];
$query="update bank_details SET status='1' WHERE bk_id=$aprove";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['decline']))
{
$decline=$_REQUEST['decline'];
$query="update bank_details SET status='0' WHERE bk_id=$decline";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
	$employe_id = '33';
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
if( isset($_SESSION['emegency_contact_error']) && is_array($_SESSION['emegency_contact_error']) && count($_SESSION['emegency_contact_error']) >0 ) {
foreach($_SESSION['emegency_contact_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['emegency_contact_error']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Emergency Contact Request</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Data List</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					
									
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											
											<th>Employee name</th>
											<th>Bank Name</th>
											<th>Bank Account no</th>
											<th	>IBAN  Code </th>
											<th	>Branch Name </th>
											<th	>Old Bank Details </th>
											<th	>Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										
										
	<?php
	$leave_tbl_sql="select * from bank_details where admin_id=$cont_hr_id and del='0'";
		$leave_tbl_result=mysqli_query($link,$leave_tbl_sql);
			while($leave_tbl_row = mysqli_fetch_array($leave_tbl_result)){
				$employessID = $leave_tbl_row['profile_id'];
				$leave_tbl2_sql="select * from users where id='$employessID'";
					$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
						$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);	
				
				
		?>
										<tr>
											<td><?php echo $leave_tbl2_row['fullname'];?></td>
											<td><?php echo $leave_tbl_row['bank_name'];?></td>
											<td><?php echo $leave_tbl_row['bank_no'];?></td>
											<td><?php echo $leave_tbl_row['ifsc_code'];?></td>
											<td><?php echo $leave_tbl_row['pan_no'];?></td>
											<td><?php echo $leave_tbl_row['old_bank_details'];?></td>
											<td>
											<div class="dropdown action-label">
					<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
					<?php if($leave_tbl_row['status'] == '1'){?>									
					<i class="fa fa-dot-circle-o text-success"></i> Approved</a>
					<?php }  else if($leave_tbl_row['status'] == '0'){?>
							<i class="fa fa-dot-circle-o text-info"></i> Pending</a>
							<?php } ?>


													</a>
													<div class="dropdown-menu dropdown-menu-right">
														
<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $leave_tbl_row['bk_id'];?>"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>

													</div>
												</div>
											</td>
											
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave<?php echo $leave_tbl_row['bk_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve<?php echo $leave_tbl_row['bk_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														
													</div>
												</div>
											</td>
											
										</tr>

										<div class="modal custom-modal fade" id="delete_approve<?php echo $leave_tbl_row['bk_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Leave</h3>
									<p>Are you sure want to delete this leave?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="bank_details_request.php?del=<?php echo $leave_tbl_row['bk_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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


										<div class="modal custom-modal fade" id="approve_leave<?php echo $leave_tbl_row['bk_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Leave Approve</h3>
									<p>Are you sure want to approve for this leave?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
<a href="bank_details_request.php?aprove=<?php echo $leave_tbl_row['bk_id'];?>" class="btn btn-primary continue-btn">Approve</a>
										</div>
										<div class="col-6">
<a href="bank_details_request.php?decline=<?php echo $leave_tbl_row['bk_id'];?>" class="btn btn-primary cancel-btn">Decline</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div id="edit_leave<?php echo $leave_tbl_row['bk_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit User Bank Details</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form form action="bank_details_request.php" name="Registerform" enctype="multipart/form-data" method="post">
								<div class="form-group">
                          <h5>CURRENT BANK DETAILS</h5>
                          	<p>
							Bank Name : <?php echo $leave_tbl_row['bank_name'];?><br>
							Bank account No : <?php echo $leave_tbl_row['bank_no'];?><br>
							IBAN Code : <?php echo $leave_tbl_row['ifsc_code'];?><br>
							Branch Name : <?php echo $leave_tbl_row['pan_no'];?>
							</p>
							
                       
                      </div>
							<div class="form-group">
								
									<label class="bmd-label-floating">Bank Details <span class="text-danger">*</span></label>
                        <select name="profile_id" class="form-control" required>
                          <option value="<?php echo $leave_tbl_row['profile_id'];?>"><?php echo $leave_tbl2_row['fullname'];?></option>
                          
                          
                        </select>
						</div>		
							
							<div class="row">
								
                <div class="col-md-6">
					
                  <div class="form-group">
                    <label>Bank name</label>
                    <input type="text" name="bank_name" value="<?php echo $leave_tbl_row['bank_name']?>" class="form-control">
                  </div>
                </div>
								
											
				<div class="col-md-6">
                  <div class="form-group">
                    <label>Bank account No.</label>
                   
                      <input class="form-control" name="bank_no" value="<?php echo $leave_tbl_row['bank_no']?>" type="text">
                   
                  </div>
                </div>
					
								
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>IFSC Code</label>
                    <input class="form-control" name="ifsc_code" value="<?php echo $leave_tbl_row['ifsc_code']?>" type="text">
                  </div>
                </div>
								 <div class="col-md-6">
                  <div class="form-group">
                    <label>PAN No</label>
                    <input class="form-control" name="pan_no" value="<?php echo $leave_tbl_row['pan_no']?>" type="text">
                  </div>
                </div>
                
                
                
                
                
              </div>		
							
									
									
									
									<div class="submit-section">
									<input type="hidden" value="<?php echo $leave_tbl_row['bk_id'];?>" name="bk_id">
										<button class="btn btn-primary submit-btn" type="submit" name="upd_leave">Update</button>
									</div>
								</form>
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
				
				
				
				<!-- Edit Leave Modal -->
				
				<!-- /Edit Leave Modal -->

				<!-- Approve Leave Modal -->
				
				<!-- /Approve Leave Modal -->
				
				<!-- Delete Leave Modal -->
				
				<!-- /Delete Leave Modal -->
				
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