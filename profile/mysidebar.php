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
							<?php echo $queryRole;?>
						</div>
					</div>
					<!-- END SIDEBAR USER TITLE -->
					<!-- SIDEBAR BUTTONS -->
					<div class="profile-userbuttons">
						<a href="#"><button type="button" class="btn btn-primary btn-sm">Message</button></a>
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