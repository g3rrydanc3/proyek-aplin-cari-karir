<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(strlen($_SESSION["current"]) == 0){
		header("location:error.php");
	}
	else{
		if(isset($_GET["add"])){
			if($_GET["add"] == "formal" || $_GET["add"] == "informal"){
				require_once("profile/addexperience.php");
			}
			else{
				header("location:error.php");
			}
		}
		else{
			header("location:error.php");
		}
	}
	
	require_once("pages/footer.php");
?>