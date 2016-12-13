<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"]) || !isset($_GET["id"])){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	$db->where("id", $_GET["id"]);
	$message = $db->getOne("message");
	if(!empty($message)){
		if($_GET["sent"] == "yes"){
			if($message["user_id_from"] != $_SESSION["current"]){
				header("location:http://" . getFolderUrl() . "error.php");
			}
		}
		else{
			if($message["user_id_to"] != $_SESSION["current"] || $message["deleted"] == "1"){
				header("location:http://" . getFolderUrl() . "error.php");
			}
		}
	}else{
		header("location:http://" . getFolderUrl() . "error.php");
	}
	$db->where("id", $message["user_id_from"]);
	$username = $db->getOne("user")["username"];
	
	if($message["user_id_to"] == $_SESSION["current"] && $message["read"] == "0"){
		$data = Array("read" => "1");
		$db->where("id", $message["id"]);
		$db->update("message", $data);
	}
	
	
?>
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("profile/mysidebar.php");?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="profile-content">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Message</h2>
						</div>
						<div class="panel-body">
							<p class="text-muted">From : <?php echo "<a href='http://". getFolderUrl()."profile/profile.php?id=". $message["user_id_from"] ."'>" . $username . "</a>";?></p>
							<div class="well"><?php echo $message["message"];?></div>
							<?php if($_GET["sent"] != "yes"){
								echo '<div class="row">
									<div class="col-sm-6">
										<a href="message_write.php?id=' . $message["user_id_from"] . '"><button class="btn btn-primary btn-block">Reply</button></a>
									</div>
									<div class="col-sm-6">
										<a href="message.php?action=del&id=' . $_GET["id"] . '"><button class="btn btn-danger btn-block">Delete</button></a>
									</div>
								</div>';
							}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once(__DIR__ . "/../footer.php");
?>