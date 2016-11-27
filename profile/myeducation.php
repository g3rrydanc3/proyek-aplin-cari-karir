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
						<div class="panel-body">
							<h3>Marcus Doe</h3>
							<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> asdf@asdf.com</p>
							<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 0561687891</p>
							<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 31 February 2016</p>
							<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> SDFQWER SURABAYA</p>
							asdfasdf
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
