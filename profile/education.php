<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__.'/../header.php');
	
	if(strlen($_SESSION["current"]) == 0){
		if(!isset($GET["id"])){
			header("location:http://". getFolderUrl() ."error.php");
		}
		else{
			require_once("profile/education.php");
		}
	}
	else{
		if(!isset($_GET["id"])){
			require_once("profile/myeducation.php");
		}
		else{
			require_once("profile/education.php");
		}
	}
	
	require_once( __DIR__.'/../footer.php');
?>