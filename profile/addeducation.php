<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__.'/../header.php');
	
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://". getFolderUrl() ."error.php");
	}
	else{
		if(isset($_GET["edu"]) && isset($_GET["action"]) && isset($_GET["id"])) {
			if($_GET["edu"] == "formal" || $_GET["edu"] == "informal"){
				if(($_GET["edu"] == "formal" || $_GET["edu"] == "informal") && is_numeric($_GET["id"])){
					
					$id = $_GET["id"];
					$db->where("id", $id);
					if($_GET["edu"] == "formal"){
						if($db->getOne("formal")["user_id"] != $_SESSION["current"]){
							header("location:http://". getFolderUrl() ."error.php");
						}
					}
					else{
						if($db->getOne("informal")["user_id"] != $_SESSION["current"]){
							header("location:http://". getFolderUrl() ."error.php");
						}
					}
					
					
					if($_GET["action"] == "show"){
						if($_GET["edu"] == "formal"){
							$db->where ("id", $_GET["id"]);
							$db->where ("user_id", $_SESSION["current"]);
							$query = $db->getOne ("formal");
							
							if(count($query) > 0){
								$data = [];
								if($query["show"] == "1"){
									$data = Array ('show' => '0');
								}
								else{
									$data = Array ('show' => '1');
								}
								$db->where ('id', $_GET["id"]);
								if ($db->update ('formal', $data)){
									header("location:education.php");
								}
								else{
									header("location:http://". getFolderUrl() ."error.php");
								}
							}
							else{
								header("location:http://". getFolderUrl() ."error.php");
							}
						}
						else{
							$db->where ("id", $_GET["id"]);
							$db->where ("user_id", $_SESSION["current"]);
							$query = $db->getOne ("informal");
							if(count($query) > 0){
								$data = [];
								if($query["show"] == "1"){
									$data = Array ('show' => '0');
								}
								else{
									$data = Array ('show' => '1');
								}
								$db->where ('id', $_GET["id"]);
								if ($db->update ('informal', $data)){
									header("location:education.php");
								}
								else{
									header("location:http://". getFolderUrl() ."error.php");
								}
							}
							else{
								header("location:http://". getFolderUrl() ."error.php");
							}
						}
					}
					else if($_GET["action"] == "edit"){
						require_once("profile/addeducation.php");
					}
					else if($_GET["action"] == "delete"){
						if($_GET["edu"] == "formal"){
							$db->where('id', $_GET["id"]);
							if($db->delete('formal')){
								header("location:education.php");
							}
							else{
								header("location:http://". getFolderUrl() ."error.php");
							}
						}
						if($_GET["edu"] == "informal"){
							$db->where('id', $_GET["id"]);
							if($db->delete('informal')){
								header("location:education.php");
							}
							else{
								header("location:http://". getFolderUrl() ."error.php");
							}
						}
						
					}
					else{
						header("location:http://". getFolderUrl() ."error.php");
					}
				}
				else{
						header("location:http://". getFolderUrl() ."error.php");
				}
			}
			else{
				header("location:http://". getFolderUrl() ."error.php");
			}
		}
		else if(isset($_GET["add"])){
			if($_GET["add"] == "formal" || $_GET["add"] == "informal"){
				require_once("profile/addeducation.php");
			}
			else{
				header("location:http://". getFolderUrl() ."error.php");
			}
		}
		else{
			header("location:http://". getFolderUrl() ."error.php");
		}
	}
	
	require_once( __DIR__.'/../footer.php');
?>