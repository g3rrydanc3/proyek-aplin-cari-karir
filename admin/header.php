<?php
	define('Access', TRUE);
	require_once( __DIR__ . '/../config.php');
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	
	if($_SESSION["current"] != 1){
		header("location:../index.php");
		die("Bukan admin");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin <?php echo getOption("website_name");?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/landing-page.css" rel="stylesheet">
	<link href="../css/sweetalert.css" rel="stylesheet">
	<link href="../css/fileinput.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	
	<!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/sweetalert.min.js"></script>
	<script src="../js/fileinput.min.js"></script>
    <script src="../js/script.js"></script>
	<style>
	/* Set height of the grid so .sidenav can be 100% (adjust if needed) */
	.row.content {height: 1500px}

	/* Set gray background color and 100% height */
	.sidenav {
		background-color: #f1f1f1;
		height: 100%;
	}

	/* Set black background color, white text and some padding */
	footer {
		background-color: #555;
		color: white;
		padding: 15px;
	}

	/* On small screens, set height to 'auto' for sidenav and grid */
	@media screen and (max-width: 767px) {
		.sidenav {
			height: auto;
			padding: 15px;
		}
		.row.content {height: auto;} 
	}
	</style>
</head>
<body>

<div class="container-fluid">
	<div class="row content">
	<div class="col-sm-3 sidenav">
		<h2>Admin <?php echo getOption("website_name");?></h2>
		<ul class="nav nav-pills nav-stacked">
			<li><a href="../index.php">Kembali ke website</a></li>
			<li><a href="setting.php">Setting</a></li>
			<li><a href="data.php">Data Student</a></li>
			<li><a href="data_company.php">Data Company</a></li>
			<li><a href="report.php">Report Palsu</a></li>
		</ul>
	</div>