<?php include("config.php");
if(isset($_REQUEST['temp']) && isset($_REQUEST['email'])){
	$session = $_REQUEST['temp'];
	$email = $_REQUEST['email'];
	$SQLtempuser = "select * from users WHERE email='$email' AND sesion='$session' AND status='0' AND account_type='1'"; 
	$reslut_tempuser = mysqli_query($link,$SQLtempuser); 
	$listtempuser = mysqli_fetch_array($reslut_tempuser);
	
	$userID = $listtempuser['id'];
	$company_name = $_REQUEST['company_name'];
	$vendor_type = $_REQUEST['vendor_type'];
	$vendor_registration_type = $_REQUEST['vendor_registration_type'];
	$vendor_category = $_REQUEST['vendor_category'];
	$country = $_REQUEST['country'];
	$freezone = $_REQUEST['freezone'];
	$vat_no = $_REQUEST['vat_no'];
	$vat_registration_no = $_REQUEST['vat_registration_no'];
	$mobile = $_REQUEST['mobile'];
	$phone = $_REQUEST['phone'];
	$fax = $_REQUEST['fax'];
	$address = $_REQUEST['address'];
	$builing_no = $_REQUEST['builing_no'];
	$city = $_REQUEST['city'];
	$postal_code = $_REQUEST['postal_code'];
	$po_box = $_REQUEST['po_box'];
	$main_activities = $_REQUEST['main_activities'];
	
	$sql_company = "select * from company_details where user_id='$userID'"; 
	$Reslut_copmany = mysqli_query($link,$sql_company); 
	$listcompdet = mysqli_fetch_array($Reslut_copmany);
	
	if(isset($_REQUEST['add_details'])){
	
	
		
	
		if(mysqli_num_rows($Reslut_copmany) > 0){
			
			$query="update company_details SET company_name='$company_name',vendor_type='$vendor_type',vendor_registration_type='$vendor_registration_type',vendor_category='$vendor_category',country='$country',
vat_no='$vat_no',vat_registration_no='$vat_registration_no',mobile='$mobile',phone='$phone',fax='$fax',address='$address',builing_no='$builing_no',city='$city',postal_code='$postal_code',po_box='$po_box',main_activities='$main_activities',user_type='1' WHERE user_id=$userID";
			mysqli_query($link,$query);
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
header('Location: trad-license-form.php?temp='.$session.'&&email='.$email);
		}else{
		
			
		$query="insert into company_details(company_name,vendor_type,vendor_registration_type,vendor_category,country,vat_no,vat_registration_no,mobile,phone,fax,address,builing_no,city,postal_code,po_box,main_activities,user_id,user_type)values('$company_name','$vendor_type','$vendor_registration_type','$vendor_category','$country','$vat_no','$vat_registration_no','$mobile','$phone','$fax','$address','$builing_no','$city','$postal_code','$po_box','$main_activities','$userID','1')"; 
		mysqli_query($link,$query);
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
header('Location: trad-license-form.php?temp='.$session.'&&email='.$email);
			
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
								<li class="active"><a href="#">Your Company<br><span class="fa fa-building"></span></a></li>
								<li><a href="#">Trade License<br><span class="fa fa-id-card"></span></a></li>
								<li><a href="#">Contact Details<br><span class="fa fa-phone"></span></a></li>
								<li><a href="#">Bank Details<br><span class="fa fa-bank"></span></a></li>
								<li><a href="#">Attachments<br><span class="fa fa-upload"></span></a></li>
								<li><a href="#">Terms & Conditions<br><span class="fa fa-file-text-o"></span></a></li>
								<li><a href="#">Dec. & Undertaking<br><span class="fa fa-pencil-square-o"></span></a></li>
								
							</ul>
							
							<!-- Account Form -->
							<form action="register-fill-form.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" method="post">
								<div class="row frmrough">
								<div class="col-md-6">
									
									<div class="form-group">
									<label>Company Name *</label>
									<input class="form-control" type="text" name="company_name" value="<?php echo $listcompdet['company_name'];?>" required>
								</div>
									<div class="form-group">
									<label>Vendor Type *</label>
										<select name="vendor_type" class="form-control" required>
										<option value=""> Select Vendor Type</option>
											<?php
											$SQLvendorType="select * from vendor_type order by vendorer_type_name ASC"; 
													$vendor_result=mysqli_query($link,$SQLvendorType); 
														while($listvendortype=mysqli_fetch_array($vendor_result)){
											?>
											<option value="<?php echo $listvendortype['id'];?>" <?php if($listcompdet['vendor_type'] == $listvendortype['id']){?>selected<?php } ?>> <?php echo $listvendortype['vendorer_type_name'];?></option>
											<?php } ?>
										</select>
									
								</div>
									
									<div class="form-group">
									<label>Vendor Registration Type *</label>
										<select name="vendor_registration_type" class="form-control" required>
										<option value=""> Select Vendor Registration Type</option>
											<?php
											$SQLvendorReg="select * from vendor_registration_type order by vendor_registration_name ASC"; 
													$vendor_resultReg=mysqli_query($link,$SQLvendorReg); 
														while($listvendorReg=mysqli_fetch_array($vendor_resultReg)){
											?>
											<option value="<?php echo $listvendorReg['venreg_id'];?>" <?php if($listcompdet['vendor_registration_type'] == $listvendorReg['venreg_id']){?>selected<?php } ?>> <?php echo $listvendorReg['vendor_registration_name'];?></option>
											<?php } ?>
										</select>
									
								</div>
									
									
									<div class="form-group">
									<label>Vendor Category *</label>
										<select name="vendor_category" class="form-control" required>
										<option value=""> Select Vendor Category</option>
											<?php
											$SQvendorcat="select * from vendor_category order by vendor_category_name ASC"; 
													$Result_vencat=mysqli_query($link,$SQvendorcat); 
														while($listvendcat=mysqli_fetch_array($Result_vencat)){
											?>
											<option value="<?php echo $listvendcat['id'];?>" <?php if($listcompdet['vendor_category'] == $listvendcat['id']){?>selected<?php } ?>> <?php echo $listvendcat['vendor_category_name'];?></option>
											<?php } ?>
										</select>
									
								</div>
									
									<div class="form-group">
									<label>Country *</label>
										<select name="country" class="form-control" required>
										<option value=""> Select Country</option>
											<?php
											$SQlcountry="select * from country order by cname ASC"; 
													$Result_country=mysqli_query($link,$SQlcountry); 
														while($listCountry=mysqli_fetch_array($Result_country)){
											?>
											<option value="<?php echo $listCountry['country_id'];?>" <?php if($listcompdet['country'] == $listCountry['country_id']){?>selected<?php } ?>> <?php echo $listCountry['cname'];?></option>
											<?php } ?>
										</select>
									
								</div>
									
									
									
									
									<div class="form-group">
									<label>UAE VAT Registration Status *</label>
										<div class="clearfix"></div>
										<div class="radanch"><input type="radio" name="vat_no" class="form-control regradio" value="eligible"  <?php if($listcompdet['vat_no'] == 'eligible'){?>checked<?php } ?>><span>Eligible</span></div>
											<div class="radanch"><input type="radio" name="vat_no" class="form-control regradio" value="not - eligible" <?php if($listcompdet['vat_no'] == 'not - eligible'){?>checked<?php } ?>><span>Not - Eligible</span></div>
									
								</div>
									<div class="clearfix"></div>
									<div class="form-group">
									<label>Vat Registration No *</label>
									<input class="form-control" type="text" name="vat_registration_no" value="<?php echo $listcompdet['vat_registration_no'];?>" required>
								</div>
									
									</div>
									
									<div class="col-md-6">
									<div class="form-group">
									<label>Mobile *</label>
									<input class="form-control" type="text" name="mobile" value="<?php echo $listcompdet['mobile'];?>" required>
								</div>
										
							<div class="form-group">
									<label>Land Line *</label>
									<input class="form-control" type="text" name="phone" value="<?php echo $listcompdet['phone'];?>" required>
								</div>
										
										<div class="form-group">
									<label>Fax *</label>
									<input class="form-control" type="text" name="fax" value="<?php echo $listcompdet['fax'];?>" required>
								</div>
										
										<div class="form-group">
									<label>Address *</label>
									<textarea name="address" class="form-control"><?php echo $listcompdet['address'];?></textarea>
								</div>
										
								<div class="form-group">
									<label>Office / Building Number *</label>
									<input class="form-control" type="text" name="builing_no" value="<?php echo $listcompdet['builing_no'];?>" required>
								</div>
										
								<div class="form-group">
									<label>City *</label>
									<input class="form-control" type="text" name="city" value="<?php echo $listcompdet['city'];?>" required>
								</div>
										
										<div class="row">
										<div class="col-md-6"><div class="form-group">
									<label>Postal code *</label>
									<input class="form-control" type="text" name="postal_code" value="<?php echo $listcompdet['postal_code'];?>" required>
								</div></div>
											
											<div class="col-md-6"><div class="form-group">
									<label>PO .Box *</label>
									<input class="form-control" type="text" name="po_box" value="<?php echo $listcompdet['po_box'];?>" required>
								</div></div>
											</div>
										<div class="form-group">
									<label>Main Activities *</label>
									<input class="form-control" type="text" name="main_activities" value="<?php echo $listcompdet['main_activities'];?>" required>
								</div>
										</div>
									
									</div>
								
								</div>
								
								
								
								<div class="form-group text-center registbtn">
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