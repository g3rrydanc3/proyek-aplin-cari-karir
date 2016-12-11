<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__ . '/../header.php');
	
	if(!strlen($_SESSION["current"]) == 0 && !is_numeric($_SESSION["role"])){
		if(!isset($_GET["id"])){
			require_once("profile/setting.php");
		}
		else{
			header("location:http://". getFolderUrl() ."error.php");
		}
	}
	else{
		header("location:http://". getFolderUrl() ."error.php");
	}
	
	require_once( __DIR__ . '/../footer.php');
?>