<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(strlen($_SESSION["current"]) == 0){
		header("location:error.php");
	}
	else{
		if(isset($_GET["edu"]) && isset($_GET["action"]) && isset($_GET["id"])) {
			if($_GET["edu"] == "formal" || $_GET["edu"] == "informal"){
				if(($_GET["edu"] == "formal" || $_GET["edu"] == "informal") && is_numeric($_GET["id"])){
					
					$id = $_GET["id"];
					$db->where ("id", $_SESSION["current"]);
					$user = $db->getOne ("user");
					
					
					
					if($_GET["action"] == "show"){
						if($_GET["edu"] == "formal"){
							$db->where ("id", $_GET["id"]);
							$db->where ("user_id", $_SESSION["current"]);
							$query = $db->getOne ("formal");
							
							$db->setTrace (true);
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
									header("location:error.php");
								}
							}
							else{
								header("location:error.php");
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
									header("location:error.php");
								}
							}
							else{
								header("location:error.php");
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
								header("location:error.php");
							}
						}
						if($_GET["edu"] == "informal"){
							$db->where('id', $_GET["id"]);
							if($db->delete('informal')){
								header("location:education.php");
							}
							else{
								header("location:error.php");
							}
						}
						
					}
					else{
						header("location:error.php");
					}
				}
				else{
						header("location:error.php");
				}
			}
			else{
				header("location:error.php");
			}
		}
		else if(isset($_GET["add"])){
			if($_GET["add"] == "formal" || $_GET["add"] == "informal"){
				require_once("profile/addeducation.php");
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