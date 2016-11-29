<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	if(isset($_POST["add"])){
		$nama_perusahaan=$_POST["nama_perusahaan"];
		$gaji=$_POST["gaji"];
		$tgl_masuk=$_POST["tgl_masuk"];
		$tgl_keluar=$_POST["tgl_keluar"];
		$posisi=$_POST["posisi"];
		$gaji=$_POST["gaji"];
		$deskripsi=$_POST["deskripsi"];
		
		$data = Array (
			'user_id' => $_SESSION["current"],
			'nama_perusahaan' => $nama_perusahaan,
			'gaji' => $gaji,
			'tgl_masuk' => $tgl_masuk,
			'tgl_keluar' => $tgl_keluar,
			'posisi' => $posisi,
			'gaji' => $gaji,
			'deskripsi' => $deskripsi
		);
		if($db->insert ('pengalaman_kerja', $data)){
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
		else{
			header("location:error.php");
		}
	}
	else if(isset($_POST["edit"])){
		$nama_perusahaan=$_POST["nama_perusahaan"];
		$gaji=$_POST["gaji"];
		$tgl_masuk=$_POST["tgl_masuk"];
		$tgl_keluar=$_POST["tgl_keluar"];
		$posisi=$_POST["posisi"];
		$gaji=$_POST["gaji"];
		$deskripsi=$_POST["deskripsi"];
		
		$data = Array (
			'nama_perusahaan' => $nama_perusahaan,
			'gaji' => $gaji,
			'tgl_masuk' => $tgl_masuk,
			'tgl_keluar' => $tgl_keluar,
			'posisi' => $posisi,
			'gaji' => $gaji,
			'deskripsi' => $deskripsi
		);
		$db->where ('id', $_POST["id"]);
		if ($db->update ('pengalaman_kerja', $data)){
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
	
	$db->where ("id", $_SESSION["current"]);
	$user = $db->getOne ("user");
	
	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	$db->where ("user_id", $_SESSION["current"]);
	$experience = $db->get ("pengalaman_kerja");
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
							<h2>Work History</h2>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Company Name</th>
											<th>Position in Company</th>
											<th>Salary</th>
											<th>Date Employment</th>
											<th>Date Out of Work</th>
											<th>Description</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($experience as $data) {
												if($data["show"] == "1"){
													echo "<tr>";
												}
												else{
													echo "<tr class='danger'>";
												}
												
												echo "<td>" . $data['nama_perusahaan'] . "</td>
												<td>" . $data['posisi'] . "</td>
												<td>" . $data['gaji'] . "</td>
												<td>" . $data['tgl_masuk'] . "</td>
												<td>" . $data['tgl_keluar'] . "</td>
												<td>" . $data['deskripsi'] . "</td>
												<td class='text-center'>";
													if($data["show"] == "1"){
														echo "<a href='addworkhistory.php?action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-close'></i></a>";
													}
													else{
														echo "<a href='addworkhistory.php?action=show&id=" . $data['id'] . "'><i class='glyphicon glyphicon-eye-open'></i></a>";
													}
												echo"
													<a href='addworkhistory.php?action=edit&id=" . $data['id'] . "'><i class='glyphicon glyphicon-pencil'></i></a>
													<a href='addworkhistory.php?action=delete&id=" . $data['id'] . "'><i class='glyphicon glyphicon-remove'></i></a>
												</td>
												";
											} 
											if(count($experience) == 0){
												echo "<tr><td colspan='7'><div class='text-muted text-center'>Still empty.</div><td></tr>";
											}
										?>
									</tbody>
								</table>
							</div>
							<a href="addworkhistory.php?action=add"><button class="btn btn-primary">Add</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>