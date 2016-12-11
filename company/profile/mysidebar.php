					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic">
						<img src="http://<?php echo getFolderUrl();?>img/
						<?php
							if($company["logo"] == "0"){
								echo "demo.png";
							}
							else{
								echo "company/" . $company["logo"];
							}
						?>" class="img-responsive" alt="<?php echo $company["logo"];?>">
					</div>
					<!-- END SIDEBAR USERPIC -->
					<!-- SIDEBAR USER TITLE -->
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							<?php echo $company["nama"];?>
						</div>
						<div class="profile-usertitle-job">
							COMPANY
						</div>
					</div>
					<!-- END SIDEBAR USER TITLE -->
					<!-- SIDEBAR MENU -->
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="<?php active('profile.php');?>">
								<a href="http://<?php echo getFolderUrl();?>company/profile.php">
								<i class="glyphicon glyphicon-home"></i>
								Overview </a>
							</li>
							<li class="<?php active('setting.php');?>">
								<a href="http://<?php echo getFolderUrl();?>company/setting.php">
								<i class="glyphicon glyphicon-wrench"></i>
								Account Settings </a>
							</li>
						</ul>
					</div>
					<!-- END MENU -->