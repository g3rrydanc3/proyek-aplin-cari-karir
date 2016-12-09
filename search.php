<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	if (!isset($_GET['q'])){
		header("location:header.php;");
	}else{
		$search = $_GET['q'];
		$query1 = $db->rawQuery('SELECT * from pekerjaan where nama like "%'. $search . '%"');
		$query2 = $db->rawQuery('SELECT * from user where name like "%'. $search . '%"');
		$query3 = $db->rawQuery('SELECT * from company where nama like "%'. $search . '%"');
	}
	
?>
	<div class="wrapper">
		<div class="container">
			<h1>Search : <?php echo $search ?></h1>
			<?php
				echo "<h2> Job </h2>";
				foreach($query1 as $data){
					echo '
					<div class="panel panel-default">
						<div class="panel-heading"><a href = "viewjob.php">[Job]'. $data["nama"] .' </a></div>
						<div class="panel-body">'. $data["deskripsi"] .' </div>
					</div>
					';
				}
				if(empty($query1)){
					echo '
					<div class="panel panel-default">
						<div class="panel-body"><p class="text-muted">Job not found.</p></div>
					</div>
					';
				}
				echo "<h2> User </h2>";
				foreach($query2 as $data){
					echo '
					<div class="panel panel-default">
						<div class="panel-heading"><a href = "profile/profile.php?id='.$data["id"].'">[User]'. $data["name"] .' </a></div>
							<div class="panel-body"> 
								<div class="col-sm-3">
									<div class="profile-userpic">
										<a href = "profile/profile.php?id='.$data["id"].'"><img src="http://'. getFolderUrl().'img/';
											if($data["foto"] == "0"){
												echo "demo.png";
											}
											else{
												echo "user/" . $data["foto"];
											}
										echo '" class="img-responsive" alt="'. $data["foto"] .'">
										</a>
									</div>
								</div>
								<div class="col-sm-1">';
									$db->where ("user_id", $data["id"]);
									$setting = $db->getOne ("user_setting_shown");
									$db->where ("id", $data["id"]);
									$queryBirthDate = $db->getOne ("user", "DATE_FORMAT(birthdate,'%d-%m-%Y')");
									$queryBirthDate = reset($queryBirthDate);
									if($setting["birthdate"] == 1)
										echo '<p style = "text-align: right;">Birthdate: </p>';
									if($setting["address"] == 1)
										echo '<p style = "text-align: right;">Address: </p>';
								echo '</div>
								<div class="col-sm-8">';
									$db->where ("user_id", $data["id"]);
									$setting = $db->getOne ("user_setting_shown");
									$db->where ("id", $data["id"]);
									$queryBirthDate = $db->getOne ("user", "DATE_FORMAT(birthdate,'%d-%m-%Y')");
									$queryBirthDate = reset($queryBirthDate);
									if($setting["birthdate"] == 1)
										echo '<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ' . $queryBirthDate . '</p>';
									if($setting["address"] == 1)
										echo '<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ' . $data["address"] . ' ' . $data["zipcode"] . '</p>';
								echo '</div>
							</div>
						</div>
					';
				}
				if(empty($query2)){
					echo '
					<div class="panel panel-default">
						<div class="panel-body"><p class="text-muted">User not found.</p></div>
					</div>
					';
				}
				echo "<h2> Company </h2>";
				foreach($query3 as $data){
					echo '
					<div class="panel panel-default">
						<div class="panel-heading"><a href = "viewcompany.php">[Company]'. $data["nama"] .' </a></div>
							<div class="panel-body"> 
								<div class="col-sm-3">
									<div class="profile-userpic">
										<img src="http://'. getFolderUrl().'img/';
											if($data["logo"] == "0"){
												echo "demo.png";
											}
											else{
												echo "company/" . $data["logo"];
											}
										echo '" class="img-responsive" alt="'. $data["logo"] .'">
									</div>
								</div>
								<div class="col-sm-1"><p style = "text-align: right;"> Nama: </p><p style = "text-align: right;"> Alamat: </p><p style = "text-align: right;">Telp: </p></div>
								<div class="col-sm-8"><p>'. $data["nama"] . '</p><p>'.$data["alamat"].'</p><p>'.$data["tel"].'</p>
							</div>
						</div>
					';
				}
				if(empty($query3)){
					echo '
					<div class="panel panel-default">
						<div class="panel-body"><p class="text-muted">Company not found.</p></div>
					</div>
					';
				}
			?>
		</div>
	</div>
<?php
	require_once("footer.php");
?>