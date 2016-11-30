<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	
	if(strlen($_SESSION["current"]) == 0){
		require_once("pages/index_not_login.php");
	}
	else{
		require_once("pages/index_login.php");
	}
	
	require_once("footer.php");
?>