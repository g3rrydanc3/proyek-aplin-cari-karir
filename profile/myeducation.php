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
<div class="wrapper">
	<div class="container">
		<h1>My Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("mysidebar.php");?>
				</div>
			</div>
			<div class="col-sm-9">
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
							<a href="addeducation.php?add=formal"><button class="btn btn-primary">Add</button></a>
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
												if(count($formal) == 0){
													echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div><td></tr>";
												}
											} 
										?>
									</tbody>
								</table>
							</div>
							<a href="addeducation.php?add=informal"><button class="btn btn-primary">Add</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>