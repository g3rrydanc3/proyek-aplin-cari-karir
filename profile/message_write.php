<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	require_once(__DIR__ . "/../pages/htmLawed.php");
	//if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"]) || !isset($_GET["id"])){
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://" . getFolderUrl() . "error.php");
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	if(isset($_GET["msg"])){
		$processed = htmLawed($_GET["msg"]);
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
							<div id="summernote"></div>
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
			window.location = "message_write.php?msg=" + $('#summernote').summernote('code');
		}
	});
});
</script>