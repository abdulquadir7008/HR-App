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
								<h3 class="page-title">New Leave Application</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Leaves</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					
									
					<div class="row">
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
					   
					   $leave_tbl2_sql="select * from leave_type WHERE user_id='$cont_hr_id' and status='1'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){


	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['leave_id']; ?>"><?php echo $leave_tbl2_row['leave_type']; ?></option>
                        <?php }?>
                          
                        </select>
						</div>		
							
									<div class="form-group col-md-4">
										<label>From <span class="text-danger">*</span></label>
										
											<input class="form-control from-day" name="date_from" id="from" type="date" required>
										
									</div>
									<div class="form-group col-md-4">
										<label>To <span class="text-danger">*</span></label>
										
											<input class="form-control to-day" name="date_to" type="date" id="to"  required>
										
									</div>
									
									<div class="form-group col-md-4">
										<label>Add Home Country Contact Number <span class="text-danger">*</span></label>
										
											<input class="form-control" name="homecontact" type="text" required>
										
									</div>
											
											<div class="form-group col-md-4">
										<label>Ticket Attached <span class="text-danger">*</span></label>
										<input type="file" class="form-control" name="image3">
									</div>
											<div class="form-group col-md-4">
										<label>No.of Days</label>
										
											<p class="date" s style="border: 1px solid #e3e3e3; line-height: 35px;"><span></span> Days</p>
										
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
<script>
		let
datePicker = document.querySelectorAll('input');


datePicker.forEach(picker => {
  picker.addEventListener('change', _onDateSelect);
});

function _showHTML(days) {
  let domElement = document.querySelector('.date span'),
  dateWrapper = document.querySelector('.date');


  if (days <= 0 || !days) {
    domElement.innerHTML = 'No.of ';
    dateWrapper.classList.remove('filled');
  } else {
    domElement.innerHTML = days;
    dateWrapper.classList.add('filled');
  }
}

function _onDateSelect(event) {
  let
  dateValue = [document.querySelector('.from-day').value, document.querySelector('.to-day').value],
  date1 = new Date(dateValue[0]),
  date2 = new Date(dateValue[1]),
  timeDiff = Math.abs(date2.getTime() - date1.getTime()),
  diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));


  _showHTML(diffDays);
}

_showHTML(0);
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

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
    </body>
</html>