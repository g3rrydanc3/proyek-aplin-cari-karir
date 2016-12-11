<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	$db->where ("id", $_GET["id"]);
	$company = $db->getOne ("company");
	if(empty($company)){
		header("location:http://". getFolderUrl() ."error.php");
	}
?>
<div class="wrapper">
	<div class="container">
		<h1>Company Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("company/profile/sidebar.php");?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="profile-content">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Overview</h2>
						</div>
						<div class="panel-body">
							<h3><?php echo $company["nama"];?></h3>
							 <?php echo '<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> ' . $company["email"] . '</p>';?>
							 <?php echo '<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> ' . $company["tel"] . '</p>';?>
							 <?php echo '<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ' . $company["alamat"] . '</p>';?>
							 <?php if(strlen($company["deskripsi"]) != 0)echo '<h3>Description</h3>' . $company["deskripsi"];?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
