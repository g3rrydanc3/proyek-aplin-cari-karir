<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	require_once("config.php");
	require_once("MysqliDb.php");
	$db = new MysqliDb ($db_server, $db_username, $db_password, $db_dbname);
	$db->ping();
	
	session_start();
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	if(!isset($_SESSION["role"])){
		$_SESSION["role"] = "";
	}
	
	$javascript="";
	
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);
		$url1 = explode('?', $url);
		$url2 = $url1[0];
		if($currect_page == $url2){
			echo 'active';
		}
	}
	
	function getFolderUrl(){
		$url = $_SERVER['REQUEST_URI'];
		$dir = $_SERVER['SERVER_NAME'] . "/" . getFolderWebsite() . "/";
		return $dir;
	}
	
	function passingGet(){
		if(isset($_GET)){
			$numItems = count($_GET);
			$i = 0;
			$str = "?";
			foreach($_GET as $key => $value){
				$str.= $key . "=" . $value;
				if ($i < $numItems - 1) {
					$str.= "&";
				}
				$i++;
			}
			return $str;
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
    <link href="http://<?php echo getFolderUrl();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/landing-page.css" rel="stylesheet">
    <link href="http://<?php echo getFolderUrl();?>css/sweetalert.css" rel="stylesheet">
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
			<a class="navbar-brand" href="http://<?php echo getFolderUrl();?>index.php">Job Comer</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?php active('about.php');?>"><a href="http://<?php echo getFolderUrl();?>about.php">About</a></li>
				<li class="<?php active('contact.php');?>"><a href="http://<?php echo getFolderUrl();?>contact.php">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><form class="navbar-form" role="search" method="get" action="search.php">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="q">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form></li>
				<?php
					if(strlen($_SESSION["current"]) != 0){
						echo '<li class=';
						active("profile.php");
						active("education.php");
						active("experience.php");
						active("setting.php");
						echo '><a href="http://' . getFolderUrl() . 'profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>';
						
						echo '<li class=';
						active("notification.php");
						echo '><a href="http://' . getFolderUrl() . 'notification.php"><span class="badge">0</span> Notification</a></li>';
						
						echo '<li><a href="http://' . getFolderUrl() . 'logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
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
		</div><!--/.nav-collapse -->
	</div>
</nav>

