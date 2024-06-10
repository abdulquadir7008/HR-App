<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:user-login.php");
ob_end_flush();	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
$userID = $customerchechlogin_row['id'];
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


$sql_module_account_permission = "select * from account_fun_permission";
$result_account_permission = mysqli_query( $link, $sql_module_account_permission );
$list_account_permission = mysqli_fetch_array( $result_account_permission );


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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Cancel Leaves</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Cancel Leaves</li>
								</ul>
							</div>
							<?php if($list_account_permission['leaves_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Cancel Leave Application</a>
							</div>
							 <?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Leave Statistics -->
					
					<!-- /Leave Statistics -->
					
					
									
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											
											<th>Leave Type</th>
											<th>From</th>
											<th>To</th>
											<th>No of Days</th>
											<th>Reason</th>
											<th class="text-center">Status</th>
											<th	>Aproved by</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										
										
	<?php
	$leave_tbl_sql="select * from cancel_leave_tbl LEFT JOIN users ON cancel_leave_tbl.user_employee=users.id where admin_id='$cont_hr_id'";
		$leave_tbl_result=mysqli_query($link,$leave_tbl_sql);
			while($leave_tbl_row = mysqli_fetch_array($leave_tbl_result)){
				$acounttype= $leave_tbl_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

				$leave_date_from = str_replace('/', '-', $leave_tbl_row['date_from']);
				$leave_date_to = str_replace('/', '-', $leave_tbl_row['date_to']);
				$date70 = date_create($leave_date_from);
				$date80 = date_create($leave_date_to);
				$diff = date_diff($date70,$date80);
				
				
		?>
										<tr>
											
											<td><?php 
												$spllevid = $leave_tbl_row['leave_type'];
				 									$leave_tbl2_sql="select * from leave_type WHERE leave_id='$spllevid'";
														$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
															$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
																echo $leave_tbl2_row['leave_type'];
												?></td>
											<td><?php echo date("d M Y", strtotime($leave_date_from));?></td>
											<td><?php echo date("d M Y", strtotime($leave_date_to));?></td>
											<td><?php echo $diff->format("%a");?> days</td>
											<td><?php echo $leave_tbl_row['leave_reason'];?></td>
											<td class="text-center">
			<div class="dropdown action-label">
					<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
					<?php if($leave_tbl_row['lb_status'] == '1'){?>									
					<i class="fa fa-dot-circle-o text-success"></i> Approved</a>
					<?php } else if($leave_tbl_row['lb_status'] == '2'){?>
						<i class="fa fa-dot-circle-o text-info"></i> Pending</a>
						<?php } else if($leave_tbl_row['lb_status'] == '0'){?>
							<i class="fa fa-dot-circle-o text-danger"></i> Declined</a>
							<?php } ?>


													</a>
													
												</div>
											</td>
											<td>
												<?php if($leave_tbl_row['lb_status'] == '1'){
												$sql_type700="select * from counter LEFT JOIN users ON counter.id=users.account_type WHERE primary_role='hr'";
													$ressql700=mysqli_query($link,$sql_type700);
														$listsqltype700=mysqli_fetch_array($ressql700);
												?>	
												<h2 class="table-avatar">
													<a class="avatar">
														
													<?php if($listsqltype700['image']!='') { ?>
										<img src="uploads/<?php echo $listsqltype700['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
														</a>
													<a><?php echo $listsqltype700['fullname'];?> <span>
													<?php echo $listsqltype700['countr'];?> 
													</span></a>
												</h2>
												<?php } ?>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_account_permission['leaves_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave<?php echo $leave_tbl_row['leave_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_account_permission['leaves_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve<?php echo $leave_tbl_row['leave_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td>
											
										</tr>

										<div class="modal custom-modal fade" id="delete_approve<?php echo $leave_tbl_row['leave_id'];?>" role="dialog">
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
											<a href="script/cancel_leave_script.php?del=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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


										<div class="modal custom-modal fade" id="approve_leave<?php echo $leave_tbl_row['leave_id'];?>" role="dialog">
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
<a href="script/cancel_leave_script.php?aprove=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary continue-btn">Approve</a>
										</div>
										<div class="col-6">
<a href="script/cancel_leave_script.php?decline=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary cancel-btn">Decline</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div id="edit_leave<?php echo $leave_tbl_row['leave_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Leave</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form form action="script/cancel_leave_script.php" name="Registerform" enctype="multipart/form-data" method="post">
							<div class="form-group">
								
									<label class="bmd-label-floating">Leave Type <span class="text-danger">*</span></label>
                        <select name="leave_type" class="form-control" required>
                          <option value="">Select Leave Type</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from leave_type where user_id='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){


	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['leave_id']; ?>" <?php if ($leave_tbl2_row['leave_id']==$leave_tbl_row['leave_type']){?>selected<?php } ?> ><?php echo $leave_tbl2_row['leave_type']; ?></option>
                        <?php }?>
                          
                        </select>
						</div>		
							
									<div class="form-group">
										<label>From <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" value="<?php echo $leave_tbl_row['date_from'];?>" name="date_from" type="text" required>
										</div>
									</div>
									<div class="form-group">
										<label>To <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" value="<?php echo $leave_tbl_row['date_to'];?>" name="date_to" type="text" required>
										</div>
									</div>
									
									
									<div class="form-group">
										<label>Leave Reason <span class="text-danger">*</span></label>
										<textarea rows="4" name="leave_reason" class="form-control" required><?php echo $leave_tbl_row['leave_reason'];?></textarea>
									</div>
									<div class="submit-section">
									<input type="hidden" value="<?php echo $leave_tbl_row['leave_id'];?>" name="leave_id">
										<button class="btn btn-primary submit-btn" type="submit" name="upd_leave">Submit</button>
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
				
				<!-- Add Leave Modal -->
				<div id="add_leave" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Cancel Leave</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form form action="script/cancel_leave_script.php" name="Registerform" enctype="multipart/form-data" method="post">
							<div class="form-group">
									<label class="bmd-label-floating">Leave Type <span class="text-danger">*</span></label>
								<input type="hidden" name="user_employee" value="<?php echo $customerchechlogin_id;?>">
                        <select name="leave_type" class="form-control" required>
                          <option value="">Select Leave Type</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from leave_type where user_id='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){


	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['leave_id']; ?>"><?php echo $leave_tbl2_row['leave_type']; ?></option>
                        <?php }?>
                          
                        </select>
						</div>		
							
									<div class="form-group">
										<label>From <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" name="date_from" type="text" required>
										</div>
									</div>
									<div class="form-group">
										<label>To <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" name="date_to" type="text" required>
										</div>
									</div>
									
									
									<div class="form-group">
										<label>Leave Reason <span class="text-danger">*</span></label>
										<textarea rows="4" name="leave_reason" class="form-control" required></textarea>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add_leave">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Leave Modal -->
				
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