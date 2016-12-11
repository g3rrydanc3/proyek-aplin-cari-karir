<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	$db->where ("id", $_SESSION["current"]);
	$company = $db->getOne ("company");

	//$db->where ("id", $_SESSION["current"]);
	//$queryBirthDate = $db->getOne ("user", "DATE_FORMAT(birthdate,'%d-%m-%Y')");
	//$queryBirthDate = reset($queryBirthDate);
	
	//$db->where ("user_id", $_SESSION["current"]);
	//$setting = $db->getOne ("user_setting_shown");

	//$db->where ("id", $user["role"]);
	//$queryRole = $db->getOne ("role");
	//$queryRole = $queryRole["name"];
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
							<h2>Overview</h2>
						</div>
						<div class="panel-body">
							<h3><?php echo $company["nama"];?></h3>
							 
							 
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
