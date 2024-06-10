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
 $sql_admin="select * from invoice_setting WHERE user_type='1'";
$result_admin=mysqli_query($link,$sql_admin);
$list_admin=mysqli_fetch_array($result_admin);
if (isset($_REQUEST['edit'])){$id=$_REQUEST['edit'];}else{$id=0;}
$sql_cms="select * from spl_invoice WHERE estimate_id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
?>
      <?php if(isset($_REQUEST['edit'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 }
if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from invoice_item WHERE estimate_item_id=$del";
mysqli_query($link,$query);
	header("Location:invoice_form.php?edit=".$id);
}
$SQLCompany="select * from company_details where user_type='1' limit 1";
	$ResultCompany=mysqli_query($link,$SQLCompany);
	$ListCompany=mysqli_fetch_array($ResultCompany);
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
            <?php include("include/sidebar.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
			<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Invoice</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Invoice</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<div class="btn-group btn-group-sm">
									<button class="btn btn-white">CSV</button>
									<button class="btn btn-white">PDF</button>
									<button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-6 m-b-20">
											<img src="assets/img/logo2.png" class="inv-logo" alt="">
				 							<ul class="list-unstyled">
												<li><?php echo $ListCompany['company_name'];?></li>
												<li><?php echo $ListCompany['address'];?></li>
												<li><?php echo $ListCompany['city'];?>, <?php echo $ListCompany['country'];?></li>
											</ul>
										</div>
										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase">Invoice #<?php echo $list_admin['invocie_prifix'];?>-000<?php echo $row_cms['estimate_id'];?></h3>
												<ul class="list-unstyled">
													<li>Date: <span><?php echo $row_cms['estimate_date'];?></span></li>
													<li>Due date: <span><?php echo $row_cms['expire_date'];?></span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
											<h5>Invoice to:</h5>
				 							<ul class="list-unstyled">
												<?php
												$deptID =$row_cms['client'];
												$sqlclient="select * from clients WHERE status='1' AND client_id='$deptID'";
													$resultclient=mysqli_query($link,$sqlclient);
														while($listclient=mysqli_fetch_array($resultclient)){
												?>
												<li><h5><strong><?php echo $listclient['fullname'];?></strong></h5></li>
												<li><span><?php echo $listclient['company_name'];?></span></li>
												<li><?php echo $listclient['phone'];?></li>
												<li><a href="#"><?php echo $listclient['email'];?></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
											<span class="text-muted">Payment Details:</span>
											<ul class="list-unstyled invoice-payment-details">
												<li><h5>Total Due: <span class="text-right">$8,750</span></h5></li>
												
											</ul>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>ITEM</th>
													<th class="d-none d-sm-table-cell">DESCRIPTION</th>
													<th>UNIT COST</th>
													<th>QUANTITY</th>
													<th class="text-right">TOTAL</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$sqlestitem="select * from invoice_item WHERE etimate_id='$id'";
													$resultest=mysqli_query($link,$sqlestitem);
														while($listetitm=mysqli_fetch_array($resultest)){
												?>
												<tr>
													<td>1</td>
													<td><?php echo $listetitm['item'];?></td>
													<td class="d-none d-sm-table-cell"><?php echo $listetitm['description'];?></td>
													<td><?php echo $listetitm['unitcost'];?></td>
													<td><?php echo $listetitm['qty'];?></td>
													<td class="text-right"><?php echo $listetitm['amount'];?></td>
												</tr>
												<?php $subtotal = ($subtotal + $listetitm['amount']);} ?>
												
												
												
											</tbody>
										</table>
									</div>
									<div>
										<div class="row invoice-payment">
											<div class="col-sm-7">
											</div>
											<div class="col-sm-5">
												<div class="m-b-20">
													<div class="table-responsive no-border">
														<table class="table mb-0">
															<tbody>
																<tr>
																	<th>Subtotal:</th>
																	<td class="text-right"><?php echo $subtotal; ?></td>
																</tr>
																<tr>
																	<?php
																	$taxID = $row_cms['tax'];
																		$sqltaxs2="select * from taxes WHERE tax_perctange='$taxID'";
																		$resultaxs2=mysqli_query($link,$sqltaxs2);
																		$listtaxs2=mysqli_fetch_array($resultaxs2);
																		if($taxID){
																		?>
																	<th><?php echo $listtaxs2['taxe_name'];?>: <span class="text-regular">(<?php echo $listtaxs2['tax_perctange'];?>%)</span></th>
																	<td class="text-right">
																		<?php echo $taxadd = $subtotal * $listtaxs2['tax_perctange'] / 100 ;?>
																	</td>
																	<?php } ?>
																</tr>
																<tr>
																	<th>Total: </th>
																	<td class="text-right text-primary"><h5><?php echo $subtotal + $taxadd; ?></h5></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="invoice-info">
											<?php if($row_cms['othet_information']){?>
											<h5>Other information</h5>
											<p class="text-muted"><?php echo $row_cms['othet_information'];?></p>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>	
				
				<!-- Page Content -->
                
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
		
		<!-- Datatable JS -->
		<script src="assets\js\jquery.dataTables.min.js"></script>
		<script src="assets\js\dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
		<script>
			
	$(document).ready(function() {

  update_amounts();
  $('.qty').change(function() {
    update_amounts();
  });
});


function update_amounts() {
  var sum = 0.0;
  $('#myTable .single-row').each(function() {
    var qty = $(this).find('.qty').val();
    var price = $(this).find('.price').val();
	 
    var amount = parseFloat(qty) * parseFloat(price);
    amount = isNaN(amount) ? 0 : amount;
    sum += amount;
    $(this).find('.amount').text('' + amount);
    $(this).find('.amount').val('' + amount);
	
  });
  //just update the total to sum  
  $('.total').text(sum);
  $('.total').val(sum);
	
	
	$('.taxen').change(function () {
var select=$(this).find(':selected').val();        
var tax = $('#tax').val(sum * select / 100);
		var tax = (sum * select / 100);
	$('.subtotal').text(sum + tax);
	$('.subtotal').val(sum + tax);	
}).change();
  	
}

			
function showCat(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$("#output11").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "client_filter_script.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('#output11').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#output11").html( html );
			}
		});
	} 
}
			
$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-fieldkar btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic > .single').attr("class", "AlLRevenues remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-fieldkar', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});


</script>
		
		
		
    </body>
</html>