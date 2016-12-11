<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	
	if(!strlen($_SESSION["current"]) == 0 && !is_numeric($_SESSION["role"])){	//company
		if(isset($_GET["id"])){
			require_once("_index.php");
		}
		else{
			require_once("_myindex.php");
		}
	}
	else{
		if(isset($_GET["id"])){	//guest, student
			require_once("_index.php");
		}
		else{
			header("location:http://". getFolderUrl() ."error.php");
		}
	}
	
	require_once(__DIR__ . "/../footer.php");
?>