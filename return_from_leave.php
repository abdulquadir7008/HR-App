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
								<h3 class="page-title">Return Leaves</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Return Leaves</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					
									
					<div class="row">
						<div class="col-xl-6 d-flex">
							
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title mb-0">Return From Leave </h4>
								</div>
								<div class="card-body">
									<?php
if( isset($_SESSION['return_leave_error']) && is_array($_SESSION['return_leave_error']) && count($_SESSION['return_leave_error']) >0 ) {
foreach($_SESSION['return_leave_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['return_leave_error']); }?>
									<form action="script/returnleave.php" method="post">
										
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Join Date</label>
											<div class="col-lg-9">
												<div class="cal-icon"><input type="text" name="join_date" class="form-control floating datetimepicker"></div>
											</div>
										</div>
										
										
										
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Comments</label>
											<div class="col-lg-9">
												<textarea name="comment" class="form-control" rows="8"></textarea>
											</div>
										</div>
										<input type="hidden" name="userid" value="<?php echo $customerchechlogin_row['id'];?>">
										
										<div class="submit-section">
											<button type="submit" name="submit" class="btn btn-primary submit-btn">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6 d-flex ">
							
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title mb-0">Cancel From Leave </h4>
								</div>
								<div class="card-body">
									<?php
if( isset($_SESSION['return_leave_error']) && is_array($_SESSION['return_leave_error']) && count($_SESSION['return_leave_error']) >0 ) {
foreach($_SESSION['return_leave_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['return_leave_error']); }?>
									<form form action="script/cancel_leave_script.php" name="Registerform" enctype="multipart/form-data" method="post">
							<div class="form-group">
									<label class="bmd-label-floating">Leave Type <span class="text-danger">*</span></label>
								<input type="hidden" name="user_employee" value="<?php echo $customerchechlogin_id;?>">
                        <select name="leave_type" class="form-control" required>
                          <option value="">Select Leave Type</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from leave_type";
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
						
						<div class="col-xl-12 d-flex">
							
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title mb-0">New Leave Application </h4>
								</div>
								<div class="card-body">
									<?php
if( isset($_SESSION['return_leave_error']) && is_array($_SESSION['return_leave_error']) && count($_SESSION['return_leave_error']) >0 ) {
foreach($_SESSION['return_leave_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['return_leave_error']); }?>
									<form form action="script/leave_scriptem.php" name="Registerform" enctype="multipart/form-data" method="post">
										<div class="row">
							<div class="form-group col-md-4">
									<label class="bmd-label-floating">Leave Type <span class="text-danger">*</span></label>
								<input type="hidden" name="user_employee" value="<?php echo $customerchechlogin_id;?>">
                        <select name="leave_type" class="form-control" required>
                          <option value="">Select Leave Type</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from leave_type";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){


	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['leave_id']; ?>"><?php echo $leave_tbl2_row['leave_type']; ?></option>
                        <?php }?>
                          
                        </select>
						</div>		
							
									<div class="form-group col-md-4">
										<label>From <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" name="date_from" type="text" required>
										</div>
									</div>
									<div class="form-group col-md-4">
										<label>To <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" name="date_to" type="text" required>
										</div>
									</div>
									<div class="form-group col-md-4">
									<div class="form-group">
										<label>Add Home Country Contact Number <span class="text-danger">*</span></label>
										
											<input class="form-control" name="homecontact" type="text" required>
										
									</div>
										</div>
									<div class="form-group col-md-12">
										<label>Leave Reason <span class="text-danger">*</span></label>
										<textarea rows="4" name="leave_reason" class="form-control" required></textarea>
									</div>
											
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add_leave">Submit</button>
									</div>
											</div>
								</form>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Leave Modal -->
				
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