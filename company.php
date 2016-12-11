<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once('header.php');
	
	if(!strlen($_SESSION["current"]) == 0 && !is_numeric($_SESSION["role"])){	//company login
		require_once('header.php');
		if(!isset($_GET["id"])){
			header("location:http://". getFolderUrl() ."company/profile.php");
		}
		else{
			require_once("company_view.php");
		}
		require_once('footer.php');
	}
	else{	//student or guest
		if(!isset($_GET["id"])){
			header("location:http://". getFolderUrl() ."error.php");
		}
		else{
			require_once("company_view.php");
		}
	}
	require_once('footer.php');
?>