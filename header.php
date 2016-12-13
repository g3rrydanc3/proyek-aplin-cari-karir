<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	require_once(__DIR__."/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo getOption("website_name");?></title>

    <!-- Bootstrap Core CSS -->
    <link href="http://<?php echo getFolderUrl();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/landing-page.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/sweetalert.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/fileinput.min.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/daterangepicker.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/summernote.css" rel="stylesheet">
	<link href="http://<?php echo getFolderUrl();?>css/style.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://<?php echo getFolderUrl();?>index.php"><?php echo getOption("website_name");?></a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?php active('about.php');?>"><a href="http://<?php echo getFolderUrl();?>about.php">About</a></li>
				<li class="<?php active('contact.php');?>"><a href="http://<?php echo getFolderUrl();?>contact.php">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" role="search" method="get" action="http://<?php echo getFolderUrl();?>search.php">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search" value="<?php if(isset($_GET["search"]))echo $_GET["search"];?>">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
				<li>
					<?php
						if(strlen($_SESSION["current"]) != 0){
							echo '<li class=';
							active("notification.php");
							echo '><a href="http://' . getFolderUrl() . 'notification.php"><span class="badge">'. getNotificationCount() .'</span> Notification</a></li>';
						}
					?>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php
							if(strlen($_SESSION["current"]) != 0){
								//profile
								echo '<li class=';
								if(strlen(passingGet()) == 0){
									active("profile.php");
									active("education.php");
									active("experience.php");
									active("setting.php");
								}
								if(!is_numeric($_SESSION["role"])){
									echo '><a href="http://' . getFolderUrl() . 'company/profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>';
									//manage job
									echo '<li class=><a href="http://' . getFolderUrl() . 'job/index.php"><span class="glyphicon glyphicon-briefcase"></span> Manage Job</a></li>';
								}
								else{
									echo '><a href="http://' . getFolderUrl() . 'profile/profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>';
								}
								//logout
								echo '<li><a href="http://' . getFolderUrl() . 'logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
								if($_SESSION["current"] == 1){
									//admin
									echo '<li><a href="http://' . getFolderUrl() . 'admin/index.php"><span class=" 	glyphicon glyphicon-lock"></span> Admin</a></li>';
								}
							}
							else{
								echo '<li class=';
								active("register.php");
								echo '><a href="http://' . getFolderUrl() . 'register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
								
								echo '<li class=';
								active("login.php");
								echo '><a href="http://' . getFolderUrl() . 'login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
							}
						?>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>

