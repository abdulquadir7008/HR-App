<?php include("config.php");
if(isset($_REQUEST['temp']) && isset($_REQUEST['email'])){
	$session = $_REQUEST['temp'];
	$email = $_REQUEST['email'];
	$SQLtempuser = "select * from users WHERE email='$email' AND sesion='$session' AND status='0' AND account_type='1'"; 
	$reslut_tempuser = mysqli_query($link,$SQLtempuser); 
	$listtempuser = mysqli_fetch_array($reslut_tempuser);
	
	$userID = $listtempuser['id'];
	
	
	$sql_company = "select * from company_details where user_id='$userID'"; 
	$Reslut_copmany = mysqli_query($link,$sql_company); 
	$listcompdet = mysqli_fetch_array($Reslut_copmany);
	
	if(isset($_REQUEST['add_details'])){
	
	
		
	
		if(mysqli_num_rows($Reslut_copmany) > 0){
			
			//$query="update company_details SET image='$image0',image2='$image01',image3='$image02',image4='$image04',image5='$image05' WHERE user_id=$userID";
			//mysqli_query($link,$query);
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
header('Location: dec-undertaking-file.php?temp='.$session.'&&email='.$email);
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
								<li><a href="#">Contact Details<br><span class="fa fa-phone"></span></a></li>
								<li><a href="#">Bank Details<br><span class="fa fa-bank"></span></a></li>
								<li><a href="#">Attachments<br><span class="fa fa-upload"></span></a></li>
								<li class="active"><a href="#">Terms & Conditions<br><span class="fa fa-file-text-o"></span></a></li>
								<li><a href="#">Dec. & Undertaking<br><span class="fa fa-pencil-square-o"></span></a></li>
								
							</ul>
							
							<!-- Account Form -->
							
									
									
									
							<form action="term-condition-fil.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" method="post">
								<div class="row frmrough">
									<div class="term-report" style="height: 400px; overflow: auto;">
										 <p>By registering with the Portal, the Vendor agrees to the following terms and conditions (“Terms of Use”). EO reserves all rights to amend these Terms of Use at any time in EO’s absolute discretion and without providing prior notice to the Vendor.</p>
										<h3>Portal Terms of Use:</h3>
										<ol>
  <li>The Vendor’s representative warrants that he/she is authorized on behalf of the Vendor to agree to the Terms of Use and to represent the Vendor when using the Portal.</li>
  <li>The Portal, its design and operating systems are the intellectual property of EO and the Vendor shall not copy nor reproduce any element of the Portal nor infringe EO’s intellectual property rights in respect of the Portal in any way.</li>
  <li>All information provided to EO by the Vendor via the Portal is current, true and accurate, including for the avoidance of doubt any invoice submitted to EO via the Portal.</li>
  <li>It is the Vendor’s responsibility to update its account on the Portal with any changes to the Vendor’s contact information, bank account details and/or business status.</li>
  <li>EO may independently verify any amendment of the Vendor’s bank account details and request any supporting evidence from the Vendor, which the Vendor shall supply to EO without delay.</li>
  <li>Submission of an Application does not guarantee that the Vendor will receive tender invitations from EO nor does it oblige EO to approve the Application.</li>
  <li>The Vendor is responsible for updating its information held on the Portal, including the submission of the Vendor’s renewed trade/commercial/professional license is valid for one calendar year and the Vendor is responsible for any renewal of the Registration Process.</li>
  <li> EO reserves the right to accept or reject registration and Applications in its absolute discretion. Any act below on the part of the Vendor shall result in automatic deregistration and permanent prohibition from use of the Portal:
    <ol>
      <li>submission of false and/or forged documentation to the Portal;&nbsp;</li>
      <li>conviction of the Vendor of any crime of corruption or financial dishonesty whatsoever in any jurisdiction;</li>
      <li>infringement by the Vendor of EO’s or a third party’s intellectual property rights;</li>
      <li>direct and/or indirect price fixing by the Vendor;</li>
      <li>misrepresentation to EO of the quality of goods and/or services provided and/or to be provided by the Vendor;</li>
      <li>Any breach of any agreement between the Vendor and EO; and</li>
      <li>Breach of EO’s tendering policies</li>
    </ol>
  </li>
  <li>EO provides no guarantee nor assurance that the information submitted to the Portal by Vendor will be held securely.</li>
  <li>No warranty, representation, guarantee whether express or implied, is given by EO in respect of the operation of the Portal.</li>
  <li> EO accepts no liability whatsoever for any loss or damage (whether direct and/or indirect) incurred by the &nbsp;Vendor when using the Portal for any reason whatsoever, including but not limited to:
    <ol>
      <li>unauthorized access, interception and/or hacking of the Portal by a third party;</li>
      <li>any inaccuracy, error, delay or omission in relation to any data, information and/or message displayed on and/or transmitted via the Portal;</li>
      <li>any electronic virus transmitted to the Vendor’s electronic systems via the Portal;</li>
      <li>unavailability and/or suspension and/or removal of the Portal;</li>
      <li>errors in the Portal resulting in delayed payment of an invoice;</li>
      <li>fitness for purpose of the Portal; and</li>
      <li>Failure by the Vendor to comply with these Terms of Use.</li>
    </ol>
  </li>
  <li> The Vendor shall immediately notify EO if:
    <ol>
      <li>Vendor suspects or believes that there has been any unauthorized access of Vendor’s Portal registration and/or the Vendor’s Portal password has been compromised;</li>
      <li>The Vendor believes the Vendor information held on the Portal is inaccurate and/or incomplete; or</li>
      <li>An invoice has been submitted to EO in error.</li>
    </ol>
  </li>
  <li>If any invalid, unenforceable or illegal provision in these Terms of Use would be valid, enforceable or legal if some part of it were deleted, the provision shall apply with whatever modification is necessary to make it valid, enforceable and legal.</li>
  <li>The laws of Dubai and the Federal laws of the United Arab Emirates shall govern these Terms of Use. Any dispute arising from these Terms of Use shall be submitted to the exclusive jurisdiction of the Dubai Courts.</li>
  <li>The Vendor shall pay a nonrefundable fee (as determined by EO from time to time) to access the Portal, unless otherwise agreed by EO.</li>
</ol>
										
										 
										 </div>
								
								
									
									
									<div class="form-group" style="margin: 20px;">
									
									<input type="checkbox" name="agreed" required>
										<strong>Agree with the terms and conditions</strong>
								</div>
									
									</div>
								
								</div>
								
								
								
								<div class="form-group text-center registbtn">
									<a href="attchment-form-fill.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" class="btn btn-dark" style="padding: 10px 20px; font-size: 20px;">Back</a>
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