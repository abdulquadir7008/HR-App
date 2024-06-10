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

$sqlcompany_details="select * from invoice_setting WHERE user_id='$customerchechlogin_id' and user_type='$adminAcType'";
$resultComp=mysqli_query($link,$sqlcompany_details);
$listComp=mysqli_fetch_array($resultComp);
if($listComp['invoice_id'] && $listComp['user_id']==$customerchechlogin_id && $listComp['user_type']==$adminAcType){$btn_name = "update";}else{$btn_name = "add";}
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
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Invoice Settings</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form method="post" action="script/invoice_setting.php" enctype="multipart/form-data">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Invoice prefix</label>
									<div class="col-lg-9">
										<input type="text" name="invocie_prifix" value="<?php echo $listComp['invocie_prifix'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Invoice Logo</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="image">
										<input type="hidden" name="hiddenimage" id="image" value="<?php echo $listComp['image']; ?>" />
										<span class="form-text text-muted">Recommended image size is 200px x 40px</span>
									</div>
									<?php if($listComp['image']!='') { ?>
									<div class="col-lg-2">
										<div class="img-thumbnail float-right"><img src="uploads/<?php echo $listComp['image']; ?>" class="img-fluid" alt="" width="140" height="40"></div>
									</div>
                          
                          <?php } ?>
									
								</div>
								<div class="submit-section">
									<input type="hidden" name="invoice_id" value="<?php echo $listComp['invoice_id'];?>">
									<button class="btn btn-primary submit-btn" type="submit" name="<?php echo $btn_name;?>">Save</button>
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