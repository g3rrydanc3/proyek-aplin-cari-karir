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
	
	//init mysql
	$db = new MysqliDb (DB_SERVER, DB_USER, DB_PASSWORD, DB_DBNAME);
	$db->ping();
	//init session
	session_start();
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	if(!isset($_SESSION["role"])){
		$_SESSION["role"] = "";
	}
	
	$javascript="";
	$errors=[];
	
	//passing get for profile
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
	
	//for some html tag that needs "active" class
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);
		$url1 = explode('?', $url);
		$url2 = $url1[0];
		if($currect_page == $url2){
			echo 'active';
		}
	}
	
	//get website root directory
	function getFolderUrl(){
		$url = $_SERVER['REQUEST_URI'];
		$dir = $_SERVER['SERVER_NAME'] . "/" . CONFIG_FOLDER;
		return $dir;
	}
	
	//get website option (refer to table "option")
	function getOption($opt){
		$GLOBALS["db"]->where("name", $opt);
		return $GLOBALS["db"]->getOne("option")["value"];
	}
	
	function validateDate($date, $format = 'd-m-Y'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	function getNotificationCount(){
		$ctr = 0;
		if(strlen($_SESSION["current"]) != 0 && is_numeric($_SESSION["role"])){
			$count = $GLOBALS["db"]->rawQueryOne("select COUNT(*) from message where message.user_id_to = '" . $_SESSION["current"] . "' and message.read = '0'")["COUNT(*)"];
			$ctr += $count;
		}
		return $ctr;
	}
?>