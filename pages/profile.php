<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
?>
<div class="wrapper">
	<div class="container">
		<h1>Profile</h1>
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
							<li class="active">
								<a href="#">
								<i class="glyphicon glyphicon-home"></i>
								Overview </a>
							</li>
							<li>
								<a href="#">
								<i class="glyphicon glyphicon-user"></i>
								Account Settings </a>
							</li>
							<li>
								<a href="#" target="_blank">
								<i class="glyphicon glyphicon-ok"></i>
								Tasks </a>
							</li>
							<li>
								<a href="#">
								<i class="glyphicon glyphicon-flag"></i>
								Help </a>
							</li>
						</ul>
					</div>
					<!-- END MENU -->
				</div>
			</div>
			<div class="col-sm-9">
				<div class="profile-content">
				   Some user related content goes here...
				</div>
			</div>
		</div>
	</div>
</div>
