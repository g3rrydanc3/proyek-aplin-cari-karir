<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	require_once("db.php");
	session_start();
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	if(!isset($_SESSION["role"])){
		$_SESSION["role"] = "";
	}
	
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);  
		if($currect_page == $url){
			echo 'active';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Job Comer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/landing-page.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

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
			<a class="navbar-brand" href="index.php">Job Comer</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?php active('about.php');?>"><a href="#about">About</a></li>
				<li class="<?php active('asdf.php');?>"><a href="#contact">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if(strlen($_SESSION["current"]) != 0){
						echo '<li class=';
						active("profile.php");
						echo '><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>';
						
						echo '<li class=';
						active("notification.php");
						echo '><a href="notification.php"><span class="glyphicon glyphicon-certificate"></span> Notification</a></li>';
						
						echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
					}
					else{
						echo '<li class=';
						active("register.php");
						echo '><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
						
						echo '<li class=';
						active("login.php");
						echo '><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
					}
				?>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>

