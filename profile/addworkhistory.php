<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__.'/../header.php');
	
	if(strlen($_SESSION["current"]) == 0){
		header("location:http://". getFolderUrl() ."error.php");
	}
	else{
		if(isset($_GET["action"]) && isset($_GET["id"])) {
			if(is_numeric($_GET["id"])){
					
				$id = $_GET["id"];
				$db->where("id", $id);
				if($db->getOne("pengalaman_kerja")["user_id"] != $_SESSION["current"]){
					header("location:http://". getFolderUrl() ."error.php");
				}
				
				if($_GET["action"] == "show"){
					$db->setTrace (true);
					$db->where ("id", $_GET["id"]);
					$db->where ("user_id", $_SESSION["current"]);
					$query = $db->getOne ("pengalaman_kerja");

					if(count($query) > 0){
						$data = [];
						if($query["show"] == "1"){
							$data = Array ('show' => '0');
						}
						else{
							$data = Array ('show' => '1');
						}
						$db->where ('id', $_GET["id"]);
						if ($db->update ('pengalaman_kerja', $data)){
							header("location:workhistory.php");
						}
						else{
							header("location:http://". getFolderUrl() ."error.php");
						}
					}
					else{
						header("location:http://". getFolderUrl() ."error.php");
					}
				}
				else if($_GET["action"] == "edit"){
					require_once("profile/addworkhistory.php");
				}
				else if($_GET["action"] == "delete"){
					$db->where('id', $_GET["id"]);
					if($db->delete('pengalaman_kerja')){
						header("location:workhistory.php");
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
		else if($_GET["action"] == "add"){
			require_once("profile/addworkhistory.php");
		}
		else{
			header("location:http://". getFolderUrl() ."error.php");
		}
	}
	
	require_once( __DIR__.'/../footer.php');
?>