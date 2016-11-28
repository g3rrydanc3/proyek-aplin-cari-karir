<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	$db_server = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_dbname = "job_comer";
	
	function getFolderWebsite(){
		$config_folder = "proyek-aplin-job-comer";
		return $config_folder;
	}
	
	date_default_timezone_set('Asia/Jakarta');
?>