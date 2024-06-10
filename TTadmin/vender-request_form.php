<?php
include('includes/configset.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>AdminLTE | Data Tables</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/richtext.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include('includes/head.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php'); ?>
  <?php 
if (isset($_REQUEST['cms'])){$page_id=$_REQUEST['cms'];}else{$page_id=0;}
$sql_cms="select * from users WHERE id=$page_id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);

$sql_company="select * from company_details WHERE user_id=$page_id"; 
$result_company=mysqli_query($link,$sql_company); 
$list_company=mysqli_fetch_array($result_company);

$vendor_type_id = $list_company['vendor_type'];
$sql_vendortype="select * from vendor_type WHERE id=$vendor_type_id"; 
$result_vendortype=mysqli_query($link,$sql_vendortype); 
$list_vendortype=mysqli_fetch_array($result_vendortype);

$vendor_reg_id = $list_company['vendor_registration_type'];
$sql_vendoreg="select * from vendor_registration_type WHERE venreg_id=$vendor_reg_id"; 
$result_vendoreg=mysqli_query($link,$sql_vendoreg); 
$list_vendorreg=mysqli_fetch_array($result_vendoreg);
	
$vendor_cat_id = $list_company['vendor_category'];
$sql_vendorcat="select * from vendor_category WHERE id=$vendor_cat_id"; 
$result_vendorcat=mysqli_query($link,$sql_vendorcat); 
$list_vendorcat=mysqli_fetch_array($result_vendorcat);
	
$vendor_coun_id = $list_company['vendor_category'];
$sql_vendorcoun="select * from country WHERE country_id=$vendor_coun_id"; 
$result_vendorcoun=mysqli_query($link,$sql_vendorcoun); 
$list_vendorcoun=mysqli_fetch_array($result_vendorcoun);	
	
?>
<?php if(isset($_REQUEST['cms'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 } ?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage CMS <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Vender Request- ".$row_cms['email'];
			  }
			  else
			  {
				echo "Add Vender Request";  
			  }
			 
 ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
     



      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Vender Request - ".$row_cms['email'];
			  }
			  else
			  {
				echo "Add Vender Request";  
			  }
			 
 ?>  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				
              <div class="box">
                
               <div class="tab-block" id = "tab-block">
  
  <ul class="tab-mnu">
    <li class = "active" >Your Company</li>
    <li>Trade License</li>
    <li>Contact Details</li>
    <li>Bank Details</li>
    <li>Attachments</li>
	 <li>Dec. & Undertaking</li>
  </ul>
  
  <div class="tab-cont">
    <div class="tab-pane">
	  	<table class="table" width="500">
		<tr><td><strong>Company Name : </strong><?php echo $list_company['company_name'];?> </td> <td><strong>Mobile : </strong> <?php echo $list_company['mobile'];?>  </td></tr>
		<tr><td><strong>Vendor Type : </strong> <?php echo $list_vendortype['vendorer_type_name'];?> </td><td><strong>Land Line : </strong><?php echo $list_company['phone'];?> </td></tr>
		<tr><td><strong>Vendor Registration Type : </strong> <?php echo $list_vendorreg['vendor_registration_name'];?> </td><td><strong>Fax : </strong> <?php echo $list_company['fax'];?>  </td></tr>
		<tr><td><strong>Vendor Category : </strong> <?php echo $list_vendorcat['vendor_category_name'];?> </td><td><strong>Address : </strong><?php echo $list_company['address'];?>, <strong>Postal code : </strong> <?php echo $list_company['postal_code'];?>  </td></tr>
		<tr><td><strong>Country : </strong><?php echo $list_vendorcoun['cname'];?>  </td><td><strong>Office / Building Number : </strong> <?php echo $list_company['builing_no'];?>  </td></tr>
		<tr><td><strong>UAE VAT Registration Status : </strong> <?php echo $list_company['vat_no'];?> <?php if($list_company['vat_registration_no'] && $list_company['vat_no']=='eligible'){ echo ", <strong>VAT Registration No</strong> : ".$list_company['vat_registration_no'];} ?> </td><td><strong>City : </strong><?php echo $list_company['city'];?>  </td></tr>
		<tr><td><strong>PO .Box : </strong><?php echo $list_company['po_box'];?>  </td><td><strong>Main Activities : </strong><?php echo $list_company['main_activities'];?>  </td></tr>
			
		</table>
	  
	  </div>
	  
    <div class="tab-pane">
	  	<table class="table" width="500">
		<tr><td><strong>License No : </strong><?php echo $list_company['license_no'];?> </td> <td><strong>Place of Issue : </strong> <?php echo $list_company['place_of_issue'];?>  </td></tr>
		<tr><td><strong>Valid From : </strong> <?php echo $list_company['valid_from'];?> </td><td><strong>Valid Till : </strong><?php echo $list_company['valid_till'];?> </td></tr>	
		</table>
		
	  </div>
	  
    <div class="tab-pane">
	  <table class="table" width="500">
		<tr><td><strong>Contact Name : </strong><?php echo $list_company['contact_name'];?> </td> <td><strong>Contact Person Emirates ID : </strong> <?php echo $list_company['contract_person_emirates_id'];?>  </td></tr>
		<tr><td><strong>Contact Possition : </strong> <?php echo $list_company['contract_possition'];?> </td><td><strong>Contact Person in EO : </strong><?php echo $list_company['contract_person_eo'];?> </td></tr>
		  <tr><td><strong>Contact Mobile : </strong> <?php echo $list_company['contract_mobile'];?> </td><td><strong>Contact Department in EO : </strong><?php echo $list_company['contract_department_eo'];?> </td></tr>
		</table>
	  </div>
    <div class="tab-pane">
	   <table class="table" width="500">
		<tr><td><strong>Bank Country : </strong><?php echo $list_company['bank_country'];?> </td> <td><strong>Bank Names : </strong> <?php echo $list_company['bank_names'];?>  </td></tr>
		<tr><td><strong>Account number : </strong> <?php echo $list_company['account_number'];?> </td><td><strong>Currency  : </strong><?php echo $list_company['currency'];?> </td></tr>
		  <tr><td><strong>Bank Key : </strong> <?php echo $list_company['bank_key'];?> </td><td><strong>Branch  : </strong><?php echo $list_company['branch'];?> </td></tr>
		   <tr><td><strong>IBAN  : </strong> <?php echo $list_company['iban'];?> </td><td><strong>Swft Code  : </strong><?php echo $list_company['swft_code'];?> </td></tr>
		</table>
	  </div>
    <div class="tab-pane">
		<table class="table" width="500">
	  <tr><td><strong>Trade License : </strong><?php if($list_company['image']){echo "<a href='../uploads/".$list_company['image']."' target='_blank'>Download</a>";}else{echo "Null!";} ?> </td> <td><strong>VAT Certificate : </strong> <?php if($list_company['image2']){echo "<a href='../uploads/".$list_company['image2']."' target='_blank'>Download</a>";}else{echo "Null!";} ?>  </td></tr>
		<tr><td><strong>Partners Passport Copy : </strong> <?php if($list_company['image3']){echo "<a href='../uploads/".$list_company['image3']."' target='_blank'>Download</a>";}else{echo "Null!";} ?> </td><td><strong>Local Sponser Passport Copy  : </strong><?php if($list_company['image4']){echo "<a href='../uploads/".$list_company['image4']."' target='_blank'>Download</a>";}else{echo "Null!";} ?> </td></tr>
		  <tr><td><strong>Visa Copy : </strong> <?php if($list_company['image5']){echo "<a href='../uploads/".$list_company['image5']."' target='_blank'>Download</a>";}else{echo "Null!";} ?> </td><td></td></tr>
		</table>
	  
	  </div>
	  
	  <div class="tab-pane">
		<table class="table" width="500">
	  
				<tr><td>
				<h4>Conflict of Interest</h4>
				<p>Please declare any actual or perceived conflict of interest that your Company may have in working with EO.</p> 
				<P><strong>Ans. </strong> <?php echo $list_company['conflict_of_interest'];?></P>
				</td></tr>
			
			<tr><td>
					
				<p>Is any owner or person with an interest in the Company's profits, or first degree relative currently employed with EO, or was employed with EO in the past?</p> 
				<P><strong>Ans. </strong> <?php if($list_company['enginer_name'] || $list_company['dest_engineer'] || $list_company['period_form'] || $list_company['period_to']){
				if($list_company['enginer_name']){echo "<strong>Name :</strong> ".$list_company['enginer_name']."<br>";}
				if($list_company['dest_engineer']){echo "<strong>Designation with Engineering Office :</strong> ".$list_company['dest_engineer']."<br>";}
				if($list_company['period_form']){echo "<strong>Employment Period From :</strong> ".$list_company['period_form']."<br>";}
				if($list_company['period_to']){echo "<strong>Employment Period To : </strong>".$list_company['period_to']."<br>";}
}else{echo "No";} ?></P>
				</td></tr>
			
			<tr><td>
				<h4>Legal Matters</h4>
				<p>Has your Company previously or is it currently involved in any litigation, arbitration or alternative dispute resolution?</p> 
				<P><strong>Ans. </strong> <?php if($list_company['legal_matters']){ echo $list_company['legal_matters'];} else{echo "Nul!";}?></P>
				</td></tr>
			<tr><td>
				
				<p>Has your Company previously or is it currently involved in any litigation, arbitration or alternative dispute resolution?</p> 
				<P><strong>Ans. </strong> <?php if($list_company['legal_matters2']){ echo $list_company['legal_matters2'];} else{echo "Nul!";}?></P>
				</td></tr>
			
			<tr><td>
				<h4>Additional Information</h4>
				<p>Is the company affiliated (prequalified/ approved/ certified/ accredited/ engaged) with any UAE Govt. Authority (ies) , please mention below</p> 
				<P><strong>Ans. </strong> <?php if($list_company['additional_information']){ echo $list_company['additional_information'];} else{echo "Nul!";}?></P>
				</td></tr>
			
		</table>
	  
	  </div>
  </div>

</div>
				  

				  
                

              </div>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content --> 
  </aside>
  <!-- /.right-side --> 
</div>
<!-- ./wrapper --> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	
	$(document).ready(function(){
  
  var tabWrapper = $('#tab-block'),
      tabMnu = tabWrapper.find('.tab-mnu  li'),
      tabContent = tabWrapper.find('.tab-cont > .tab-pane');
  
  tabContent.not(':first-child').hide();
  
  tabMnu.each(function(i){
    $(this).attr('data-tab','tab'+i);
  });
  tabContent.each(function(i){
    $(this).attr('data-tab','tab'+i);
  });
  
  tabMnu.click(function(){
    var tabData = $(this).data('tab');
    tabWrapper.find(tabContent).hide();
    tabWrapper.find(tabContent).filter('[data-tab='+tabData+']').show(); 
  });
  
  $('.tab-mnu > li').click(function(){
    var before = $('.tab-mnu li.active');
    before.removeClass('active');
    $(this).addClass('active');
   });
  
});
	</script>
 <script type="text/javascript" src="js/jquery.richtext.js"></script>
 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<!-- AdminLTE App --> 
<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="js/AdminLTE/demo.js" type="text/javascript"></script>
 <script>
        $(document).ready(function() {
            $('.editor1').richText();
        });
	 
	 
        </script> 
<!-- page script --> 

</body>
</html>
