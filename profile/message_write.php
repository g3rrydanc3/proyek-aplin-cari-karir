<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	require_once(__DIR__ . "/../pages/htmLawed.php");
	require_once(__DIR__ . "/../pages/php-mailer/PHPMailerAutoload.php");
	require_once(__DIR__ . "/../pages/email.php");
	
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	if($_SESSION["current"] == $_GET["id"]){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	if(isset($_GET["id"])){
		$db->where("id", $_GET["id"]);
		$to = $db->getOne("user")["username"];
	}
	else{
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	if(isset($_GET["msg"])){
		$processed = htmLawed($_GET["msg"]);
		$data = Array(
			"user_id_to" => $_GET["id"],
			"user_id_from" => $_SESSION["current"],
			"subject" => trim($_GET["subject"]),
			"message" => trim($_GET["msg"]),
			"sent_stamp" => date("Y-m-d H:i:s")
		);
		if($db->insert("message", $data)){
			$javascript .= "
				<script>
				swal({
						title: 'Success!',
						text: 'Message sent successfully!',
						type: 'success',
						closeOnConfirm: false
					},
					function(){
						window.location.href = 'message_sent.php';
					});
				</script>
			";
			$db->where("id", $_GET["id"]);
			emailNewMessage($db->getOne("user"));
		}
		else{
			$javascript .= "
				<script>
				swal({
						title: 'Error!',
						text: 'Message send failed!" . $db->getLastError() . "',
						type: 'warning',
						closeOnConfirm: false
					},
					function(){
						window.location.href = 'message_sent.php';
					});
				</script>
			";
		}
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
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label class="control-label" for="to">To :</label>
									</div>
									<div class="col-sm-10">
										<input type="text" id="to" class="form-control" value="<?php echo $to;?>" disabled>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-2">
										<label class="control-label" for="subject">Subject :</label>
									</div>
									<div class="col-sm-10">
										<input type="text" id="subject" name="subject" class="form-control" required>
									</div>
								</div>
							</div>
							<p><div id="summernote"></div></p>
							<button class="btn btn-primary" id="send">Send</button>
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
<script>
$(document).ready(function() {
	$('#summernote').summernote({
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		]
	});
	$("#send").click(function(){
		if ($('#summernote').summernote('isEmpty')) {
			swal("Error!", "Message is empty!", "warning")
		}
		else{
			window.location = "message_write.php?msg=" + $('#summernote').summernote('code') + "&id=<?php echo $_GET["id"];?>" + "&subject=" + $("#subject").val();
		}
	});
});
</script>