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
							<h3><?php echo $user["name"];?></h3>
							 <?php echo '<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> ' . $user["email"] . '</p>';?>
							 <?php if($setting["tel"] == 1) echo '<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> ' . $user["tel"] . '</p>';?>
							 <?php if($setting["birthdate"] == 1)echo '<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ' . $queryBirthDate . '</p>';?>
							 <?php if($setting["address"] == 1)echo '<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ' . $user["address"] . ' ' . $user["zipcode"] . '</p>';?>
							 <?php if($setting["about_me"] == 1){ echo '<h3>About me</h3>' . $user["about_me"];}?>
							 
						</div>
					</div>
					<?php if ($setting["biodata"] == 1){
						echo '<div class="panel panel-default">
								<div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" href="#collapse1">Biodata (Click to open)</a></h4></div>
								<div id="collapse1" class="panel-collapse collapse">
									<div class="panel-body">' .
									'<p><b>Hobby : </b>' . $user["hobby"] . '</p>' .
									'<p><b>Languange : </b>' . $user["bahasa"] . '</p>' .
									'<p><b>Citizen : </b>' . $user["warga_negara"] . '</p>' .
									'<p><b>Religion : </b>' . $user["agama"] . '</p>' .
									'</div>
								</div>
							</div>';
					}?>
				</div>
			</div>
		</div>
	</div>
</div>
