<?php 

include('includes/configset.php');

$page_name=$_REQUEST['page_name'];

$content=$_REQUEST['content'];
$page_id=$_REQUEST['page_id'];
$category=$_REQUEST['category'];
$sidebar=$_REQUEST['sidebar'];
$topbar=$_REQUEST['topbar'];
$footer=$_REQUEST['footer'];
$sortorder=$_REQUEST['sortorder'];
$seokeyword2=$_REQUEST['seo_keyword'];
$seokeyword = str_replace(' ','-',$page_name);
$seokeyword24=str_replace(' ','-',$seokeyword2);
$sekey=mb_strtolower($seokeyword24);
$sekey2=mb_strtolower($seokeyword);
$image=$_REQUEST['image'];
$meta_title=$_REQUEST['meta_title'];
$meta_description=$_REQUEST['meta_description'];
$meta_keywords=$_REQUEST['meta_keywords'];
$shortdescription=$_REQUEST['shortdescription'];
$status=$_REQUEST['status'];
if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="../$path".$rand1.$_FILES["image"]["name"];
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
if (($_FILES["image2"]["type"] == "image/gif")
|| ($_FILES["image2"]["type"] == "image/jpeg")
|| ($_FILES["image2"]["type"] == "image/pjpeg")
|| ($_FILES["image2"]["type"] == "image/X-PNG")
|| ($_FILES["image2"]["type"] == "image/PNG")
|| ($_FILES["image2"]["type"] == "image/png")
|| ($_FILES["image2"]["type"] == "image/x-png"))
{
$image2="../$path".$rand1.$_FILES["image2"]["name"];
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

if(isset($_REQUEST['update']))
{


$query="update cms_pages SET page_name='$page_name',sortorder=$sortorder, seo_keyword='$sekey',content='$content', topbar='$topbar',footer='$footer',sidebar='$sidebar',category='$category' ,meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',image='$image0',shortdescription='$shortdescription',image2='$image01' WHERE page_id=$page_id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{
$query="insert into cms_pages(page_name,sortorder,seo_keyword,content,category,sidebar,topbar,footer,meta_title,meta_description,meta_keywords,status,image,shortdescription,image2) values('$page_name','$sortorder','$sekey2','$content','$category','$sidebar','$topbar','$footer','$meta_title','$meta_description','$meta_keywords','1','$image0','$shortdescription','$image01')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['id']) || isset($_REQUEST['id1']))
{
if(isset($_REQUEST['id']))
{
$page_id=$_REQUEST['id'];
$status='0';
}
else if(isset($_REQUEST['id1']))
{
$page_id=$_REQUEST['id1'];	
$status='1';
$sql_users41 = "select * from users where id='$page_id' and account_type='1'"; 
	$Reslut_users41 = mysqli_query($link,$sql_users41); 
	$listusers41 = mysqli_fetch_array($Reslut_users41);	
	$email_to = $listusers41['email'];
	$vendorpass= $listusers41['password'];
    $email_subject = "Vendor Register Success - $email_to";
	$email_massage="<div style='box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; padding: 30px;'><div><img src='https://www.splendid.ae/images/logo-2.png' style='width: 150px'></div><p><strong>Hi ,</strong></p><p><strong>Welcome to Splendid Portal.</strong></p><p>You have successfully aproved your details. Please follow the below credential</p><p><strong>Portal URL :</strong> https://crm.hostsplendid.com/<br><strong>Username : </strong> $email_to <br> <strong>password : </strong> $vendorpass		 </p><div><p><strong>Thanks</strong>,<br>Splendid Design It Technology LLC.<br>Central HR Group.</p></div></div>";
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: www.splendid.ae"."<hr@splendid.ae>\r\n";
	mail($email_to, $email_subject, $email_massage, $headers); 	
}
else
{
$status='0';	
}
$query="update users SET status='$status' WHERE id='$page_id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from users WHERE id=$id";
mysqli_query($link,$query);
}

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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript">
function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmUser.action = "script/all-delate.php";
document.frmUser.submit();
}
}
function setInactiveAction() {
document.frmUser.action = "script/allinactive.php";
document.frmUser.submit();
}
function setActiveAction() {
document.frmUser.action = "script/activepage.php";
document.frmUser.submit();
}
</script>
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include('includes/head.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php'); ?>
  
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage CMS <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active">Vender Request</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin-bottom: 0!important;' class='alert alert-info'><i class='fa fa-info'></i><b>Note:</b>" .$msg."</div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vender Request for Content Managment System</h3>
              <!--a href="vender-request_form.php">
              <button class="btn btn-success" style="float:right; margin:10px;">Add New</button>
              </a--> </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form name="frmUser" method="post" action="">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>All</th>
                      <th>Order</th>
                      <th>Email</th>
                      <th>Company Name</th>
						<th>Phone</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
					  
$sql_cms="select * from users LEFT JOIN company_details ON users.id=company_details.user_id where account_type='1' order by status ASC"; 
 $result_cms=mysqli_query($link,$sql_cms); 
 while($row_cms=mysqli_fetch_array($result_cms)) {
	 
?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /></td>
                      <td><?php echo $row_cms['sortorder'];?></td>
                      <td><?php echo $row_cms['email']; ?></td>
                      <td><?php echo $row_cms['company_name'];?></td>
						<td><?php echo $row_cms['mobile'];?></td>
                      <td><a href="vender-request_form.php?cms=<?php echo $row_cms['id'];?>" class="edit_btn"><span>Edit</span></a>
                        <?php if($row_cms['status']==1){ ?>
                        <span><a href="vender_request_manage.php?id=<?php echo $row_cms['id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="vender_request_manage.php?id1=<?php echo $row_cms['id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="vender_request_manage.php?del=<?php echo $row_cms['id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                   
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>All</th>
                      <th>Order</th>
                      <th>Heading</th>
                      <th>URL Link</th>
                      <th>Modify</th>
                    </tr>
                  </tfoot>
                </table>
                <input type="button" name="delete" value="All Delete" class="btn btn-danger btn-sm"  onClick="setDeleteAction();" />
                <input type="button" name="Inactive" value="All Inactive" class="btn btn-warning btn-sm" onClick="setInactiveAction();" />
                <input type="button" name="Active" class="btn btn-success btn-sm" value="All Active" onClick="setActiveAction();" />
              </form>
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
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> 
<!-- AdminLTE App --> 
<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="js/AdminLTE/demo.js" type="text/javascript"></script> 
<!-- page script --> 
<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
</body>
</html>
