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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");?>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<?php include("include/header.php");
			if(isset($_REQUEST['passwordupdate'])){
				$matchpassword=$_REQUEST['matchpassword'];
				$password=$_REQUEST['password'];
				$currentpassword=$customerchechlogin_row['password'];
				if($matchpassword == $currentpassword){
				$queryatleast="update users SET password='$password' WHERE id=$customerchechlogin_id";
        mysqli_query($link,$queryatleast);
		$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Password change Sucessfuly.</div>';
		$errflag = true;
		$_SESSION['passchng'] = $errmsg_arr;
		session_write_close();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else{
			$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> Current Password is not match</div>';
			$errflag = true;
			$_SESSION['passchng'] = $errmsg_arr;
			session_write_close();
			header('Location: ' . $_SERVER['HTTP_REFERER']);  
		
			}
		}
			?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include("include/sidebar2.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						<?php
if( isset($_SESSION['passchng']) && is_array($_SESSION['passchng']) && count($_SESSION['passchng']) >0 ) {
foreach($_SESSION['passchng'] as $msg) {
echo $msg;  
}
unset($_SESSION['passchng']); }?>
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Change Password</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form action="change-password.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Old password</label>
									<input type="password" name="matchpassword" class="form-control">
								</div>
								<div class="form-group">
									<label>New password</label>
									<input type="password" name="password" class="form-control">
								</div>
								
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" name="passwordupdate" type="submit">Update Password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				
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
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>

    </body>
</html>