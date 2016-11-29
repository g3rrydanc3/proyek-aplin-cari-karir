<?php 
	require_once("header.php");
	
	if(isset($_POST["save"])){
		foreach($_POST as $key => $data){
			$data = Array("value" => $data);
			$db->where("name", $key);
			if ($db->update ('option', $data)){
				
			}
			else{
				$db->getLastError();
			}
		}
		echo "
				<script>
					swal({
						title: 'Success!',
						text: 'Data updated successfully!',
						type: 'success',
						closeOnConfirm: false
					},
					function(){
						window.location.href = window.location.href;
					});
				</script>
			";
	}
?>

		<div class="col-sm-9">
			<h1>Setting</h1>
			<form class="form-horizontal" method="post" action="setting.php">
				<?php foreach(getOption() as $key => $data){
					echo '
						<div class="form-group">
							<label class="control-label col-sm-2" for="'. $key .'">'. $key .'</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="'. $key .'" name="'. $key .'" placeholder="Enter '. $key .'" value="'. $data .'">
							</div>
						</div>
					';
				}
				?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="save" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>
