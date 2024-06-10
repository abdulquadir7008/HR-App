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
$sql_module_hr_permission = "select * from hr_fun_permission";
$result_hr_permission = mysqli_query( $link, $sql_module_hr_permission );
$list_hr_permission = mysqli_fetch_array( $result_hr_permission );

?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
		
	if(isset($_REQUEST['search_crm'])){
		$search_employe = $_REQUEST['search_employe'];
		
		if(isset($_REQUEST['search_status'])){
		if($_REQUEST['search_status']!=''){
			$search_status = $_REQUEST['search_status'];
		echo $btnsrst = "AND lb_status LIKE '%$search_status%'";
		}else{
			echo $btnsrst='';
		}
	}
		if(isset($_REQUEST['from_search']) && isset($_REQUEST['to_search']) ){
		
			if($_REQUEST['from_search']!='' && $_REQUEST['to_search']!=''){
			$from_search = $_REQUEST['from_search'];
		$to_search =$_REQUEST['to_search'];
			
		$bwch = "AND date_from between '".$from_search."' AND '".$to_search."'";
	}
		else
		{$bwch = '';}
	}
	}
	else if(isset($_REQUEST['reset'])){
		$from_search='';
		$to_search = '';
		$bwch = '';
	}
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
								<h3 class="page-title">Leaves</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Leaves</li>
								</ul>
							</div>
							<?php if($list_hr_permission['leave_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Leave Statistics -->
					<div class="row">
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Today Presents</h6>
								<h4>
									<?php
									$current_date = date("d/m/Y");
									$leavtrq="select * from leave_tbl where admin_id='$cont_hr_id' and lb_status!='' and date_from='$current_date'";
									$sqlleavtrk=mysqli_query($link,$leavtrq);
									$leave_tbl_sql="select * from users where account_type!='1' and parent_admin='$cont_hr_id'";
									$leave_tbl_result=mysqli_query($link,$leave_tbl_sql);
									while($leave_tbl_row = mysqli_fetch_array($leave_tbl_result)){
									$userid = $leave_tbl_row['id'];
									
									
									

									$leavtrq="select * from leave_tbl where admin_id='$cont_hr_id' and lb_status!='' and date_from='$current_date'";
									$sqlleavtrk=mysqli_query($link,$leavtrq);

									?>
									
									<?php } ?>
									<?php echo mysqli_num_rows($sqlleavtrk); ?> / <?php echo mysqli_num_rows($leave_tbl_result)?>
								</h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Planned Leaves</h6>
								<h4>
									<?php
									$leavtrq="select * from leave_tbl where admin_id='$cont_hr_id' and lb_status='1' and date_from='$current_date'";
									$sqlleavtrk=mysqli_query($link,$leavtrq);
									echo mysqli_num_rows($sqlleavtrk);
									?>
									 <span>Today</span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Unplanned Leaves</h6>
								<h4>
								<?php
									$leavtrq="select * from leave_tbl where admin_id='$cont_hr_id' and lb_status!='1' and date_from='$current_date'";
									$sqlleavtrk=mysqli_query($link,$leavtrq);
									echo mysqli_num_rows($sqlleavtrk);
									?>
									 <span>Today</span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Pending Requests</h6>
								<h4><?php
									$leavtrq="select * from leave_tbl where admin_id='$cont_hr_id' and lb_status='2' and date_from='$current_date'";
									$sqlleavtrk=mysqli_query($link,$leavtrq);
									echo mysqli_num_rows($sqlleavtrk);
									?></h4>
							</div>
						</div>
					</div>
					<!-- /Leave Statistics -->
					
					<!-- Search Filter -->
					<form form action="leaves.php" name="Registerform" enctype="multipart/form-data" method="post">
					<div class="row filter-row">
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-4 col-12">  
							<div class="form-group form-focus select-focus">
							<select name="search_employe" class="select floating" required>
                          <option value="">Select Empployee</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" 
						  <?php if($leave_tbl_row['id'] == $leave_tbl2_row['id']){?>selected<?php } ?>>
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
  </select>
  <label class="focus-label">Leave Status</label>
							</div>
					   </div>
					   
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="search_status"> 
									<option value=""> -- Select -- </option>
									<option value="2"> Pending </option>
									<option value="1"> Approved </option>
									<option value="0"> Rejected </option>
								</select>
								<label class="focus-label">Leave Status</label>
							</div>
					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" type="text" name="from_search">
								</div>
								<label class="focus-label">From</label>
							</div>
						</div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" type="text" name="to_search">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>

					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <button type="submit" name="search_crm" class="btn btn-success btn-block">Search</button>

					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <a href="leaves.php?date=reset" class="btn btn-white btn-block">RESET</a>  
					   </div>
					      
                    </div>
					<!-- /Search Filter -->
									</form>
									
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>Employee</th>
											<th>Leave Type</th>
											<th>From</th>
											<th>To</th>
											<th>No of Days</th>
											<th>Reason</th>
											<th class="text-center">Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										
										
	<?php
	$leave_tbl_sql="select * from leave_tbl LEFT JOIN users ON leave_tbl.user_employee=users.id where admin_id='$cont_hr_id' and user_employee LIKE '%$search_employe%'
	 $btnsrst $bwch";
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
											<td>
												<h2 class="table-avatar">
													<a class="avatar">
													<?php if($leave_tbl_row['image']!='') { ?>
										<img src="uploads/<?php echo $leave_tbl_row['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
														</a>
													<a><?php echo $leave_tbl_row['fullname'];?> <span>
													<?php echo $listsqltype['countr'];?> 
													</span></a>
												</h2>
											</td>
											<td>
											<?php 
												$spllevid = $leave_tbl_row['leave_type'];
				 									$leave_tbl22_sql="select * from leave_type WHERE leave_id='$spllevid'";
														$leave_tbl22_result=mysqli_query($link,$leave_tbl22_sql);
															$leave_tbl22_row=mysqli_fetch_array($leave_tbl22_result);
																echo $leave_tbl22_row['leave_type'];
												?>
											</td>
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
													<div class="dropdown-menu dropdown-menu-right">
														
<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $leave_tbl_row['leave_id'];?>"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>

													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_hr_permission['leave_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave<?php echo $leave_tbl_row['leave_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_hr_permission['leave_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
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
											<a href="script/leave_script.php?del=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
<a href="script/leave_script.php?aprove=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary continue-btn">Approve</a>
										</div>
										<div class="col-6">
<a href="script/leave_script.php?decline=<?php echo $leave_tbl_row['leave_id'];?>" class="btn btn-primary cancel-btn">Decline</a>
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
							<form form action="script/leave_script.php" name="Registerform" enctype="multipart/form-data" method="post">
							<div class="form-group">
								
									<label class="bmd-label-floating">User Empployee <span class="text-danger">*</span></label>
                        <select name="user_employee" class="form-control" required>
                          <option value="">Select Empployee</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" 
						  <?php if($leave_tbl_row['id'] == $leave_tbl2_row['id']){?>selected<?php } ?>>
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
                          
                        </select>
						</div>		
							<div class="form-group">
										<label>Leave Type <span class="text-danger">*</span></label>
								<select name="leave_type" class="form-control" required>
                          <option value="">Select Leave Type</option>
                          <?php
					   
					   $leave_tbl21_sql="select * from leave_type WHERE status='1'";
$leave_tbl21_result=mysqli_query($link,$leave_tbl21_sql);
while($leave_tbl21_row=mysqli_fetch_array($leave_tbl21_result)){


	
  
					   ?>
                          <option value="<?php echo $leave_tbl21_row['leave_id']; ?>" <?php if ($leave_tbl21_row['leave_id']==$leave_tbl_row['leave_type']){?>selected<?php } ?> ><?php echo $leave_tbl21_row['leave_type']; ?></option>
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
								<div class="form-group">
										<label>Ticket Attached <span class="text-danger">*</span></label>
										<input type="file" class="form-control" name="image3">
									<input type="hidden" name="hiddenimage3" value="<?php echo $leave_tbl_row['image3'];?>" />
								<?php if($leave_tbl_row['image3']!='') { ?>
									<a href="uploads/<?php echo $leave_tbl_row['image3'];?>" target="_blank"><span class="la la-file-pdf-o" style="font-size: 30px; color: #000;"></span> <?php echo $leave_tbl_row['image3'];?></a>
                      
                      <?php } ?>	
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
								<h5 class="modal-title">Add Leave</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form form action="script/leave_script.php" name="Registerform" enctype="multipart/form-data" method="post">
							<div class="form-group">
									<label class="bmd-label-floating">User Empployee <span class="text-danger">*</span></label>
                        <select name="user_employee" class="form-control" required>
                          <option value="">Select Empployee</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>"><?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
                          
                        </select>
						</div>		
							<div class="form-group">
										<label>Leave Type <span class="text-danger">*</span></label>
										<input class="form-control" name="leave_type" type="text" required>
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