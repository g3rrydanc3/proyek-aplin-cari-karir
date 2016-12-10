<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__.'/../header.php');
	
	if(strlen($_SESSION["current"]) == 0){
		if(!isset($_GET["id"])){
			header("location:http://". getFolderUrl() ."error.php");
		}
		else{
			require_once("profile.php");
		}
	}
	else{
		if(!isset($_GET["id"])){
			require_once("company/myprofile.php");
		}
		else{
			require_once("company/profile.php");
		}
	}
	
	require_once( __DIR__.'/../footer.php');
?>