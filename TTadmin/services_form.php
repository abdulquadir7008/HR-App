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
<!-- daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/richtext.min.css">
        <!-- Theme style -->
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
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from about_home WHERE id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
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
      <h1> Manage Services Content <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Services</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify Services Content Change- ".$row_cms['title'];
			  }
			  else
			  {
				echo "Add Services Content";  
			  }
			 
 ?> </li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify Services Page - ".$row_cms['title'];
			  }
			  else
			  {
				echo "Add Services Page";  
			  }
			 
 ?> 
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="box box-primary"> 
                
                <!-- /.box-header --> 
                <!-- form start -->
                
                <form action="services_manage.php" method="post" enctype="multipart/form-data" name="cont"  id="myform" onSubmit="return validate();">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Services Full Title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['title']; ?>" >
                    </div>
                    
                   
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Kweyword Link</label>
                      <input type="text" name="kewords" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['kewords']; ?>" >
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputEmail1">Photo One</label>
                      <input type="file" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="image" value="<?php echo $row_cms['image']; ?>" />
                      <?php if($row_cms['image']!='') { image_size(); ?>
                      <img src="../uploads/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                      <?php } ?>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Services Short Title</label>
                      <input type="text" name="sort_ttile" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['sort_ttile']; ?>">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Short Description</label>
                      <textarea name="sort_decs" class="form-control"  rows="5" required><?php echo $row_cms['sort_decs']; ?></textarea>
                    </div>
 
                    <div class='box-body pad'>
                      <textarea id="editor1" class="editor1" name="description" rows="10"  cols="80">
                                            <?php echo $row_cms['description']; ?>
                                        </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['meta_title']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Keywords</label>
                      <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['meta_keywords']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Description</label>
                     <textarea name="meta_description" class="form-control"  rows="5"><?php echo $row_cms['meta_description']; ?></textarea>
                    </div>
                  <!-- /.box-body -->
                  
                  <div class="box-footer">
                    <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
                    <button type="submit"  name="<?php echo $sub ?>" class="btn btn-primary"><?php echo $sub2 ?></button>
                  </div>
                </form>
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
 <script type="text/javascript" src="js/jquery.richtext.js"></script>
 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<!-- AdminLTE App --> 
<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
<!-- Bootstrap WYSIHTML5 --> 
<script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 
<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
        
</body>
</html>
