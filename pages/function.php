<?php
	//menghindari direct access header,footer,db,dll
	require_once("config.php");
	require_once("MysqliDb.php");
	$db = new MysqliDb ($db_server, $db_username, $db_password, $db_dbname);
	$db->ping();
	
	session_start();
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	if(!isset($_SESSION["role"])){
		$_SESSION["role"] = "";
	}
	
	$javascript="";
	
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
		$dir = $_SERVER['SERVER_NAME'] . "/" . getFolderWebsite() . "/";
		return $dir;
	}
	
	
?>