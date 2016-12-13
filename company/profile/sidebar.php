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
					<!-- SIDEBAR BUTTONS -->
					<?php if(strlen($_SESSION["current"]) != 0){
						echo '<div class="profile-userbuttons">
						<a href="#"><button type="button" class="btn btn-primary btn-sm">Message</button></a>
					</div>';
					}?>
					<!-- END SIDEBAR BUTTONS -->
					<!-- SIDEBAR MENU -->
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="active">
								<a href="http://<?php echo getFolderUrl();?>company.php<?php echo passingGet();?>">
								<i class="glyphicon glyphicon-home"></i>
								Overview </a>
							</li>
						</ul>
					</div>
					<!-- END MENU -->