<?php include("config.php");
if(isset($_REQUEST['temp']) && isset($_REQUEST['email'])){
	$session = $_REQUEST['temp'];
	$email = $_REQUEST['email'];
	$SQLtempuser = "select * from users WHERE email='$email' AND sesion='$session' AND status='0' AND account_type='1'"; 
	$reslut_tempuser = mysqli_query($link,$SQLtempuser); 
	$listtempuser = mysqli_fetch_array($reslut_tempuser);
	
	$userID = $listtempuser['id'];
	$contact_name = $_REQUEST['contact_name'];
	$contract_possition = $_REQUEST['contract_possition'];
	$contract_mobile = $_REQUEST['contract_mobile'];
	$contract_person_emirates_id = $_REQUEST['contract_person_emirates_id'];
	$contract_person_eo = $_REQUEST['contract_person_eo'];
	$contract_department_eo = $_REQUEST['contract_department_eo'];
	
	
	$sql_company = "select * from company_details where user_id='$userID'"; 
	$Reslut_copmany = mysqli_query($link,$sql_company); 
	$listcompdet = mysqli_fetch_array($Reslut_copmany);
	
	if(isset($_REQUEST['add_details'])){
	
	
		
	
		if(mysqli_num_rows($Reslut_copmany) > 0){
			
			$query="update company_details SET contact_name='$contact_name',contract_possition='$contract_possition',contract_mobile='$contract_mobile',contract_person_emirates_id='$contract_person_emirates_id',contract_person_eo='$contract_person_eo',contract_department_eo='$contract_department_eo' WHERE user_id=$userID";
			mysqli_query($link,$query);
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
header('Location: bank_details_form.php?temp='.$session.'&&email='.$email);
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Register - HRMS</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets\img\favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets\css\bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets\css\font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets\css\style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page registerpage">
	<div class="account-logo register-logo">
	<a><img src="images/logo-sign.png" alt=""></a>
		<span class="regtitle"><?php echo $listtempuser['email'];?></span>
		<h3 class="account-title">Register</h3>
		<p class="account-subtitle">Access to our dashboard</p>
		
					</div>
		
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
					
					<!-- Account Logo -->
					
					<!-- /Account Logo -->
					
					<div class="account-box register-form">
						<div class="account-wrapper">
							
							<ul class="register-tab-ul">
								<li><a href="#">Your Company<br><span class="fa fa-building"></span></a></li>
								<li><a href="#">Trade License<br><span class="fa fa-id-card"></span></a></li>
								<li class="active"><a href="#">Contact Details<br><span class="fa fa-phone"></span></a></li>
								<li><a href="#">Bank Details<br><span class="fa fa-bank"></span></a></li>
								<li><a href="#">Attachments<br><span class="fa fa-upload"></span></a></li>
								<li><a href="#">Terms & Conditions<br><span class="fa fa-file-text-o"></span></a></li>
								<li><a href="#">Dec. & Undertaking<br><span class="fa fa-pencil-square-o"></span></a></li>
								
							</ul>
							
							<!-- Account Form -->
							<form action="contact-details-form.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" method="post">
								<div class="row frmrough">
								<div class="col-md-6">
									
									<div class="form-group">
									<label>Contact Name *</label>
									<input class="form-control " type="text" name="contact_name" value="<?php echo $listcompdet['contact_name'];?>" required>
								</div>
									
									<div class="form-group">
									<label>Contact Possition *</label>
									<input class="form-control " type="text" name="contract_possition" value="<?php echo $listcompdet['contract_possition'];?>" required>
								</div>
									
									<div class="form-group">
									<label>Contact Mobile *</label>
									<input class="form-control " type="text" name="contract_mobile" value="<?php echo $listcompdet['contract_mobile'];?>" required>
								</div>
									
									
									</div>
									
									<div class="col-md-6">
									
										<div class="form-group">
									<label>Contact Person Emirates ID *</label>
									<input class="form-control" type="text" name="contract_person_emirates_id" value="<?php echo $listcompdet['contract_person_emirates_id'];?>" required>
								</div>
										
										<div class="form-group">
									<label>Contact Person in EO *</label>
									<input class="form-control" type="text" name="contract_person_eo" value="<?php echo $listcompdet['contract_person_eo'];?>" required>
								</div>
							
									<div class="form-group">
									<label>Contact Department in EO *</label>
									<input class="form-control" type="text" name="contract_department_eo" value="<?php echo $listcompdet['contract_department_eo'];?>" required>
								</div>	
										
										
										
										
								
										
								
										
										
										
										</div>
									
									</div>
								
								</div>
								
								
								
								<div class="form-group text-center registbtn">
									<a href="trad-license-form.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" class="btn btn-dark" style="padding: 10px 20px; font-size: 20px;">Back</a>
									<button class="btn btn-primary account-btn" name="add_details" type="submit">Next</button>
								</div>
								
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>