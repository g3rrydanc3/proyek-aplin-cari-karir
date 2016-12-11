<?php 
	require_once("header.php");
	
	$user = $db->get("company");
?>

		<div class="col-sm-9">
			<h1>Data</h1>
				<div class="table-responsive">
								
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($user as $data) {
								echo "<tr>";
								echo "<td>" . $data['id'] . "</td>
								<td>" . $data['username'] . "</td>
								<td>" . $data['email'] . "</td>
								<td>" . $data['nama'] . "</td>
								<td class='text-center'>";
								echo"
									<a href='dataedit_company.php?action=edit&id=" . $data['id'] . "'><i class='glyphicon glyphicon-pencil'></i></a>
								</td></tr>
								";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

</body>
</html>
