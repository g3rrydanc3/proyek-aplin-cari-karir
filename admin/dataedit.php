<?php 
	require_once("header.php");
	
	
	$user=[];
	if(!empty($_GET)){
		if($_GET["action"] == "delete"){
			$db->where("id", $_GET["id"]);
			if($db->delete('user')){
				echo "
					<script>
						swal({
							title: 'Success!',
							text: 'Data updated successfully!',
							type: 'success',
							closeOnConfirm: false
						},
						function(){
							window.location.href = 'data.php';
						});
					</script>
				";
			}
			else
				echo 'update failed: ' . $db->getLastError();
		}
		else{
			$db->where("id", $_GET["id"]);
			$user = $db->getOne("user");
		}
	}
	
	
	if(!empty($_POST)){
		$db->where ('id', $_POST["id"]);
		if ($db->update ('user', $_POST))
			echo "
				<script>
					swal({
						title: 'Success!',
						text: 'Data updated successfully!',
						type: 'success',
						closeOnConfirm: false
					},
					function(){
						window.location.href = 'data.php';
					});
				</script>
			";
		else
			echo 'update failed: ' . $db->getLastError();
	}
	
?>
		<div class="col-sm-9">
			<h1>Data</h1>
			<div class="kv-avatar center-block">
					<input id="avatar-2" name="images" type="file" class="file-loading">
				</div>
			<form class="form-horizontal" method="post" action="dataedit.php">
				<div id="kv-avatar-errors-2" class="center-block" style="display:none"></div>
				<?php 
					if(!empty($_GET)){
						foreach($user as $key => $data){
							echo '
								<div class="form-group">
									<label class="control-label col-sm-2" for="'. $key .'">'. $key .'</label>
									<div class="col-sm-10">';
							if($key == "password" || $key == "activation_token" || $key == "last_activation_request" || $key == "sign_up_stamp" || $key == "last_sign_in_stamp"){
								echo '<input type="text" class="form-control" id="'. $key .'" name="'. $key .'" value="'. $data .'" disabled>';
							}
							else{
								echo '<input type="text" class="form-control" id="'. $key .'" name="'. $key .'" value="'. $data .'">';
							}
										
									echo '</div>
								</div>
							';
						}
					}
				?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>

<?php
echo "
		<script>
		$(\"#avatar-2\").fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			showBrowse: false,
			browseOnZoneClick: true,
			removeLabel: '',
			removeIcon: '<i class=\"glyphicon glyphicon-remove\"></i>',
			removeTitle: 'Cancel or reset changes',
			elErrorContainer: '#kv-avatar-errors-2',
			msgErrorClass: 'alert alert-block alert-danger',
			uploadClass: 'btn btn-primary',
			defaultPreviewContent: '<div class=\"profile-userpic\"><img src=\"../img/";
			if($user["foto"] == "0"){
				echo "demo.png";
			}
			else{
				echo "user/" . $user["foto"];
			}
			echo "\" alt=\"Your Avatar\"></div><h6 class=\"text-muted\">Click to change photo</h6>',
			layoutTemplates: {main2: '{preview}'},
			allowedFileExtensions: [\"jpg\", \"png\", \"gif\"],
			uploadUrl: \"upload.php\",
			uploadExtraData: function() {
				return {
					id: " . $_GET["id"] . ",
					Access: '1'
				}
			}
        });
		$('#avatar-2').on('fileuploaded', function(event, data, previewId, index) {
			var form = data.form, files = data.files, extra = data.extra,
				response = data.response, reader = data.reader;
				swal({
					title: 'Success!',
					text: 'Photo updated successfully!',
					type: 'success',
					closeOnConfirm: false
				},
					function(){
					window.location.reload(true);
				});
		});
		</script>";
?>