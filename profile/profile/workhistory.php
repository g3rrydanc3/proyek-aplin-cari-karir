<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	$db->where ("id", $_GET["id"]);
	$user = $db->getOne ("user");
	
	$db->where ("id", $user["role"]);
	$queryRole = $db->getOne ("role");
	$queryRole = $queryRole["name"];
	
	$db->where ("user_id", $_GET["id"]);
	$experience = $db->get ("pengalaman_kerja");
	
	if(count($user) == 0){
		header("location:error.php");
	}
?>
<div class="wrapper">
	<div class="container">
		<h1>Profile</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<?php require_once("sidebar.php");?>
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
										</tr>
									</thead>
									<tbody>
										<?php
											$count = 0;
											foreach ($experience as $data) {
												if($data["show"] == "1"){
													echo "<tr>";
													echo "<td>" . $data['nama_perusahaan'] . "</td>
													<td>" . $data['posisi'] . "</td>
													<td>" . $data['gaji'] . "</td>
													<td>" . $data['tgl_masuk'] . "</td>
													<td>" . $data['tgl_keluar'] . "</td>
													<td>" . $data['deskripsi'] . "</td>";
													$count++;
												}
											} 
											if($count == 0){
												echo "<tr><td colspan='7'><div class='text-muted text-center'>Still empty.</div><td></tr>";
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