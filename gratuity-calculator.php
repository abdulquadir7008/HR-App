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
if(isset($_REQUEST['submit_call'])){
$contracttype=$_REQUEST['contracttype'];
$separation_type=$_REQUEST['separation_type'];
$date_from=$_REQUEST['date_from'];
$date_to=$_REQUEST['date_to'];
$basic_salary=$_REQUEST['basic_salary'];
$leave_date_from = str_replace('/', '-', $_REQUEST['date_from']);
				$leave_date_to = str_replace('/', '-', $_REQUEST['date_to']);
				$date70 = date_create($leave_date_from);
				$date80 = date_create($leave_date_to);
				$diff = date_diff($date70,$date80);	
	$yearcount = $diff->format("%y");
	$Months = $date70->diff($date80); 
 	$howeverManyMonths = (($Months->y) * 12) + ($Months->m);
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
								<h3 class="page-title">Gratuity Calculator UAE</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Gratuity
</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					
									
					<div class="row">
						<div class="col-xl-12 d-flex">
							
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title mb-0">New Gratuity  </h4>
								</div>
								<div class="card-body">
									<?php
if( isset($_SESSION['return_leave_error']) && is_array($_SESSION['return_leave_error']) && count($_SESSION['return_leave_error']) >0 ) {
foreach($_SESSION['return_leave_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['return_leave_error']); }?>
									
									<form form action="gratuity-calculator.php" name="Registerform" enctype="multipart/form-data" method="post">
										<div class="row">
							<div class="form-group col-md-6">
									<label class="bmd-label-floating">Contract Type <span class="text-danger">*</span></label>
								<input type="hidden" name="user_employee" value="<?php echo $customerchechlogin_id;?>">
                        <select name="contracttype" class="form-control" required>
                          <option value="">Select Contract Type</option>
                          <option value="limited" <?php if($_REQUEST['contracttype'] =='limited'){?>selected<?php } ?> >Limited</option>
                        	<option value="Unlimited" <?php if($_REQUEST['contracttype']=='Unlimited'){?>selected<?php } ?>>Unlimited</option>
                        </select>
								
								
						</div>	
											<div class="form-group col-md-6">
									<label class="bmd-label-floating">Separation Type <span class="text-danger">*</span></label>
								<input type="hidden" name="user_employee" value="<?php echo $customerchechlogin_id;?>">
                        <select name="separation_type" class="form-control" required>
                          <option value="">Select Separation Type</option>
                          <option value="resignation" <?php if($_REQUEST['separation_type'] =='resignation'){?>selected<?php } ?>>Resignation</option>
                        	<option value="termination" <?php if($_REQUEST['separation_type'] =='termination'){?>selected<?php } ?>>Termination</option>
							<option value="contract_completion" <?php if($_REQUEST['separation_type'] =='contract_completion'){?>selected<?php } ?>>Contract completion</option>
                        </select>
								
								
						</div>
							
									<div class="form-group col-md-6">
										<label>First Working Day <span class="text-danger">*</span></label>
										
											<input class="form-control from-day" name="date_from" id="from" type="date" value="<?php if(isset($_REQUEST['date_from'])){echo $_REQUEST['date_from'];}?>" required>
										
									</div>
									<div class="form-group col-md-6">
										<label>Last Working Day <span class="text-danger">*</span></label>
										
											<input class="form-control to-day" name="date_to" type="date" id="to" value="<?php if(isset($_REQUEST['date_to'])){echo $_REQUEST['date_to'];}?>"  required>
										
									</div>
									
									
											
											
									<div class="form-group col-md-12">
										<label>Last Basic Salary <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="basic_salary" value="<?php if(isset($_REQUEST['basic_salary'])){echo $_REQUEST['basic_salary'];}?>" required>
									</div>
									
												
											
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="submit_call">Calculate</button>
									</div>
											</div>
								</form>
								</div>
								<?php
								if(isset($_REQUEST['submit_call'])){
									if($yearcount >= 5){
										$monthofbase = $basic_salary  * 6 / 100;
										echo "<div class='aproxmt'>Approximate Gratuity :  AED " . $monthofbase * $howeverManyMonths."</div>";
									}
									else{
										echo "<div class='aproxmt'>Approximate Gratuity :  AED 0</div>";
									}
								}
								?>
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