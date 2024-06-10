<?php include("config.php");?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - HRMS</title>
		
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
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a><img src="images/logo-sign.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->

					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to Your dashboard</p>
							<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div style='background: #f55145; color: #fff; text-align: center; line-height: 22px; font-weight: bold; width: 100%; font-size: 13px; margin: 17px auto; padding: 5px; margin-top: -20px;'>".$msg."</div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
							<!-- Account Form -->
							<form method="post" name="loginfrm" action="script/empl_login.php">
							<div class="form-group">
							<!--<select name="account_type" class="form-control" required>
                            <option value="">Select Employee Type</option>
                            
							
							<?php
                           $counter_sql="select * from counter order by countr ASC";
                           $counter_result=mysqli_query($link,$counter_sql);
                           while($counter_row=mysqli_fetch_array($counter_result)){
							   if($counter_row['primary_role'] == 'accountant' || $counter_row['primary_role'] == 'hr'){}
							   else{
                          ?>
                          <option value="<?php echo $counter_row['id']; ?>" 
                          ><?php echo $counter_row['countr']; ?></option>
                        <?php } }?>

                            </select> -->
							</div>
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" name="email" type="email">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Forgot password?
											</a>
										</div>
									</div>
									<input class="form-control" name="password" type="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" name="button">Login</button>
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