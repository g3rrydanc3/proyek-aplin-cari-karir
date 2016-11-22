<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
?>
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic">
						<img src="img/demo.png" class="img-responsive" alt="">
					</div>
					<!-- END SIDEBAR USERPIC -->
					<!-- SIDEBAR USER TITLE -->
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							Marcus Doe
						</div>
						<div class="profile-usertitle-job">
							Developer
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
