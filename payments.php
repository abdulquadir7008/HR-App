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
 
if(isset($_POST['add']) || isset($_POST['update'])){
	$client = $_REQUEST['client'];
	$project = $_REQUEST['project'];
	$email = $_REQUEST['email'];
	$tax = $_REQUEST['tax'];
	$client_address = $_REQUEST['client_address'];
	$billing_address = $_REQUEST['billing_address'];
	$estimate_date = $_REQUEST['estimate_date'];
	$expire_date = $_REQUEST['expire_date'];
	$othet_information = $_REQUEST['othet_information'];
}
if(isset($_POST['add'])){
$querybord="insert into spl_invoice (client,project,email,tax,client_address,billing_address,estimate_date,expire_date,status,othet_information) values('$client','$project','$email','$tax','$client_address','$billing_address','$estimate_date','$expire_date','1','$othet_information')";
mysqli_query($link,$querybord);
$last_id = mysqli_insert_id($link);
foreach($_POST['item'] as $index => $item) {
		$description =$_POST['description'][$index];
		$unitcost =$_POST['unitcost'][$index];
		$qty =$_POST['qty'][$index];
		$amount =$_POST['amount'][$index];
  	$query1001 = "INSERT INTO invoice_item(item,description,unitcost,qty,amount,etimate_id) values ('$item','$description','$unitcost','$qty','$amount','$last_id')";
  mysqli_query($link,$query1001);
}
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Add Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
//header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$estimate_id = $_REQUEST['estimate_id'];
$query="update spl_invoice SET client='$client',project='$project',email='$email',tax='$tax',client_address='$client_address',billing_address='$billing_address',estimate_date='$estimate_date',expire_date='$expire_date',othet_information='$othet_information' WHERE estimate_id=$estimate_id";
mysqli_query($link,$query);

foreach($_POST['item'] as $index2 => $revnue2) {
		$description =$_POST['description'][$index2];
		$ider =$_POST['itemid'][$index2];
		$item =$_POST['item'][$index2];
		$unitcost =$_POST['unitcost'][$index2];
		$qty =$_POST['qty'][$index2];
		$amount =$_POST['amount'][$index2];
		
	if($ider){
  	$query100="update invoice_item SET item='$item',description='$description',unitcost='$unitcost',qty='$qty',amount='$amount' WHERE estimate_item_id=$ider";
 mysqli_query($link,$query100);
		}
		else if(empty($item)){
  	$query="delete from invoice_item WHERE estimate_item_id=$ider";
mysqli_query($link,$query);
	}
		else
		{
			
		$query1001 = "INSERT INTO invoice_item(item,description,unitcost,qty,amount,etimate_id) values ('$item','$description','$unitcost','$qty','$amount','$estimate_id')";
  mysqli_query($link,$query1001);
			
		}
	
	
}	
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>invoice item Update Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
//header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from spl_invoice WHERE estimate_id=$del";
mysqli_query($link,$query);
$query12="delete from invoice_item WHERE etimate_id=$del";
mysqli_query($link,$query12);	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$sql_admin="select * from invoice_setting WHERE user_type='1'";
$result_admin=mysqli_query($link,$sql_admin);
$list_admin=mysqli_fetch_array($result_admin);
if(isset($_REQUEST['search_crm'])){
		echo $search_employe = $_REQUEST['search_employe'];
	
	if(isset($_REQUEST['from_search']) && isset($_REQUEST['to_search']) ){
		
			if($_REQUEST['from_search']!='' && $_REQUEST['to_search']!=''){
			echo $from_search = $_REQUEST['from_search'];
			echo $to_search =$_REQUEST['to_search'];
			
		$bwch = "AND estimate_date between '".$from_search."' AND '".$to_search."'";
	}
		else
		{$bwch = '';}
	}
}
else if(isset($_REQUEST['reset'])){
		$from_search='';
		$to_search = '';
		$bwch = '';
		$search_employe='';
	}

if(isset($_REQUEST['aprove']))
{
$aprove=$_REQUEST['aprove'];
$query="update spl_invoice SET status='2' WHERE estimate_id=$aprove";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['decline']))
{
$decline=$_REQUEST['decline'];
$query="update spl_invoice SET status='1' WHERE estimate_id=$decline";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
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
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Invoice</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Invoice</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable mb-0">
									<thead>
										<tr>
											<th>Invoice Number</th>
											<th>Client</th>
											<th>Paid Date</th>
											<th>Paid Amount</th>
											
										</tr>
									</thead>
									<tbody>
										
										<?php
										$k= 1;
										$SQLestimate="select * from spl_invoice WHERE admin_id=$cont_hr_id and status='2' order by estimate_id DESC";
										$Resultestimate=mysqli_query($link,$SQLestimate);
										while($listestimate=mysqli_fetch_array($Resultestimate)){
										$clientid = $listestimate['client'];
										$myOriginalDate = str_replace('/', '-', $listestimate['expire_date']);
					$curdate_holiday = strtotime(date("d-m-Y"));
					$holiday = strtotime($myOriginalDate);	
											$estimate_id = $listestimate['estimate_id'];
										$sqlclients="select * from clients WHERE client_id='$clientid'";
										$resultclients=mysqli_query($link,$sqlclients);
										$listclients=mysqli_fetch_array($resultclients);
										
											
										?>
										<tr>
											<td><a href="invoice_view.php?edit=<?php echo $estimate_id;?>"><?php echo $list_admin['invocie_prifix'];?>-000<?php echo $estimate_id;?></a></td>
											<td><?php echo $listclients['company_name'];?></td>
											<td><?php echo $listestimate['expire_date'];?>
											
											</td>
											<td>
												
												<?php 
											$totalSum = '0';
											$sqlitem="select * from invoice_item WHERE etimate_id='$estimate_id'";
										$resultitemprice=mysqli_query($link,$sqlitem);
										while ($listitem=mysqli_fetch_array($resultitemprice)){
											$itemtotal  =$listitem['qty'] * $listitem['unitcost'];
											$totalSum += $itemtotal;
											
										} echo ($totalSum * $listestimate['tax'] / 100) + $totalSum;?>
											</td>
											
											
										</tr>
										
										
										<?php $k++; } ?>
										
										
																				
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Delete Estimate Modal -->
				
				<!-- /Delete Estimate Modal -->
			
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