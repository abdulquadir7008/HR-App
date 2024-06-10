<?php include('includes/configset.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
var timer = 0;
function set_interval() {
timer = setInterval("auto_logout()", 600000);
// set to 10 minutes
}

function reset_interval() {
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer

if (timer != 0) {
clearInterval(timer);
timer = 0;
// second step: implement the timer again
timer = setInterval("auto_logout()", 60000);
// completed the reset of the timer
} 
}

function auto_logout() {
 // this function will redirect the user to the logout script
 window.location = "logout2.php";
}
</script>
    </head>
    <body class="skin-blue" onLoad="set_interval();" onmousemove="reset_interval();" onclick="reset_interval();" onkeypress="reset_interval();" onscroll="reset_interval();">
        <!-- header logo: style can be found in header.less -->
                <?php include('includes/head.php'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('includes/sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php vendor($link);  ?>
                                    </h3>
                                    <p>
                                        Vendor List
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php member($link);?><sup style="font-size: 20px"></sup>
                                    </h3>
                                    <p>
                                        Member List
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php Promo($link); ?>
                                    </h3>
                                    <p>
                                        Request Promo Code List
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="request_promo.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php sponsor($link) ?>
                                    </h3>
                                    <p>
                                        Sponser Listing
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="manage_sponserlisting.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">


                          
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Chat</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle" >
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                        <div class="attachment">
                                            <h4>Attachments:</h4>
                                            <p class="filename">
                                                Theme-thumbnail-image.jpg
                                            </p>
                                            <div class="pull-right">
                                                <button class="btn btn-primary btn-sm btn-flat">Open</button>
                                            </div>
                                        </div><!-- /.attachment -->
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                                Jane Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Susan Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div><!-- /.item -->
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box (chat box) -->

                          
                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">

                            <!-- Map box -->
                            <div class="box box-solid bg-light-blue-gradient">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Visitors
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div id="world-map" style="height: 250px;"></div>
                                </div><!-- /.box-body-->
                                <div class="box-footer no-border">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <div id="sparkline-1"></div>
                                            <div class="knob-label">Visitors</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                           <div id="sparkline-2"></div>
                                            <div class="knob-label">Online</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center">
                                            <div id="sparkline-3"></div>
                                            <div class="knob-label">Exists</div>
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div>
                            </div>
                            <!-- /.box -->

                            <!-- solid sales graph -->
                            <!-- /.box -->

                            <!-- Calendar -->
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Calendar</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div><!-- /.box-body -->
                                <div class="box-footer text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Progress bars -->
                                            <div class="clearfix">
                                                <span class="pull-left">Task #1</span>
                                                <small class="pull-right">90%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                            </div>

                                            <div class="clearfix">
                                                <span class="pull-left">Task #2</span>
                                                <small class="pull-right">70%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="clearfix">
                                                <span class="pull-left">Task #3</span>
                                                <small class="pull-right">60%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                            </div>

                                            <div class="clearfix">
                                                <span class="pull-left">Task #4</span>
                                                <small class="pull-right">40%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
