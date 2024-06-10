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
$sql_cms="select * from toolbox_login WHERE page_id=$page_id"; 
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
      <h1> Manage CMS <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify Page- ".$row_cms['title'];
			  }
			  else
			  {
				echo "Add Page";  
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
			  echo "Modify Page- ".$row_cms['title'];
			  }
			  else
			  {
				echo "Add Page";  
			  }
			 
 ?>  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="box box-primary">
                
                <!-- /.box-header --> 
                <!-- form start -->
                
<form action="cms_manage.php" method="post" enctype="multipart/form-data" name="cont"  id="myform" onSubmit="return validate();">
                  
                  <div class="box-body">
                  <div class="form-group">
                                            <label>Select Child Page</label>
                                            <select name="category" class="form-control">
    <?php
	page_parent_f();
	?>
    </select>
                                            
                                        </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="page_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['page_name']; ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Links</label>
                      <input type="text" name="seo_keyword" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['seo_keyword']; ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sort order</label>
                      <input type="text" name="sortorder" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['sortorder']; ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['meta_title']; ?>">
                    </div>
                    
                    <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <textarea class="form-control" name="meta_keywords" rows="3" placeholder="Enter ..."><?php echo $row_cms['meta_keywords']; ?></textarea>
                                        </div>
                  
                  <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter ..."><?php echo $row_cms['meta_description']; ?></textarea>
                                        </div>
                              <div class="form-group">
                      <input type="file" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="image" value="<?php echo $row_cms['image']; ?>" />
                      <?php if($row_cms['image']!='') { image_size(); ?>
                      <img src="../uploads/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                      <?php } ?>
                    </div>
                              <div class="form-group">
                              <label>Position for Link</label>
                              
                              <?php if($row_cms['topbar']) { ?>
                              <div class="checkbox">
        <input type="checkbox"  value="on" checked="checked" class="katret"  name="topbar"  />
        <label for="topbar">Topbar </label>
        </div>
        <?php } else { ?>
        <div class="checkbox">
        <input type="checkbox"   name="topbar" value="on" class="katret"  />
        <label for="topbar">Topbar </label>
        </div>
        <?php } ?>
        
        <?php if($row_cms['footer']) { ?>
        <div class="checkbox">
        <input type="checkbox"  value="on" checked="checked" class="katret"  name="footer"  />
        <label for="footer">Footer </label>
        </div>
        <?php } else { ?>
        <div class="checkbox">
        <input type="checkbox"   name="footer" value="on" class="katret"  />
        <label for="footer">Footer </label>
        </div>
		<?php } ?>
        
        <?php if($row_cms['sidebar']) { ?>
        <div class="checkbox">
        <input type="checkbox" name="sidebar" class="katret" checked="checked" value="on"  />
        <label for="sidebar">Sidebar </label>
        </div>
		<?php } else { ?>
        <div class="checkbox">
        <input type="checkbox" name="sidebar" class="katret"  value="on"  />
        <label for="sidebar">Sidebar </label>
        </div>
		<?php } ?>
                                            
                                        </div>
                                        
                                        
                    <div class='box-body pad'>
                                    
                                        <textarea id="editor1" name="content" rows="10"  cols="80">
                                            <?php echo $row_cms['content']; ?>
                                        </textarea>
                                    
                                </div>
                    
                    
                  </div>
                  <!-- /.box-body -->
                  
                  <div class="box-footer">
                  
                  <input type='hidden' name='page_id' id='page_id' maxlength="50"   size="30" value="<?php echo $row_cms['page_id']; ?>"/>
                  
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
