<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");

	if (!isset($_GET['search'])){
		header("location:header.php;");
	}else{
		$search = trim($_GET['search']);
		if(!empty($search)){
			$query1 = $db->rawQuery('SELECT * from lowongan where judul like "%'. $search . '%"');
			$query2 = $db->rawQuery('SELECT * from user where name like "%'. $search . '%"');
			$query3 = $db->rawQuery('SELECT * from company where nama like "%'. $search . '%"');
		}
		
	}
	
?>
	<div class="wrapper">
		<div class="container">
			<h2>Job</h2><hr>
			<?php
				if(empty($query1)){
					echo '<p class="text-muted text-center">Job not found.</p>';
				}
				else{
					echo '<div class="row">';
					foreach($query1 as $data){
						$db->where("id", $data["company_id"]);
						$queryCompany = $db->getOne("company")["nama"];
						echo '
						<div class="col-sm-3">
							<a href = "job/job.php?id='. $data['id'] .'">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4>'. $data["judul"] .' </h3>
									</div>
									<div class="panel-body">
										<table class="table table-borderless">
											<tr>
												<td>Position</td>
												<td>'. $data["posisi"] .'</td>
											</tr>
												<td>Requirement</td>
												<td>'. $data["syarat"] .'</td>
											<tr>
											</tr>
											<tr>
												<td>City</td>
												<td>'. $data["kota"] .'</td>
											</tr>
											<tr>
												<td>Company</td>
												<td>'. $queryCompany .'</td>
											</tr>
										</table>
									</div>
								</div>
							</a>
						</div>
						';
					}
					echo '</div>';
				}
				?>
				
				<h2>User</h2><hr>
				<?php
				if(empty($query2)){
					echo '<p class="text-muted text-center">User not found.</p>';
				}
				else{
					echo '<div class="row">';
					foreach($query2 as $data){
						echo '
						<div class="col-sm-3">
							<a href = "profile/profile.php?id='.$data["id"].'">
							<div class="panel panel-default">
								<div class="panel-heading">
									'. $data["name"] .'
								</div>
								<div class="panel-body"> 
										<div class="profile-userpic">
											<img src="http://'. getFolderUrl().'img/';
												if($data["foto"] == "0"){
													echo "demo.png";
												}
												else{
													echo "user/" . $data["foto"];
												}
											echo '" class="img-responsive" alt="'. $data["foto"] .'">
											<p class="text-center">'. $data["kota"] .'</p>
										</div>
									</div>
								</div>
							</a>
						</div>
						';
					}
					echo '</div>';
				}
				?>
				<h2>Company</h2><hr>
				<?php
				if(empty($query3)){
					echo '<p class="text-muted text-center">Company not found.</p>';
				}
				else{
					echo '<div class="row">';
					foreach($query3 as $data){
						echo '
						<div class="col-sm-3">
							<a href = "viewcompany.php">
								<div class="panel panel-default">
									<div class="panel-heading">
										'. $data["nama"] .' 
									</div>
										<div class="panel-body"> 
											<div class="profile-userpic">
												<img src="http://'. getFolderUrl().'img/';
													if($data["logo"] == "0"){
														echo "demo.png";
													}
													else{
														echo "company/" . $data["logo"];
													}
												echo '" class="img-responsive" alt="'. $data["logo"] .'">
												<p class="text-center">'. $data["kota"] .'</p>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						';
					}
					echo '</div>';
				}
			?>
		</div>
	</div>
<?php
	require_once("footer.php");
?>