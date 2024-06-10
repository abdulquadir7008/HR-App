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
	$conflict_of_interest = $_REQUEST['conflict_of_interest'];
		
	if(isset($_REQUEST['question']) == 'yes'){
		$enginer_name = $_REQUEST['enginer_name'];
		$dest_engineer = $_REQUEST['dest_engineer'];
		$period_form = $_REQUEST['period_form'];
		$period_to = $_REQUEST['period_to'];
	}
		else if(isset($_REQUEST['question']) == 'no'){
			$enginer_name = '';
			$dest_engineer = '';
			$period_form = '';
			$period_to = '';
		}
		if(isset($_REQUEST['question2']) == 'yes'){
			$legal_matters = $_REQUEST['legal_matters'];
		}
		else{
			$legal_matters = '';
		}
		if(isset($_REQUEST['question3']) == 'yes'){
			$legal_matters2 = $_REQUEST['legal_matters2'];
		}
		else{
			$legal_matters2 = '';
		}
		
if(isset($_REQUEST['dewa'])){$dewa = $_REQUEST['dewa'].",";}else{$dewa ='';}
		
if(isset($_REQUEST['rta'])){$rta = $_REQUEST['rta'].",";}else{$rta ='';}
		
if(isset($_REQUEST['municpalty'])){$municpalty = $_REQUEST['municpalty'].",";}else{$municpalty ='';}
		
if(isset($_REQUEST['other'])){$other = $_REQUEST['other'].",";}else{$other ='';}
		
$additional_information = $dewa.$rta.$municpalty.$other;
		
$agreed = $_REQUEST['agreed'];
		
	
		if(mysqli_num_rows($Reslut_copmany) > 0){
			
		$query="update company_details SET conflict_of_interest='$conflict_of_interest',enginer_name='$enginer_name',dest_engineer='$dest_engineer',period_form='$period_form',period_to='$period_to',legal_matters='$legal_matters',legal_matters2='$legal_matters2',additional_information='$additional_information',agreed='$agreed' WHERE user_id=$userID";
		mysqli_query($link,$query);
			
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
header('Location: thanks-register.php?temp='.$session.'&&email='.$email);
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
								<li><a href="#">Terms & Conditions<br><span class="fa fa-file-text-o"></span></a></li>
								<li class="active"><a href="#">Dec. & Undertaking<br><span class="fa fa-pencil-square-o"></span></a></li>
								
							</ul>
							
							<!-- Account Form -->
							
									
									
									
							<form action="dec-undertaking-file.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" method="post">
								<h4 style="margin-top: 30px;">Conflict of Interest</h4>
								
								<div class="form-group">
									<label>Please declare any actual or perceived conflict of interest that your Company may have in working with EO.</label>
									<input class="form-control " type="text" name="conflict_of_interest" value="<?php echo $listcompdet['conflict_of_interest'];?>" placeholder="Conflict of Interest" required>
								</div>
								
								<div class="form-group">
									<label>Is any owner or person with an interest in the Company's profits, or first degree relative currently employed with EO, or was employed with EO in the past?</label>
									<div><input type="radio" class="radio_input" name="question" value="yes" onclick="show2();"> Yes
										<input type="radio" class="radio_input" name="question" value="No" onclick="show1();"> No</div>
									
								</div>
								
								<div id="div1" class="hidercol">
								<p>If YES, please state the name of the person/s, designation and period of employment with Engineering Office.</p>
									
									<div class="row" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px">
									<div class="col-md-5">
									<div class="form-group">
									<label>Name</label>
									<input class="form-control" type="text" name="enginer_name" value="<?php echo $listcompdet['enginer_name'];?>">
								</div>
									</div>
									
									<div class="col-md-5">	
									<div class="form-group">
									<label>Designation with Engineering Office</label>
									<input class="form-control" type="text" name="dest_engineer" value="<?php echo $listcompdet['dest_engineer'];?>">
								</div>
										</div>	
									
									<div class="col-md-5">	
									<div class="form-group">
									<label>Employment Period From</label>
									<input class="form-control" type="date" name="period_form" value="<?php echo $listcompdet['period_form'];?>">
								</div>
										</div>
									<div class="col-md-5">
									<div class="form-group">
									<label>Employment Period To</label>
									<input class="form-control" type="date" name="period_to" value="<?php echo $listcompdet['period_to'];?>">
								</div>
										</div>
									
									</div>
									
								</div>
								
								<h4>Legal Matters</h4>
								<div class="form-group">
									<label>Has your Company previously or is it currently involved in any litigation, arbitration or alternative dispute resolution?</label>
									<div><input type="radio" name="question2" value="yes" onclick="show4();"> Yes
										<input type="radio" name="question2" value="No" onclick="show3();"> No</div>
								</div>
								<div id="div2" class="hidercol">
									<p>If YES, please provide details below.</p>
									<input class="form-control " type="text" name="legal_matters" value="<?php echo $listcompdet['legal_matters'];?>">
								</div>
								<div class="form-group">
									<label>Has your Company previously or is it currently involved in any litigation, arbitration or alternative dispute resolution?</label>
									<div><input type="radio" name="question3" value="yes" onclick="show6();"> Yes
										<input type="radio" name="question3" value="No" onclick="show5();"> No</div>
								</div>
								
								<div id="div3" class="hidercol">
									<p>If YES, please provide details below.</p>
									<input class="form-control " type="text" name="legal_matters2" value="<?php echo $listcompdet['legal_matters2'];?>">
								</div>
								<h4>Additional Information</h4>
								<div class="form-group">
									<label>Is the company affiliated (prequalified/ approved/ certified/ accredited/ engaged) with any UAE Govt. Authority (ies) , please mention below</label>
									<div><input type="checkbox" name="dewa" value="DEWA"> DEWA<br>
									<input type="checkbox" name="rta" value="RTA"> RTA<br>
									<input type="checkbox" name="municpalty" value="Dubai Muncipality"> Dubai Muncipality<br>
										<input type="checkbox" name="other" value="other"> Others</div>
								</div>
								<h4>Undertaking</h4>
								<p>The above information provided to the Engineering Office in this prequalification form is true and correct to the best of my knowledge. Any false statements/ claims/ declarations shall result to permanent blocking from EO Vendor's list.</p>
								<input type="checkbox" required name="agreed"> Agree
								
								</div>
								
								
								
								<div class="form-group text-center registbtn">
									<a href="term-condition-fil.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" class="btn btn-dark" style="padding: 10px 20px; font-size: 20px;">Back</a>
									<button class="btn btn-primary account-btn" name="add_details" type="submit">Submit</button>
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
	
	<script>
		function show1(){
  		document.getElementById('div1').style.display ='none';
			}
			function show2(){
  		document.getElementById('div1').style.display = 'block';
			}
		
		function show3(){
  		document.getElementById('div2').style.display ='none';
			}
			function show4(){
  		document.getElementById('div2').style.display = 'block';
			}
		
		function show5(){
  		document.getElementById('div3').style.display ='none';
			}
			function show6(){
  		document.getElementById('div3').style.display = 'block';
			}
	</script>
		
    </body>
</html>