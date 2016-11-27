<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");

	$db->where ("id", $_SESSION["current"]);
	$queryBirthDate = $db->getOne ("user", "DATE_FORMAT(birthdate,'%d-%m-%Y')");
	$queryBirthDate = reset($queryBirthDate);
	
	$db->where ("user_id", $_SESSION["current"]);
	$setting = $db->getOne ("user_setting_shown");

	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	if(isset($_POST["btnPrivacy"])){
		$gender = 0;$birthdate = 0;$address = 0;$tel = 0;$hobby = 0;$bahasa = 0;$warga_negara = 0;$agama = 0;$about_me = 0;$biodata = 0;
		
		if(isset($_POST["gender"])){
			$gender = 1;
		}
		if(isset($_POST["birthdate"])){
			$birthdate = 1;
		}
		if(isset($_POST["address"])){
			$address = 1;
		}
		if(isset($_POST["tel"])){
			$tel = 1;
		}
		if(isset($_POST["hobby"])){
			$hobby = 1;
		}
		if(isset($_POST["bahasa"])){
			$bahasa = 1;
		}
		if(isset($_POST["warga_negara"])){
			$warga_negara = 1;
		}
		if(isset($_POST["agama"])){
			$agama = 1;
		}
		if(isset($_POST["about_me"])){
			$about_me = 1;
		}
		if(isset($_POST["biodata"])){
			$biodata = 1;
		}
		
		$data = Array(
			'gender' => $gender,
			'birthdate' => $birthdate,
			'address' => $address,
			'tel' => $tel,
			'hobby' => $hobby,
			'bahasa' => $bahasa,
			'warga_negara' => $warga_negara,
			'agama' => $agama,
			'about_me' => $about_me,
			'biodata' => $biodata
		);	
		$db->where ("user_id", $_SESSION["current"]);
		if ($db->update ('user_setting_shown', $data)){
			$javascript.= '<script>swal("Success!", "Privacy updated successfully!", "success")</script>';
		}
		else{
			die($db->getLastError());
		}
	}
	else if(isset($_POST["btnProfile"])){
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$birthdate = $_POST["birthdate"];
		$address = $_POST["address"];
		$tel = $_POST["tel"];
		$zipcode = $_POST["zipcode"];
		$hobby = $_POST["hobby"];
		$bahasa = $_POST["bahasa"];
		$warga_negara = $_POST["warga_negara"];
		$agama = $_POST["agama"];
		$about_me = $_POST["about_me"];
		
		$data = Array(
			'name' => $name,
			'gender' => $gender,
			'birthdate' => $birthdate,
			'address' => $address,
			'tel' => $tel,
			'zipcode' => $zipcode,
			'hobby' => $hobby,
			'bahasa' => $bahasa,
			'warga_negara' => $warga_negara,
			'agama' => $agama,
			'about_me' => $about_me,
		);
		$db->where ("id", $_SESSION["current"]);
		if ($db->update ('user', $data)){
			$javascript.= '<script>swal("Success!", "Profile updated successfully!", "success")</script>';
		}
		else{
			die($db->getLastError());
		}
	}

	function settingCheck($var){
		if($GLOBALS['setting'][$var] == 1){
			echo "checked";
		}
	}
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
			defaultPreviewContent: '<div class=\"profile-userpic\"><img src=\"img/";
			if($user["foto"] == "0"){
				$javascript .= "demo.png";
			}
			else{
				$javascript .= "user/" . $user["foto"];
			}
			$javascript .= "\" alt=\"Your Avatar\"\"></div><h6 class=\"text-muted\">Click to change photo</h6>',
			layoutTemplates: {main2: '{preview}'},
			allowedFileExtensions: [\"jpg\", \"png\", \"gif\"],
			uploadUrl: \"upload.php\",
			uploadExtraData: function() {
				return {
					id: " . $_SESSION["current"] . ",
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
					<div class="panel-group" id="accordion">
						<!-- Profile -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Profile</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse">
								<div class="panel-body">
									<form class="form-horizontal" method="post" action="setting.php">
										<div class="form-group">
											<label class="control-label col-sm-2" for="name">Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="name" id="name" value="<?php echo $user["name"]?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="gender">Gender</label>
											<div class="col-sm-10">
												<label class="radio-inline">
													<input type="radio" name="gender" value="male" <?php if($user["gender"] == "male") echo "checked";?>>Male
												</label>
												<label class="radio-inline">
													<input type="radio" name="gender" value="female"<?php if($user["gender"] == "female") echo "checked";?>>Female
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="dob">Date of Birth</label>
											<div class="col-sm-10">
												<input id="dob" name="dob" class="form-control" placeholder="DD-MM-YYYY" type="date" value="<?php echo $queryBirthDate;?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="address">Address</label>
											<div class="col-sm-10">
												<input id="address" name="address" class="form-control" type="text" value="<?php echo $user["address"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="zipcode">Zipcode</label>
											<div class="col-sm-10">
												<input id="zipcode" name="zipcode" class="form-control" type="text" value="<?php echo $user["zipcode"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="tel">Telephone</label>
											<div class="col-sm-10">
												<input id="tel" name="tel" class="form-control" type="text" value="<?php echo $user["tel"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="hobby">Hobby</label>
											<div class="col-sm-10">
												<input id="hobby" name="hobby" class="form-control" type="text" value="<?php echo $user["hobby"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="bahasa">Languange</label>
											<div class="col-sm-10">
												<input id="bahasa" name="bahasa" class="form-control" type="text" value="<?php echo $user["bahasa"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="warga_negara">Nationality</label>
											<div class="col-sm-10">
												<input id="warga_negara" name="warga_negara" class="form-control" type="text" value="<?php echo $user["warga_negara"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="agama">Religion</label>
											<div class="col-sm-10">
												<input id="agama" name="agama" class="form-control" type="text" value="<?php echo $user["address"];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="about_me">About me</label>
											<div class="col-sm-10">
												<textarea id="about_me" name="about_me" class="form-control" type="text"><?php echo $user["about_me"];?></textarea>
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
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Photo</a>
								</h4>
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
						<!-- Privacy -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Privacy</a>
								</h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
								<div class="panel-body">
									<form method="post" action="setting.php">
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="gender">Show gender</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="gender" name="gender" <?php settingCheck("gender"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="birthdate">Show birth of date</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="birthdate" name="birthdate" <?php settingCheck("birthdate"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="address">Show address</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="address" name="address" <?php settingCheck("address"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="tel">Show telephone</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="tel" name="tel" <?php settingCheck("tel"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="hobby">Show hobby</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="hobby" name="hobby" <?php settingCheck("hobby"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="bahasa">Show languange</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="bahasa" name="bahasa" <?php settingCheck("bahasa"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="warga_negara">Show nationality</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="warga_negara" name="warga_negara" <?php settingCheck("warga_negara"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="agama">Show religion</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="agama" name="agama" <?php settingCheck("agama"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="about_me">Show about me</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="about_me" name="about_me" <?php settingCheck("about_me"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3 text-right" for="biodata">Show biodata</label>
											<div class="col-sm-9">
												<label class="switch">
													<input type="checkbox" id="biodata" name="biodata" <?php settingCheck("biodata"); ?>>
														<div class="slider round"></div>
												</label>
											</div>
										</div>
										<div class="form-group col-sm-offset-2">
											<button type="submit" class="btn btn-primary" name="btnPrivacy">Update</button>
										</div>
									</form>
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
