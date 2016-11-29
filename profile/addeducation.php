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
	
	if(isset($_GET["add"])){
		if($_GET["add"] != "formal" && $_GET["add"] != "informal"){
			header("location:error.php");
		}
	}
	else if(!isset($_GET["edu"])){
		header("location:error.php");
	}
	
	$sekolah="";
	$tahun="";
	$deskripsi="";
	
	if(isset($_GET["edu"])){
		$db->where ("id", $_GET["id"]);
		$query = null;
		if($_GET["edu"] == "informal"){
			$query = $db->getOne ("informal");
		}
		else{
			$query = $db->getOne ("formal");
		}
		
		if($query["user_id"] != $_SESSION["current"]){
			header("location:error.php");
		}
		
		if(!is_null($query)){
			$sekolah = $query["sekolah"];
			$tahun = $query["tahun"];
			$deskripsi = $query["deskripsi"];
		}
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
							<?php if(isset($_GET["edu"])){echo "<h2>Edit</h2>";}
							else if($_GET["add"] == "formal"){echo "<h2>Add Formal Education</h2>";}
							else{echo "<h2>Add Informal Education</h2>";}?>
						</div>
						<div class="panel-body">
							<form class="form-horizontal" method="post" action="education.php">
								<div class="form-group">
									<label class="control-label col-sm-2" for="sekolah">Institution</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Enter institution" value="<?php echo $sekolah;?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="tahun">Year Finished</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="tahun" name="tahun" placeholder="Enter year finished" maxlength="4" value="<?php echo $tahun;?>">
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
									if(isset($_GET["add"])){
										echo '<input type="hidden" name="edu" value="'. $_GET["add"] .'">';
										echo '<button name="add" type="submit" class="btn btn-primary">Add</button>';
									}
									else{
										echo '<input type="hidden" name="id" value="'. $_GET["id"] .'">';
										echo '<input type="hidden" name="edu" value="'. $_GET["edu"] .'">';
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