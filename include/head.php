<?php
$counterID=$customerchechlogin_row['type_role'];
          $SQLhrdata = "select * from counter where primary_role='$counterID'";
          $ResultHrdata = mysqli_query( $link, $SQLhrdata );
          $listHrdata = mysqli_fetch_array( $ResultHrdata );
          $primiaryRole = $listHrdata[ 'primary_role' ];
		  $page_name = basename($_SERVER['PHP_SELF']);
          ?>
<meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="description" content="SPlendid CRM">
		<meta name="keywords" content="SPlendid CRM">
        <meta name="author" content="SPlendid CRM">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard - SPlendid CRM</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="fevicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets\css\bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets\css\font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets\css\line-awesome.min.css">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets\css\select2.min.css">
			
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets\css\bootstrap-datetimepicker.min.css">
		
		<!-- Tagsinput CSS -->
		<link rel="stylesheet" href="assets\plugins\bootstrap-tagsinput\bootstrap-tagsinput.css">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="assets\plugins\morris\morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets\css\style.css">
		<link rel="stylesheet" href="assets\css\richtext.min.css">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

