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

if(isset($_REQUEST['slip'])){
	$slipID = $_REQUEST['slip'];
	$SQDepart="select * from salary where salary_id='$slipID' order by salary_id DESC";
	$ResultDepart=mysqli_query($link,$SQDepart);
	$ListDepart=mysqli_fetch_array($ResultDepart);
	$emplID = $ListDepart['staff_id'];
	$SqlEmpl="select * from users LEFT JOIN department ON users.destination=department.depart_id where id='$emplID'";
	$ResultEmpl=mysqli_query($link,$SqlEmpl);
	$ListEmplrow=mysqli_fetch_array($ResultEmpl);
	
	$SQLCompany="select * from company_details where user_type='1' limit 1";
	$ResultCompany=mysqli_query($link,$SQLCompany);
	$ListCompany=mysqli_fetch_array($ResultCompany);
	
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");?>
		<script src="assets\js\jquery-3.5.1.min.js"></script>
		
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
								<h3 class="page-title">Payslip</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Payslip</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<div class="btn-group btn-group-sm">
									<button class="btn btn-white" id="downloadPDF">PDF</button>
									<button class="btn btn-white print"><i class="fa fa-print fa-lg"></i> Print</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					
					<div class="row invo" id="content2">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title">Payslip for the month of <?php 
										$leave_date_from = str_replace('/', '-', $ListDepart['salary_date']);
										echo date("d M Y", strtotime($leave_date_from));
										?></h4>
									<div class="row">
										<div class="col-sm-6 m-b-20">
											<img src="images/Splendid-crm-logo.jpg" class="inv-logo" alt="">
											<ul class="list-unstyled mb-0">
												<li><strong><?php echo $ListCompany['company_name'];?></strong></li>
												<li><?php echo $ListCompany['address'];?></li>
												<li><?php echo $ListCompany['city'];?>, <?php echo $ListCompany['country'];?></li>
											</ul>
										</div>
										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase">Payslip #<?php echo $ListDepart['salary_id'];?></h3>
												<ul class="list-unstyled">
													<li>Salary Month: <span><?php echo date("M, Y", strtotime($leave_date_from));?></span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 m-b-20">
											<ul class="list-unstyled">
												<li><h5 class="mb-0"><strong><?php echo $ListEmplrow['fullname'];?></strong></h5></li>
												<li><span><?php echo $ListEmplrow['dep_name'];?></span></li>
												<li>Employee ID: FT-00<?php echo $ListEmplrow['id'];?></li>
												<li>Joining Date: <?php $joinindate = str_replace('/', '-', $ListEmplrow['dob']);
										echo date("d M Y", strtotime($joinindate));?></li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Earnings</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Basic Salary</strong> <span class="float-right">
																<?php echo $basic = $ListDepart['basic'];?></span></td>
														</tr>
														<?php $da = '0'; if($ListDepart['da']){?>
														<tr>
															<td><strong>DA</strong> <span class="float-right">
																<?php echo $da = $ListDepart['da'];?></span></td>
														</tr>
														<?php } ?>
														<?php $hra = '0'; if($ListDepart['hra']){?>
														<tr>
															<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right"><?php echo $hra = $ListDepart['hra'];?></span></td>
														</tr>
														<?php } ?>
														<?php $conveyance = '0'; if($ListDepart['conveyance']){?>
														<tr>
															<td><strong>Conveyance</strong> <span class="float-right">
																<?php echo $conveyance = $ListDepart['conveyance'];?></span></td>
														</tr>
														<?php } ?>
														
														<?php $allowance = '0'; if($ListDepart['allowance']){?>
														<tr>
															<td><strong>Allowance</strong> <span class="float-right">
																<?php echo $allowance = $ListDepart['allowance'];?></span></td>
														</tr>
														<?php } ?>
														
														<?php $medical_allowance = '0'; if($ListDepart['medical_allowance']){?>
														<tr>
															<td><strong>Medical Allowance</strong> <span class="float-right">
																<?php echo $medical_allowance = $ListDepart['medical_allowance'];?></span></td>
														</tr>
														<?php } ?>
														<?php $other = '0'; if($ListDepart['other']){?>
														<tr>
															<td><strong>Other</strong> <span class="float-right">
																<?php echo $other = $ListDepart['other'];?></span></td>
														</tr>
														<?php } ?>
														
														<tr>
															<td><strong>Total Earnings</strong> <span class="float-right"><strong>
																<?php echo $earning = ($da + $hra + $conveyance + $allowance + $medical_allowance + $other);?></strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Deductions</strong></h4>
												<table class="table table-bordered">
													<tbody>
														
														<?php $tds = '0'; if($ListDepart['tds']){?>
														<tr>
															<td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="float-right">
																<?php echo $tds = $ListDepart['tds'];?></span></td>
														</tr>
														<?php } ?>
														
														<?php $esi = '0'; if($ListDepart['esi']){?>
														<tr>
															<td><strong>ESI</strong> <span class="float-right">
																<?php echo $esi = $ListDepart['esi'];?></span></td>
														</tr>
														<?php } ?>
														<?php $pf = '0'; if($ListDepart['pf']){?>
														<tr>
															<td><strong>Provident Fund</strong> <span class="float-right">
																<?php echo $pf = $ListDepart['pf'];?></span></td>
														</tr>
														<?php } ?>
														<?php $prof_tax = '0'; if($ListDepart['prof_tax']){?>
														<tr>
															<td><strong>Prof. Tax</strong> <span class="float-right">
																<?php echo $pf = $ListDepart['prof_tax'];?></span></td>
														</tr>
														<?php } ?>
														
														
														
														<?php $labour_welfare = '0'; if($ListDepart['labour_welfare']){?>
														<tr>
															<td><strong>Labour Welfare</strong> <span class="float-right">
																<?php echo $labour_welfare = $ListDepart['labour_welfare'];?></span></td>
														</tr>
														<?php } ?>
														
														<?php $others = '0'; if($ListDepart['others']){?>
														<tr>
															<td><strong>Others</strong> <span class="float-right">
																<?php echo $others = $ListDepart['others'];?></span></td>
														</tr>
														<?php } ?>
														
														<tr>
															<td><strong>Total Deductions</strong> <span class="float-right"><strong>
																<?php echo $deduction = ($tds + $esi + $pf + $prof_tax + $labour_welfare + $others); ?></strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-12">
											<p><strong>Net Salary: <?php
												$TotalSalary = ($basic + $earning) - $deduction;
												echo number_format($TotalSalary,2, '.', ',');?></strong> (<?php echo getIndianCurrency($TotalSalary);?>)</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		
         <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets\js\select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		<script src="assets\js\divjs.js"></script>
	
		<script>
			
			$("#downloadPDF").click(function () {
  // $("#content2").addClass('ml-215'); // JS solution for smaller screen but better to add media queries to tackle the issue
  getScreenshotOfElement(
    $("div#content2").get(0),
    0,
    0,
    $("#content2").width() + 45,  // added 45 because the container's (content2) width is smaller than the image, if it's not added then the content from right side will get cut off
    $("#content2").height() + 30, // same issue as above. if the container width / height is changed (currently they are fixed) then these values might need to be changed as well.
    function (data) {
      var pdf = new jsPDF("l", "pt", [
        $("#content2").width(),
        $("#content2").height(),
      ]);

      pdf.addImage(
        "data:image/png;base64," + data,
        "PNG",
        0,
        0,
        $("#content2").width(),
        $("#content2").height()
      );
      pdf.save("<?php echo "PaySlip-".$ListEmplrow['fullname']."-".$leave_date_from;?>.pdf");
    }
  );
});

// this function is the configuration of the html2cavas library (https://html2canvas.hertzen.com/)
// $("#content2").removeClass('ml-215'); is the only custom line here, the rest comes from the library.
function getScreenshotOfElement(element, posX, posY, width, height, callback) {
  html2canvas(element, {
    onrendered: function (canvas) {
      // $("#content2").removeClass('ml-215');  // uncomment this if resorting to ml-125 to resolve the issue
      var context = canvas.getContext("2d");
      var imageData = context.getImageData(posX, posY, width, height).data;
      var outputCanvas = document.createElement("canvas");
      var outputContext = outputCanvas.getContext("2d");
      outputCanvas.width = width;
      outputCanvas.height = height;

      var idata = outputContext.createImageData(width, height);
      idata.data.set(imageData);
      outputContext.putImageData(idata, 0, 0);
      callback(outputCanvas.toDataURL().replace("data:image/png;base64,", ""));
    },
    width: width,
    height: height,
    useCORS: true,
    taintTest: false,
    allowTaint: false,
  });
}
		
		</script>
		
	<script>
  $('.print').click(function(){
    $('.invo').printElement({
    });
  })
</script>
		
		
    </body>
</html>