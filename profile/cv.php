<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once( __DIR__.'/../config.php');
	
	if(strlen($_SESSION["current"]) == 0 || !is_numeric($_SESSION["role"])){
		header("location:http://". getFolderUrl() ."error.php");
	}
	
	if (isset($_SESSION['current'])){
		$user = $_SESSION['current'];
		$db->where("id", $user);
		$temp = $db->getOne("user");
		$nama = $temp['name'];
		$address = $temp['address'];
	}
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");
	
	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	$db->where ("user_id", $_SESSION["current"]);
	$informal = $db->get ("informal");
	
	$db->where ("user_id", $_SESSION["current"]);
	$formal = $db->get ("formal");
?>
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
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Curriculum Vitae </title>
		<link rel="stylesheet" href="http://<?php echo getFolderUrl();?>css/cv.css">
		<script src = "http://<?php echo getFolderUrl();?>js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				window.print();
			});
		</script>
	</head>
	<body>
		<header>
			<h1> Curriculum Vitae </h1>
				<div class="wrapper">
					<div class="container">
						<div class="row profile">
							<div class="col-sm-12">
								<div class="profile-content">
									<div class="panel panel-default">
										<div class="panel-body">
											<img style="display:block;" height="200px" src="http://<?php echo getFolderUrl();?>img/
											<?php
												if($user["foto"] == "0"){
													echo "demo.png";
												}
												else{
													echo "user/" . $user["foto"];
												}
											?>" alt="<?php echo $user["foto"];?>">
											<?php 
											echo "<h3>Name :" . $user["name"] . "</h3>";
											echo '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Email : ' . $user["email"] . '</p>';
											if($setting["tel"] == "1") echo '<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>Telephone : ' . $user["tel"] . '</p>';
											if($setting["birthdate"] == "1")echo '<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Date of Birth : ' . $queryBirthDate . '</p>';
											if($setting["address"] == "1")echo '<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Address : ' . $user["address"] . ' ' . $user["zipcode"] . '</p>';
											if($setting["about_me"] == "1"){ echo "About Me :" . $user["about_me"];}?>
											 
										</div>
									</div>
									<?php if ($setting["biodata"] == 1){
										echo '<div class="panel panel-default">
											<div class="panel-body">' .
											'<p><b>Hobby : </b>' . $user["hobby"] . '</p>' .
											'<p><b>Languange : </b>' . $user["bahasa"] . '</p>' .
											'<p><b>Citizen : </b>' . $user["warga_negara"] . '</p>' .
											'<p><b>Religion : </b>' . $user["agama"] . '</p>' .
											'</div>';
									}?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wrapper">
					<div class="container">
						<div style="clear:both; padding-top:20px;"></div>
						<h1>Education</h1>
						<div class="row profile">
							
							<div class="col-sm-12">
								<div class="profile-content">
									<div class="panel panel-default">
										<div class="panel-heading">
										</div>
										<div class="panel-body">
											<hr>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Institution</th>
															<th>Year Finished</th>
															<th>Description</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(count($formal) == 0){
																echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div></td></tr>";
															}
															else{
																foreach ($formal as $data) {
																	if($data["show"] == "1"){
																		echo "<tr>";
																		echo "<td>" . $data['sekolah'] . "</td>
																		<td>" . $data['tahun'] . "</td>
																		<td>" . $data['deskripsi'] . "</td>";
																	}
																} 
															}
														?>
													</tbody>
												</table>
											</div>
											<hr>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Institution</th>
															<th>Year Finished</th>
															<th>Description</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if(count($formal) == 0){
															echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div></td></tr>";
														}
														else{
															foreach ($informal as $data) {
																if($data["show"] == "1"){
																	echo "<tr>";
																	echo "<td>" . $data['sekolah'] . "</td>
																	<td>" . $data['tahun'] . "</td>
																	<td>" . $data['deskripsi'] . "</td></tr>";
																}
															} 
														}
															
															
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
	</body>
</html>
	
	
<?php	
	//require_once( __DIR__.'/../footer.php');
?>