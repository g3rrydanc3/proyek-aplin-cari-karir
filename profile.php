<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(strlen($_SESSION["current"]) == 0){
		if(!isset($GET["id"])){
			header("location:error.php");
		}
		else{
			require_once("pages/profile.php");
		}
	}
	else{
		if(!isset($_GET["id"])){
			require_once("pages/myprofile.php");
		}
		else{
			require_once("pages/profile.php");
		}
	}
	
	require_once("pages/footer.php");
?>