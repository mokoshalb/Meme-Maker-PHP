<?php
ob_start();
session_start();
include("config.php");
$error_message = '';
$success_message = '';
// Check if the user is logged in or not
if(!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}
// Current Page Access Level check for all pages
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MokoMeme Admin Panel</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">
	<link rel="stylesheet" href="css/dropify.css" type="text/css" media="screen,projection">
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery-2.2.4.min.js"></script>
</head>
<body class="hold-transition fixed skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="index.php" class="logo">
				<span class="logo-mini">Mm</span>
				<span class="logo-lg">MokoMeme</span>
			</a>
			<nav class="navbar navbar-static-top">	
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>
			</nav>
		</header>
  		<?php $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
  		<aside class="main-sidebar">
    		<section class="sidebar">
      			<ul class="sidebar-menu">
			        <li class="treeview <?php if($cur_page == 'index.php') {echo 'active';} ?>">
			          <a href="index.php">
			            <i class="fa fa-laptop"></i> <span>Dashboard</span>
			          </a>
			        </li>
			       <li class="treeview <?php if( ($cur_page == 'image-add.php')||($cur_page == 'image.php') ) {echo 'active';} ?>">
			          <a href="image.php">
			            <i class="fa fa-picture-o"></i> <span>Images</span>
			          </a>
			        </li>
			        <li class="treeview <?php if($cur_page == 'meme.php') {echo 'active';} ?>">
			          <a href="meme.php">
			            <i class="fa fa-meh-o"></i> <span>Memes</span>
			          </a>
			        </li>
			        <li class="treeview <?php if( ($cur_page == 'page-add.php')||($cur_page == 'page.php')||($cur_page == 'page-edit.php') ) {echo 'active';} ?>">
			          <a href="page.php">
			            <i class="fa fa-file-text"></i> <span>Page</span>
			          </a>
			        </li>
			        <li class="treeview <?php if( ($cur_page == 'menu-add.php')||($cur_page == 'menu.php')||($cur_page == 'menu-edit.php') ) {echo 'active';} ?>">
			          <a href="menu.php">
			            <i class="fa fa-bars"></i> <span>Menu</span>
			          </a>
			        </li>
			        <li class="treeview <?php if( ($cur_page == 'ads.php') ) {echo 'active';} ?>">
			          <a href="ads.php">
			            <i class="fa fa-fire"></i> <span>Advertisements</span>
			          </a>
			        </li>
			         <li class="treeview <?php if( ($cur_page == 'settings.php') ) {echo 'active';} ?>">
			          <a href="settings.php">
			            <i class="fa fa-cog"></i> <span>Settings</span>
			          </a>
			        </li>
			        <li class="treeview <?php if($cur_page == 'profile-edit.php') {echo 'active';} ?>">
			          <a href="profile-edit.php">
			            <i class="fa fa-user"></i> <span>Profile</span>
			          </a>
			        </li>
			        <li class="treeview">
			          <a href="logout.php">
			            <i class="fa fa-sign-out"></i> <span>Logout</span>
			          </a>
			        </li>
      			</ul>
    		</section>
  		</aside>
  		<div class="content-wrapper">