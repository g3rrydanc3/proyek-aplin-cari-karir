<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	if(isset($_POST["btnProfile"])){
		$nama = $_POST["nama"];
		$nama_cp = $_POST["nama_cp"];
		$tel = $_POST["tel"];
		$alamat = $_POST["alamat"];
		$deskripsi = $_POST["deskripsi"];
		
		if(empty($nama) || empty($nama_cp) || empty($tel) || empty($alamat)){
			$javascript.= '<script>swal("Failed!", "Profile update failed!", "error")</script>';
		}
		else{
			$data = Array("nama" => $nama,
				"nama_cp"=> $nama_cp,
				"tel" => $tel,
				"alamat" => $alamat,
				"deskripsi" => $deskripsi
			);
			$db->where("id", $_SESSION["current"]);
			if($db->update("company", $data)){
				$javascript.= '<script>swal({
						title: "Success!",
						text: "Profile updated successfully!",
						type: "success",
						closeOnConfirm: false
					})</script>';
			}
			else{
				$javascript.= '<script>swal("Failed!", "Profile update failed!", "danger")</script>';
			}
		}
		
		
	}
	
	$db->where ("id", $_SESSION["current"]);
	$company = $db->getOne ("company");

	

	$javascript .="
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
			defaultPreviewContent: '<div class=\"profile-companypic\"><img src=\"http://". getFolderUrl()."/img/";
			if($company["logo"] == "0"){
				$javascript .= "demo.png";
			}
			else{
				$javascript .= "company/" . $company["logo"];
			}
			$javascript .= "\" alt=\"Your Avatar\"\"></div><h6 class=\"text-muted\">Click to change photo</h6>',
			layoutTemplates: {main2: '{preview}'},
			allowedFileExtensions: [\"jpg\", \"png\", \"gif\"],
			uploadUrl: \"http://". getFolderUrl() ."upload.php\",
			uploadExtraData: function() {
				return {
					id: " . $_SESSION["current"] . ",
					role: '". $_SESSION['role'] ."',
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
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("mysidebar.php");?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="profile-content">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Setting</h2>
						</div>
						<div class="panel-body">
							<a href="http://<?php echo getFolderUrl();?>passwordchange.php"><button type="button" class="btn btn-primary btn-block">Change Password</button></a>
						</div>
					</div>
						
					<div class="panel-group" id="accordion">
						<!-- Profile -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Profile</a>
								</h3>
							</div>
							<div id="collapse1" class="panel-collapse collapse">
								<div class="panel-body">
									<form class="form-horizontal" method="post" action="setting.php">
										<div class="form-group">
											<label class="control-label col-sm-2" for="nama">Company Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $company["nama"]?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="nama_cp">Contact Person Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_cp" id="nama_cp" value="<?php echo $company["nama_cp"]?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="tel">Telephone</label>
											<div class="col-sm-10">
												<input id="tel" name="tel" class="form-control" type="text" value="<?php echo $company["tel"];?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="alamat">Address</label>
											<div class="col-sm-10">
												<input id="alamat" name="alamat" class="form-control" type="text" value="<?php echo $company["alamat"];?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="deskripsi">Description</label>
											<div class="col-sm-10">
												<textarea id="deskripsi" name="deskripsi" class="form-control" type="text"><?php echo $company["deskripsi"];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<button type="submit" class="btn btn-primary" name="btnProfile">Update</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Photo -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Photo</a>
								</h3>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="kv-avatar center-block">
										<input id="avatar-2" name="images" type="file" class="file-loading">
									</div>
									<div id="kv-avatar-errors-2" class="center-block" style="display:none"></div>
								</div>
							</div>
						</div>
					
						<!-- Something 
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Collapsible Group 3</a>
								</h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse">
								<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
								sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
								minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								commodo consequat.</div>
							</div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
