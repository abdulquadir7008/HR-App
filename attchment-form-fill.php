<?php include("config.php");
if(isset($_REQUEST['temp']) && isset($_REQUEST['email'])){
	$session = $_REQUEST['temp'];
	$email = $_REQUEST['email'];
	$SQLtempuser = "select * from users WHERE email='$email' AND sesion='$session' AND status='0' AND account_type='1'"; 
	$reslut_tempuser = mysqli_query($link,$SQLtempuser); 
	$listtempuser = mysqli_fetch_array($reslut_tempuser);
	
	$userID = $listtempuser['id'];
	
	
if($_FILES["image"]["name"]!='')
{
$file_size = $_FILES['image']['size'];	
if (($file_size > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }	
else if (($_FILES["image"]["type"] == "application/pdf")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="$path".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}

if($_FILES["image2"]["name"]!='')
{
	$file_size1 = $_FILES['image2']['size'];
	if (($file_size1 > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }	
else if (($_FILES["image2"]["type"] == "application/pdf")
|| ($_FILES["image2"]["type"] == "image/jpeg")
|| ($_FILES["image2"]["type"] == "image/pjpeg")
|| ($_FILES["image2"]["type"] == "image/X-PNG")
|| ($_FILES["image2"]["type"] == "image/PNG")
|| ($_FILES["image2"]["type"] == "image/png")
|| ($_FILES["image2"]["type"] == "image/x-png")
|| ($_FILES["image2"]["type"] == "image/x-png"))
{
$image2="$path".$rand1.$_FILES["image2"]["name"];
$image01=$rand1.$_FILES["image2"]["name"];
move_uploaded_file($_FILES["image2"]["tmp_name"],$image2);
}
else
{
$image01='';
}
}

else
{
$image01=$_REQUEST['hiddenimage2'];
}
	
if($_FILES["image3"]["name"]!='')
{
	$file_size2 = $_FILES['image3']['size'];
	if (($file_size2 > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }	
else if (($_FILES["image3"]["type"] == "application/pdf")
|| ($_FILES["image3"]["type"] == "image/jpeg")
|| ($_FILES["image3"]["type"] == "image/pjpeg")
|| ($_FILES["image3"]["type"] == "image/X-PNG")
|| ($_FILES["image3"]["type"] == "image/PNG")
|| ($_FILES["image3"]["type"] == "image/png")
|| ($_FILES["image3"]["type"] == "image/x-png")
|| ($_FILES["image3"]["type"] == "image/x-png"))
{
$image3="$path".$rand1.$_FILES["image3"]["name"];
$image02=$rand1.$_FILES["image3"]["name"];
move_uploaded_file($_FILES["image3"]["tmp_name"],$image3);
}
else
{
$image02='';
}
}

else
{
$image02=$_REQUEST['hiddenimage3'];
}
	
	if($_FILES["image4"]["name"]!='')
{
	$file_size2 = $_FILES['image4']['size'];
	if (($file_size2 > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }	
else if (($_FILES["image4"]["type"] == "application/pdf")
|| ($_FILES["image4"]["type"] == "image/jpeg")
|| ($_FILES["image4"]["type"] == "image/pjpeg")
|| ($_FILES["image4"]["type"] == "image/X-PNG")
|| ($_FILES["image4"]["type"] == "image/PNG")
|| ($_FILES["image4"]["type"] == "image/png")
|| ($_FILES["image4"]["type"] == "image/x-png")
|| ($_FILES["image4"]["type"] == "image/x-png"))
{
$image4="$path".$rand1.$_FILES["image4"]["name"];
$image04=$rand1.$_FILES["image4"]["name"];
move_uploaded_file($_FILES["image4"]["tmp_name"],$image4);
}
else
{
$image04='';
}
}

else
{
$image04=$_REQUEST['hiddenimage4'];
}
	
	if($_FILES["image5"]["name"]!='')
{
	$file_size2 = $_FILES['image5']['size'];
	if (($file_size2 > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }	
else if (($_FILES["image5"]["type"] == "application/pdf")
|| ($_FILES["image5"]["type"] == "image/jpeg")
|| ($_FILES["image5"]["type"] == "image/pjpeg")
|| ($_FILES["image5"]["type"] == "image/X-PNG")
|| ($_FILES["image5"]["type"] == "image/PNG")
|| ($_FILES["image5"]["type"] == "image/png")
|| ($_FILES["image5"]["type"] == "image/x-png")
|| ($_FILES["image5"]["type"] == "image/x-png"))
{
$image5="$path".$rand1.$_FILES["image5"]["name"];
$image05=$rand1.$_FILES["image5"]["name"];
move_uploaded_file($_FILES["image5"]["tmp_name"],$image5);
}
else
{
$image05='';
}
}

else
{
$image05=$_REQUEST['hiddenimage5'];
}
	
	
	$sql_company = "select * from company_details where user_id='$userID'"; 
	$Reslut_copmany = mysqli_query($link,$sql_company); 
	$listcompdet = mysqli_fetch_array($Reslut_copmany);
	
	if(isset($_REQUEST['add_details'])){
	
	
		
	
		if(mysqli_num_rows($Reslut_copmany) > 0){
			
			$query="update company_details SET image='$image0',image2='$image01',image3='$image02',image4='$image04',image5='$image05' WHERE user_id=$userID";
			mysqli_query($link,$query);
			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register. Company Details Update Successfully.</div>';
$errflag = true;
$_SESSION['companyerr'] = $errmsg_arr;
session_write_close();
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
header('Location: term-condition-fil.php?temp='.$session.'&&email='.$email);
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
								<li class="active"><a href="#">Attachments<br><span class="fa fa-upload"></span></a></li>
								<li><a href="#">Terms & Conditions<br><span class="fa fa-file-text-o"></span></a></li>
								<li><a href="#">Dec. & Undertaking<br><span class="fa fa-pencil-square-o"></span></a></li>
								
							</ul>
							
							<!-- Account Form -->
							<p style="margin-top: 30px;">Note: The procurement templates for QA/QC manual and EHS are available for download below.</p>
									<p>Uploaded files must be PDF, Excel, Word<br>Each file must not exceed the size of 20MB<br>Maximum file name length can be 250 Characters</p>
									
									<h3>MANDATORY</h3>
							<form action="attchment-form-fill.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" method="post" enctype="multipart/form-data">
								<div class="row frmrough">
									
								<div class="col-md-6">	
								<div class="form-group">
                    <label for="exampleInputEmail1">Trade License</label>
                      <input type="file" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="image" value="<?php echo $listcompdet['image']; ?>" />
                      <?php if($listcompdet['image']!='') {  ?>
						<p><i class="fa fa-file-pdf-o"></i> <?php echo $listcompdet['image'];?></p>			
                     
                      <?php } ?>
                    </div>
                     <div class="form-group">
                    <label for="exampleInputEmail1">VAT Certificate </label>
                      <input type="file" name="image2" id="image2" />
                      <input type="hidden" name="hiddenimage2" id="image2" value="<?php echo $listcompdet['image2']; ?>" />
                      <?php if($listcompdet['image2']!='') { ?>
                      <p><i class="fa fa-file-pdf-o"></i> <?php echo $listcompdet['image2'];?></p>	
                      <?php } ?>
                    </div>
									
				<div class="form-group">
                    <label for="exampleInputEmail1">Partners Passport Copy </label>
                      <input type="file" name="image3" id="image3" />
                      <input type="hidden" name="hiddenimage3" id="image3" value="<?php echo $listcompdet['image3']; ?>" />
                      <?php if($listcompdet['image3']!='') { ?>
                      <p><i class="fa fa-file-pdf-o"></i> <?php echo $listcompdet['image3'];?></p>	
                      <?php } ?>
                    </div>
									
<div class="form-group">
                    <label for="exampleInputEmail1">Local Sponser Passport Copy </label>
                      <input type="file" name="image4" id="image4" />
                      <input type="hidden" name="hiddenimage4" id="image4" value="<?php echo $listcompdet['image4']; ?>" />
                      <?php if($listcompdet['image4']!='') { ?>
                      <p><i class="fa fa-file-pdf-o"></i> <?php echo $listcompdet['image4'];?></p>	
                      <?php } ?>
                    </div>
									
									<div class="form-group">
                    <label for="exampleInputEmail1">Visa Copy</label>
                      <input type="file" name="image5" id="image5" />
                      <input type="hidden" name="hiddenimage5" id="image5" value="<?php echo $listcompdet['image5']; ?>" />
                      <?php if($listcompdet['image5']!='') { ?>
                      <p><i class="fa fa-file-pdf-o"></i> <?php echo $listcompdet['image5'];?></p>	
                      <?php } ?>
                    </div>
									
									
									</div>
									
									<div class="col-md-6">
									
										
							
										
										
										
										
										
										
										
										
										
										
										
								
										
								
										
										
										
										</div>
									
									</div>
								
								</div>
								
								
								
								<div class="form-group text-center registbtn">
									<a href="bank_details_form.php?temp=<?php echo $session;?>&&email=<?php echo $email;?>" class="btn btn-dark" style="padding: 10px 20px; font-size: 20px;">Back</a>
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