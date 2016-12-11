<?php
//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");

$mode = $_POST['mode']; 

if ($mode == "datapolicy"){
	echo "datapolicy";
}

?>