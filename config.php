<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	///////////////////CONFIG///////////////////
	DEFINE('DB_SERVER', 'localhost');
	DEFINE('DB_USER', 'root');
	DEFINE('DB_PASSWORD', '');
	DEFINE('DB_DBNAME', 'job_comer');
	
	DEFINE('CONFIG_FOLDER', 'proyek-aplin-job-comer/');
	
	date_default_timezone_set('Asia/Jakarta');
	///////////////////END OF CONFIG///////////////////
	
	require_once("pages/MysqliDb.php");
	
	$db = new MysqliDb (DB_SERVER, DB_USER, DB_PASSWORD, DB_DBNAME);
	$db->ping();
	
	session_start();
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	if(!isset($_SESSION["role"])){
		$_SESSION["role"] = "";
	}
	
	$javascript="";
	$errors=[];
	
	function passingGet(){
		if(isset($_GET)){
			$numItems = count($_GET);
			$i = 0;
			$str = "?";
			foreach($_GET as $key => $value){
				$str.= $key . "=" . $value;
				if ($i < $numItems - 1) {
					$str.= "&";
				}
				$i++;
			}
			if(strlen($str) == 1){
				return;
			}
			else{
				return $str;
			}
		}
	}
	
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);
		$url1 = explode('?', $url);
		$url2 = $url1[0];
		if($currect_page == $url2){
			echo 'active';
		}
	}
	
	function getFolderUrl(){
		$url = $_SERVER['REQUEST_URI'];
		$dir = $_SERVER['SERVER_NAME'] . "/" . CONFIG_FOLDER;
		return $dir;
	}
	
	function getOption(){
		$opt = Array(
			"website_name" => "",
			"email" => "",
			"activation" => "",
			"resend_activation_threshold" => "",
			"languange" => ""
		);
		$option = $GLOBALS["db"]->get("option");
		foreach($option as $data){
			if($data["name"] == "website_name"){
				$opt["website_name"] = $data["value"];
			}
			else if($data["name"] == "email"){
				$opt["email"] = $data["value"];
			}
			else if($data["name"] == "activation"){
				$opt["activation"] = $data["value"];
			}
			else if($data["name"] == "resend_activation_threshold"){
				$opt["resend_activation_threshold"] = $data["value"];
			}
			else if($data["name"] == "languange"){
				$opt["languange"] = $data["value"];
			}
		}
		return $opt;
	}
?>