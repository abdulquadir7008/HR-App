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
 if($customerchechlogin_row['account_type']=='1'){
	$cont_hr_id = $customerchechlogin_id;
}
else{
	$cont_hr_id = $customerchechlogin_row['parent_admin'];
}
$sql_hr_req="select * from counter WHERE admin_id=$cont_hr_id";
$result_hr_req=mysqli_query($link,$sql_hr_req);
$list_hr_req=mysqli_fetch_array($result_hr_req);
$hr_id = $list_hr_req['id'];
if (isset($_REQUEST['edit'])){$id=$_REQUEST['edit'];}else{$id=0;}
$sql_cms="select * from estimate WHERE estimate_id=$id"; 
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
$query="delete from estimate_item WHERE estimate_item_id=$del";
mysqli_query($link,$query);
	header("Location:estimate_form.php?edit=".$id);
}
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
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Create Estimate</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Estimate</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<form method="post" action="estimates.php">
								<div class="row">
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Client <span class="text-danger">*</span></label>
											<select class="select" name="client" onChange="showCat(this);">
												<option>Please Select</option>
												<?php 
												$sqlclient="select * from clients WHERE admin_id=$cont_hr_id and status='1'";
													$resultclient=mysqli_query($link,$sqlclient);
														while($listclient=mysqli_fetch_array($resultclient)){
												?>
												<option value="<?php echo $listclient['client_id'];?>" <?php if($row_cms['client'] == $listclient['client_id']){?>selected<?php } ?> ><?php echo $listclient['company_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Project <span class="text-danger">*</span></label>
											<select class="select" id="output11" name="project">
												<?php if($row_cms['project']){
													$projID =$row_cms['project'];
													$sqlproj="select * from project WHERE id=$projID"; 
													$resultproj=mysqli_query($link,$sqlproj); 
													$listproj=mysqli_fetch_array($resultproj);
												?> 
												<option value="<?php echo $listproj['id'];?>" selected><?php echo $listproj['project_name'];?></option>
												<?php } ?>
												<option>Select Project</option>
												
											</select>
										</div>
									</div>
									
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" value="<?php echo $row_cms['email'];?>" type="email" name="email">
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Tax</label>
											<select class="select taxen" name="tax">
												<option value="0">Select Tax</option>
												<?php 
												$sqltaxs="select * from taxes WHERE admin_id=$cont_hr_id and status='1'";
													$resultaxs=mysqli_query($link,$sqltaxs);
														while($listtaxs=mysqli_fetch_array($resultaxs)){
												?>
												<option value="<?php echo $listtaxs['tax_perctange'];?>" <?php if($row_cms['tax'] == $listtaxs['tax_perctange']){?>selected<?php } ?> ><?php echo $listtaxs['taxe_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Client Address</label>
											<textarea class="form-control" name="client_address" rows="3"><?php echo $row_cms['client_address'];?></textarea>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Billing Address</label>
											<textarea class="form-control" name="billing_address" rows="3"><?php echo $row_cms['billing_address'];?></textarea>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Estimate Date <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" value="<?php echo $row_cms['estimate_date'];?>" name="estimate_date" type="text">
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Expiry Date <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" value="<?php echo $row_cms['expire_date'];?>" name="expire_date" type="text">
											</div>
										</div>
									</div>
								</div>
								
								
								
								<div class="row invoice-body" id="myTable">
									<div class="col-md-12 col-sm-12">
										<div class="table-responsive" style="overflow: visible;">
											<table class="table table-hover table-white">
												<thead>
													<tr>
														<th class="col-md-1">#</th>
														<th class="col-sm-3">Item</th>
														<th class="col-md-4">Description</th>
														<th class="col-sm-1" style="padding-left: 2%;">Unit Cost</th>
														<th class="col-sm-1" style="padding-left: 2%;">Qty</th>
														<th class="col-sm-2" style="padding-left: 2%;">Amount</th>
														<th> </th>
													</tr>
												</thead>
											
												
											</table>
											<?php 
												$sqlestitem="select * from estimate_item WHERE etimate_id='$id'";
													$resultest=mysqli_query($link,$sqlestitem);
														while($listetitm=mysqli_fetch_array($resultest)){
												?>
											<div class="row single-row" style="margin-bottom: 15px;">
												<input type="hidden" name="itemid[]" value="<?php echo $listetitm['estimate_item_id'];?>">
												<div class="col-md-1">
															<input class="form-control" type="text">
												</div>
															<div class="col-md-3">
														<input class="form-control" type="text" value="<?php echo $listetitm['item'];?>" name="item[]">
														</div>
													<div class="col-md-4">
														<input class="form-control" type="text" value="<?php echo $listetitm['description'];?>" name="description[]">
														</div>
														<div class="col-md-1">
															<input class="form-control price" value="<?php echo $listetitm['unitcost'];?>" type="text" onkeyup="update_amounts()" name="unitcost[]">
														</div>
														<div class="col-md-1">
															<input class="form-control qty" value="<?php echo $listetitm['qty'];?>" type="text" onkeyup="update_amounts()" name="qty[]">
														</div>
														<div class="col-md-1">
															<input class="form-control amount" value="<?php echo $listetitm['amount'];?>" type="text" onkeyup="update_amounts()"  id="" name="amount[]">
														</div>
														<a href="estimate_form.php?del=<?php echo $listetitm['estimate_item_id'];?>&&edit=<?php echo $row_cms['estimate_id'];?>" class="btn-remove-customer"><i class="fa fa-minus-circle"></i></a>
														</div>
											<?php } ?>
											<div class="customer_records">
												<div class="row single-row">
													<input type="hidden" name="itemid[]">
												<div class="col-md-1">
															<input class="form-control" type="text">
												</div>
															<div class="col-md-3">
														<input class="form-control" type="text" name="item[]">
														</div>
													<div class="col-md-4">
														<input class="form-control" type="text" name="description[]">
														</div>
														<div class="col-md-1">
															<input class="form-control price" type="text" onkeyup="update_amounts()" name="unitcost[]">
														</div>
														<div class="col-md-1">
															<input class="form-control qty" type="text" onkeyup="update_amounts()" name="qty[]">
														</div>
														<div class="col-md-1">
															<input class="form-control amount" type="text" onkeyup="update_amounts()"  id="" name="amount[]">
														</div>
														
														</div>	
														</div>
														
												<div class="customer_records_dynamic estimate_cord"></div>
											
										</div>
										<a href="javascript:void(0)" class="text-success font-18 extra-fields-customer estim_increm" title="Add"><i class="fa fa-plus"></i></a>
										<div class="table-responsive">
											<table class="table table-hover table-white">
												<tbody>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Total</td>
														<td style="text-align: right; padding-right: 30px;width: 230px" >
														<span class="total">0</span>
														</td>
													</tr>
													<tr>
														<td colspan="5" class="text-right">Tax</td>
														<td style="text-align: right; padding-right: 30px;width: 230px">
															<input class="form-control text-right" id="tax" value="10" readonly="" type="text">
															
														</td>
													</tr>
													<tr>
														<td colspan="5" class="text-right">
															Discount %
														</td>
														<td style="text-align: right; padding-right: 30px;width: 230px">
															<input class="form-control text-right" type="text">
														</td>
													</tr>
													<tr>
														<td colspan="5" style="text-align: right; font-weight: bold">
															Grand Total
														</td>
														<td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
															<span class="subtotal"></span>
															
														</td>
													</tr>
												</tbody>
											</table>                               
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Other Information</label>
													<textarea class="form-control" rows="4" name="othet_information"><?php echo $row_cms['othet_information'];?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="submit-section">
									<input type="hidden" name="estimate_id" value="<?php echo $row_cms['estimate_id'];?>">
									<button class="btn btn-primary submit-btn m-r-10">Save & Send</button>
									<button class="btn btn-primary submit-btn" type="submit" name="<?php echo $sub;?>"><?php echo $sub2;?></button>
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