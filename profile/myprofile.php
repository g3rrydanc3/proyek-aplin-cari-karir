<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");
	$db->where ("user_id", $_SESSION["current"]);
	$setting = $db->getOne ("user_setting_shown");
	
?>
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic">
						<img src="img/
						<?php
							if($user["foto"] == "0"){
								echo "demo.png";
							}
							else{
								echo "user/" . $user["foto"];
							}
						?>" class="img-responsive" alt="<?php echo $user["foto"];?>">
					</div>
					<!-- END SIDEBAR USERPIC -->
					<!-- SIDEBAR USER TITLE -->
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							<?php echo $user["name"];?>
						</div>
						<div class="profile-usertitle-job">
							<?php
								if($user["role"] == 1){
									echo "STUDENT";
								}
								else if($user["role"] == 2){
									echo "COMPANY";
								}
								else{
									echo "OTHER";
								}
							
							?>
						</div>
					</div>
					<!-- END SIDEBAR USER TITLE -->
					<!-- SIDEBAR BUTTONS -->
					<div class="profile-userbuttons">
						<button type="button" class="btn btn-success btn-sm">Follow</button>
						<button type="button" class="btn btn-danger btn-sm">Message</button>
					</div>
					<!-- END SIDEBAR BUTTONS -->
					<!-- SIDEBAR MENU -->
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="<?php active('profile.php');?>">
								<a href="http://<?php echo getFolderUrl();?>profile.php">
								<i class="glyphicon glyphicon-home"></i>
								Overview </a>
							</li>
							<li class="<?php active('education.php');?>">
								<a href="education.php">
								<i class=" 	glyphicon glyphicon-education"></i>
								Education </a>
							</li>
							<li class="<?php active('experience.php');?>">
								<a href="http://<?php echo getFolderUrl();?>experience.php">
								<i class="glyphicon glyphicon-briefcase"></i>
								Work Experience </a>
							</li>
							<li class="<?php active('setting.php');?>">
								<a href="http://<?php echo getFolderUrl();?>setting.php">
								<i class="glyphicon glyphicon-wrench"></i>
								Account Settings </a>
							</li>
						</ul>
					</div>
					<!-- END MENU -->
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
							 <?php if($setting["birthdate"] == 1)echo '<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ' . $user["birthdate"] . '</p>';?>
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
