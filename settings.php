<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
echo $customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
$adminAcType = $customerchechlogin_row['account_type'];

$sqlcompany_details="select * from company_details WHERE user_id='$customerchechlogin_id' and user_type='$adminAcType'";
$resultComp=mysqli_query($link,$sqlcompany_details);
$listComp=mysqli_fetch_array($resultComp);
if($listComp['company_id'] && $listComp['user_id']==$customerchechlogin_id && $listComp['user_type']==$adminAcType){$btn_name = "update";}else{$btn_name = "add";}
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
            <?php include("include/sidebar2.php");?>
			<!-- Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						
						
						
						
						<div class="col-md-8 offset-md-2">
						<?php
if( isset($_SESSION['companysetting']) && is_array($_SESSION['companysetting']) && count($_SESSION['companysetting']) >0 ) {
foreach($_SESSION['companysetting'] as $msg) {
echo $msg;  
}
unset($_SESSION['companysetting']); }?>
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Company Settings</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form method="post" action="script/usersetting.php" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Company Name <span class="text-danger">*</span></label>
											<input class="form-control" name="company_name" type="text" value="<?php echo $listComp['company_name'];?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Contact Person</label>
											<input class="form-control" name="contact_person" type="text" value="<?php echo $listComp['contact_person'];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<input class="form-control" name="address" value="<?php echo $listComp['address'];?>" type="text">
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Country</label>
											<select class="form-control select" name="country">
												<option value="uae">United Arab Emirate</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>City</label>
											<input class="form-control" name="city" value="<?php echo $listComp['city'];?>" type="text">
										</div>
									</div>
									
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Postal Code</label>
											<input class="form-control" name="postal_code" value="<?php echo $listComp['postal_code'];?>" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" name="alt_email" value="<?php echo $listComp['alt_email'];?>" type="email">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control" name="phone" value="<?php echo $listComp['phone'];?>" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Mobile Number</label>
											<input class="form-control" name="mobile" value="<?php echo $listComp['mobile'];?>" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Fax</label>
											<input class="form-control" name="fax" value="<?php echo $listComp['fax'];?>" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Website Url</label>
											<input class="form-control" name="url" value="<?php echo $listComp['url'];?>" type="text">
										</div>
									</div>
								</div>
								<div class="submit-section">
									<input type="hidden" name="company_id" value="<?php echo $listComp['company_id'];?>">
									<button type="submit" name="<?php echo $btn_name;?>" class="btn btn-primary submit-btn">Save</button>
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