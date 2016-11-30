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
	
	$nama_perusahaan="";
	$gaji="";
	$tgl_masuk="";
	$tgl_keluar="";
	$posisi="";
	$gaji="";
	$deskripsi="";
	
	if($_GET["action"] == "edit"){
		$db->where ("id", $_GET["id"]);
		$query = $db->getOne ("pengalaman_kerja");
		
		if($query["user_id"] != $_SESSION["current"]){
			header("location:error.php");
		}
		$nama_perusahaan=$query["nama_perusahaan"];
		$gaji=$query["gaji"];
		$tgl_masuk=$query["tgl_masuk"];
		$tgl_keluar=$query["tgl_keluar"];
		$posisi=$query["posisi"];
		$gaji=$query["gaji"];
		$deskripsi=$query["deskripsi"];
	}
	

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
							<?php if($_GET["action"] == "add"){echo "<h2>Add Work History</h2>";}
							else {echo "<h2>Edit Work History</h2>";}?>
						</div>
						<div class="panel-body">
							<form class="form-horizontal" method="post" action="workhistory.php">
								<div class="form-group">
									<label class="control-label col-sm-2" for="nama_perusahaan">Company Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Enter company name" value="<?php echo $nama_perusahaan;?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="posisi">Position in Company</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="posisi" name="posisi" placeholder="Enter position in company" value="<?php echo $posisi;?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="gaji">Salary</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="gaji" name="gaji" placeholder="Enter salary" value="<?php echo $gaji;?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="tgl_masuk">Date Employment</label>
									<div class="col-sm-10">
										<input id="tgl_masuk" name="tgl_masuk" class="form-control" placeholder="DD-MM-YYYY" type="date" value="<?php echo htmlentities($tgl_masuk);?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="tgl_keluar">Date Out of Work</label>
									<div class="col-sm-10">
										<input id="tgl_keluar" name="tgl_keluar" class="form-control" placeholder="DD-MM-YYYY" type="date" value="<?php echo htmlentities($tgl_keluar);?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="deskripsi">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter description" maxlength="255"><?php echo $deskripsi;?></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									<?php
									if($_GET["action"] == "add"){
										echo '<button name="add" type="submit" class="btn btn-primary">Add</button>';
									}
									else{
										echo '<input type="hidden" name="id" value="'. $_GET["id"] .'">';
										echo '<button name="edit" type="submit" class="btn btn-primary">Edit</button>';
									}?>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>