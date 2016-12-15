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
?>
<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	if(isset($_POST["add"])){
		$sekolah = $_POST["sekolah"];
		$tahun = $_POST["tahun"];
		$deskripsi = $_POST["deskripsi"];
		$edu = $_POST["edu"];
		$data = Array (
			'sekolah' => $sekolah,
			'tahun' => $tahun,
			'deskripsi' => $deskripsi,
			'user_id' => $_SESSION["current"]
		);
		$insert = null;
		if($edu = "formal"){
			$insert = $db->insert ('formal', $data);
		}
		else{
			$insert = $db->insert ('informal', $data);
		}
		if($insert){
			$javascript.="
				<script>
					swal({
						title: 'Success!',
						text: 'Data added successfully!',
						type: 'success',
						closeOnConfirm: false
					});
				</script>
			";
		}
	}
	else if(isset($_POST["edit"])){
		$sekolah = $_POST["sekolah"];
		$tahun = $_POST["tahun"];
		$deskripsi = $_POST["deskripsi"];
		$id = $_POST["id"];
		$edu = $_POST["edu"];
		$data = Array (
			'sekolah' => $sekolah,
			'tahun' => $tahun,
			'deskripsi' => $deskripsi
		);
		$db->where ('id', 1);
		if($edu == "formal"){
			if ($db->update ('formal', $data)){
				$javascript.="
					<script>
						swal({
							title: 'Success!',
							text: 'Data updated successfully!',
							type: 'success',
							closeOnConfirm: false
						});
					</script>
				";
			}
			else{
				header("location:error.php");
			}
		}
		else{
			if ($db->update ('informal', $data)){
				$javascript.="
					<script>
						swal({
							title: 'Success!',
							text: 'Data updated successfully!',
							type: 'success',
							closeOnConfirm: false
						});
					</script>
				";
			}
			else{
				header("location:error.php");
			}
		}
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
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
		<script src = "jquery.js"></script>
		<script src="script.js"></script>
		<script>
			$(document).ready(function(){
				window.print();
			});
		</script>
	</head>
	<body>
		<header>
			<h1> Curriculum Vitae </h1>
			<address contenteditable>
				<img src = "profile/user.png" width = 25px height = 25px style = "float: left; margin-right: 3px;"><div style = "font-size: 20px;"> Profile</div>
				<p><?php echo $nama; ?></p>
				<img src = "profile/house.png" width = 15px height = 15x style = "float: left; margin-right: 3px;"><p>(800) 555-1234</p>
				<div class="wrapper">
					<div class="container">
						<h1>My Profile</h1>
						<div class="row profile">
							<div class="col-sm-12">
								<div class="profile-content">
									<div class="panel panel-default">
										<div class="panel-body">
											<h3>Name : <?php echo $user["name"];?></h3>
											 Email : <?php echo '<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> ' . $user["email"] . '</p>';?>
											 Telephone : <?php if($setting["tel"] == 1) echo '<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> ' . $user["tel"] . '</p>';?>
											 Date of Birth : <?php if($setting["birthdate"] == 1)echo '<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ' . $queryBirthDate . '</p>';?>
											 Address : <?php if($setting["address"] == 1)echo '<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ' . $user["address"] . ' ' . $user["zipcode"] . '</p>';?>
											 About Me : <?php if($setting["about_me"] == 1){ echo $user["about_me"];}?>
											 
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
						<h1>My Profile</h1>
						<div class="row profile">
							
							<div class="col-sm-12">
								<div class="profile-content">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h2>Education</h2>
										</div>
										<div class="panel-body">
											<h3>Formal education</h3>
											<hr>
											<div class="table-responsive">
												
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Institution</th>
															<th>Year Finished</th>
															<th>Description</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($formal as $data) {
																if($data["show"] == "1"){
																	echo "<tr>";
																}
																else{
																	echo "<tr class='danger'>";
																}
																
																echo "<td>" . $data['sekolah'] . "</td>
																<td>" . $data['tahun'] . "</td>
																<td>" . $data['deskripsi'] . "</td>
																<td class='text-center'>";
																	if($data["show"] == "1"){
																		echo "<a href='addeducation.php?edu=formal&action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-close'></i></a>";
																	}
																	else{
																		echo "<a href='addeducation.php?edu=formal&action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-open'></i></a>";
																	}
																echo"
																	<a href='addeducation.php?edu=formal&action=edit&id=" . $data['id'] . "'><i class='glyphicon glyphicon-pencil'></i></a>
																	<a href='addeducation.php?edu=formal&action=delete&id=" . $data['id'] . "'><i class='glyphicon glyphicon-remove'></i></a>
																</td>
																";
																if(count($formal) == 0){
																	echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div><td></tr>";
																}
															} 
														?>
													</tbody>
												</table>
											</div>
											<h3>Informal Education</h3>
											<hr>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Institution</th>
															<th>Year Finished</th>
															<th>Description</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($informal as $data) {
																if($data["show"] == "1"){
																	echo "<tr>";
																}
																else{
																	echo "<tr class='danger'>";
																}
																
																echo "<td>" . $data['sekolah'] . "</td>
																<td>" . $data['tahun'] . "</td>
																<td>" . $data['deskripsi'] . "</td>
																<td class='text-center'>";
																	if($data["show"] == "1"){
																		echo "<a href='addeducation.php?edu=informal&action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-close'></i></a>";
																	}
																	else{
																		echo "<a href='addeducation.php?edu=informal&action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-open'></i></a>";
																	}
																echo"
																	<a href='addeducation.php?edu=informal&action=edit&id=" . $data['id'] . "'><i class='glyphicon glyphicon-pencil'></i></a>
																	<a href='addeducation.php?edu=informal&action=delete&id=" . $data['id'] . "'><i class='glyphicon glyphicon-remove'></i></a>
																</td>
																";
															} 
															if(count($formal) == 0){
																echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div><td></tr>";
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
			</address>
			<span><img alt="" src="logo.png"><input type="file" accept="image/*"></span>
			

		</header>
		<article>
			
		</article>
		<aside>
			
		</aside
	</body>
</html>
	
	
<?php	
	//require_once( __DIR__.'/../footer.php');
?>