<?php include('includes/configset.php');
$sql_cms="select * from inboxdata where star='1' order by id DESC"; 
 $result_cms=mysqli_query($link,$sql_cms); 
 $sql_star="select * from inboxdata where star='1'"; 
 $result_star=mysqli_query($link,$sql_star); 
 $sql_junk="select * from inboxdata where status='5' AND status2='1'"; 
 $result_junk=mysqli_query($link,$sql_junk); 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Mailbox</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script>

// grab your file object from a file input
$('#fileInput').change(function () {
  sendFile(this.files[0]);
});

// can also be from a drag-from-desktop drop
$('dropZone')[0].ondrop = function (e) {
  e.preventDefault();
  sendFile(e.dataTransfer.files[0]);
};

function sendFile(file) {
  $.ajax({
    type: 'post',
    url: '/targeturl?name=' + file.name,
    data: file,
    success: function () {
      // do something
    },
    xhrFields: {
      // add listener to XMLHTTPRequest object directly for progress (jquery doesn't have this yet)
      onprogress: function (progress) {
        // calculate upload progress
        var percentage = Math.floor((progress.total / progress.totalSize) * 100);
        // log upload progress to console
        console.log('progress', percentage);
        if (percentage === 100) {
          console.log('DONE!');
        }
      }
    },
    processData: false,
    contentType: file.type
  });
}
</script>
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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1 class="text-center">
                         Mailbox <a href="mailbox2.php">(Refresh)</a>
                    </h1>
                </section>
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin-bottom: 0!important;' class='alert alert-info'><i class='fa fa-info'></i><b>Note:</b>" .$msg."</div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
                <!-- Main content -->
                <section class="content">
                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
                                            <!-- Navigation - folders-->
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                    <li><a href="mailbox.php"><i class="fa fa-inbox"></i> Inbox (<?php echo mysqli_num_rows($result_cms45);?>)</a></li>
                                                    <li><a href="draft.php"><i class="fa fa-pencil-square-o"></i> Drafts</a></li>
                                                    <li><a href="sent.php"><i class="fa fa-mail-forward"></i> Sent</a></li>
                                                    <li class="active"><a href="started.php"><i class="fa fa-star"></i> Starred (<?php echo mysqli_num_rows($result_star);?>)</a></li>
                                                    <li><a href="junk.php"><i class="fa fa-folder"></i> Junk (<?php echo mysqli_num_rows($result_junk);?>)</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all"/>
                                                    </label>
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Mark as read</a></li>
                                                            <li><a href="#">Mark as unread</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Move to junk</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <form action="#" class="text-right">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <table class="table table-mailbox">
<?php 
while($row_cms=mysqli_fetch_array($result_cms)) { 

?> 

<tr class="<?php if($row_cms['status']=='1'){echo "unread";} else{echo "read";};?>">
<td class="small-col"><input type="checkbox" />



</td>
<td class="small-col">
<?php if($row_cms['star']=='0'){?>
<a href="script/del.php?del=<?php echo $row_cms['id'];?>" class="starcolor"><i class="fa fa-star-o"></i></a>
<?php } ?>
<?php if($row_cms['star']=='1'){?>
<a href="script/del.php?del2=<?php echo $row_cms['id'];?>" class="starcolor"><i class="fa fa-star"></i></a>
<?php } ?>
</td>
<td class="name"><a href="mailbox_details.php?id=<?php echo $row_cms['id'];?>&&<?php echo $row_cms['session'];?>"><?php echo $row_cms['fromer']; ?></a></td>
<td class="subject"><a href="mailbox_details.php?id=<?php echo $row_cms['id'];?>&&<?php echo $row_cms['session'];?>"><?php echo $row_cms['subject']; ?></a></td>
<td class="time"><?php echo $row_cms['date']; ?></td>
</tr>
                                                  <?php
												  }
												  ?>
                                                 
                                                </table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="pull-right">
                                        <small>Showing 1-12/1,240</small>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>
                                    </div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
           
            <div class="modal-dialog">
            
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                    </div>
                    <form name="sendmil" method="post" enctype="multipart/form-data" onSubmit="return validate();" action="sendmail.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group jrd">
                                    <span class="input-group-addon">TO:</span>
                                    <input type="email" name="email" class="form-control" placeholder="Email TO">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group jrd">
                                    <span class="input-group-addon">Subject</span>
                                    <input name="subject" type="text" class="form-control" placeholder="Email Subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                  <input type="file" name="image" id="image">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="submit" class="btn btn-danger" name="discharge" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" name="send" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Page script -->
       
        <script type="text/javascript">
            $(function() {

                "use strict";

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });

                //When unchecking the checkbox
                $("#check-all").on('ifUnchecked', function(event) {
                    //Uncheck all checkboxes
                    $("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
                });
                //When checking the checkbox
                $("#check-all").on('ifChecked', function(event) {
                    //Check all checkboxes
                    $("input[type='checkbox']", ".table-mailbox").iCheck("check");
                });
                //Handle starring for glyphicon and font awesome
                $(".glyphicon-star, .glyphicon-star-empty").click(function(e) {
                    e.preventDefault();
                    //detect type
                    var glyph = $(this).hasClass("glyphicon");
                    var fa = $(this).hasClass("fa");

                    //Switch states
                    if (glyph) {
                        $(this).toggleClass("glyphicon-star");
                        $(this).toggleClass("glyphicon-star-empty");
                    }

                    
                });

                //Initialize WYSIHTML5 - text editor
                $("#email_message").wysihtml5();
            });
        </script>

    </body>
</html>
