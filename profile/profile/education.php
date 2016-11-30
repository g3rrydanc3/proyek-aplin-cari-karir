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
	$informal = $db->get ("informal");
	
	$db->where ("user_id", $_GET["id"]);
	$formal = $db->get ("formal");
	
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
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 0;
											foreach ($formal as $data) {
												if($data["show"] == "1"){
													echo "<tr>";
													echo "<td>" . $data['sekolah'] . "</td>
													<td>" . $data['tahun'] . "</td>
													<td>" . $data['deskripsi'] . "</td>";
													echo "</tr>";
													$count++;
												}
											}
											if($count == 0){
												echo "<tr><td colspan='3'><div class='text-muted text-center'>Still empty.</div><td></tr>";
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
										</tr>
									</thead>
									<tbody>
										<?php
											$count = 0;
											foreach ($informal as $data) {
												if($data["show"] == "1"){
													echo "<tr>";
													echo "<td>" . $data['sekolah'] . "</td>
													<td>" . $data['tahun'] . "</td>
													<td>" . $data['deskripsi'] . "</td>";
													echo "</tr>";
													$count++;
												}
											} 
											if($count == 0){
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