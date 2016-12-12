<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
	
	$db->where("company_id", $_SESSION["current"]);
	$lowongan = $db->get("lowongan");
	
?>
	<div class="wrapper">
		<div class="container">
			<h1>My Jobs</h1>
			
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Title</th>
							<th>Position</th>
							<th>Requirement</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(empty($lowongan)){
								echo "<tr><td colspan='5'><p class='text-muted text-center'>No job created yet.</p></td><tr>";
							}
							else{
								foreach($lowongan as $key => $data){
									echo "<tr>";
									echo "<td>" . $data['judul'] . "</td>
									<td>" . $data['posisi'] . "</td>
									<td>" . $data['syarat'] . "</td>
									<td>";
									if(strlen($data['deskripsi']) >20){echo substr($data['deskripsi'], 0, 20) . "...";}
									else{echo $data['deskripsi'];}
									echo "</td>
									<td class='text-center'>";
									echo"
										<a href='action.php?action=edit&id=" . $data['id'] . "'><i class='glyphicon glyphicon-pencil'></i></a>
									</td></tr>
									";
								}
							}
						?>
					</tbody>
				</table>
				<a href='add_job.php'><button type='button' class='btn btn-primary btn-block'>Add Job</button></a>
			</div>
		</div>
	</div>
<?php
	require_once(__DIR__ . "/../footer.php");
?>