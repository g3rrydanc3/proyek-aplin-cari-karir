<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	if(isset($_GET["action"])){
		if($_GET["action"] == "del"){
			$id = $_GET["id"];
			$db->where("id", $id);
			$messageDel = $db->getOne("message");
			if($messageDel["user_id_to"] == $_SESSION["current"]){
				$db->where("id", $id);
				$data = Array("deleted" => "1");
				if($db->update("message", $data)){
					$javascript .= "<script>
						swal({
							title: 'Success!',
							text: 'Message deleted successfully!',
							type: 'success',
							closeOnConfirm: false
						}, function(){
							window.location = 'message.php';
						});
					</script>";
				}
				else{
					$javascript .= "<script>
						swal({
							title: 'Failed!',
							text: 'Message delete failed!" . $db->getLastError() ."',
							type: 'warning',
							closeOnConfirm: false
						}, function(){
							window.location = window.location;
						});
					</script>";
				}
			}
			else{
				header("location:http://" . getFolderUrl() . "error.php");
			}
		}
		else{
			header("location:http://" . getFolderUrl() . "error.php");
		}
	}
	
	$db->where("user_id_to", $_SESSION["current"]);
	$db->orderBy ("sent_stamp","desc");
	$message = $db->get("message");
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
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>From</th>
											<th>Date</th>
											<th>Subject</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$ctr = 0;
											foreach($message as $key => $data){
												if($data["deleted"] == "0"){
													$db->where("id", $data['user_id_from']);
													$username = $db->getOne("user")["username"];
													if($data["read"] == "1"){
														echo "<tr>";
													}
													else{
														echo "<tr style='font-weight:bold;' class='danger'>";
													}
													
													echo "<td><a href='message_view.php?sent=no&id=" . $data['id'] . "'>". $username ."</a></td>";
													echo "<td><a href='message_view.php?sent=no&id=" . $data['id'] . "'>". $data['sent_stamp'] ."</a></td>";
													echo "<td><a href='message_view.php?sent=no&id=" . $data['id'] . "'>". $data['subject'] ."</a></td>";
													echo "<td><a href='message.php?action=del&&id=" . $data['id'] . "'>Delete</a></td>";
													echo "</tr>";
													$ctr++;
												}
											}
											if($ctr == 0){
												echo "<tr><td colspan=4 class='text-muted text-center'>Stil empty.</td></tr>";
											}
										?>
									</tbody>
								</table>
							</div>
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