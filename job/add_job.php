<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	
	$success = null;
	
	if(isset($_POST["add"])){
		$judul = trim($_POST["judul"]);
		$posisi = trim($_POST["posisi"]);
		$syarat = trim($_POST["syarat"]);
		$deskripsi = trim($_POST["deskripsi"]);
		$tgl_batas = trim($_POST["tgl_batas"]);
		
		if(empty($judul) || empty($posisi) || empty($syarat) || empty($tgl_batas)){
			array_push($errors, "All input must be filled");
		}
		if(!validateDate($tgl_batas, "d-m-Y H:i:s")){
			array_push($errors, "Job Closed invalid");
		}
		if(date_format(date_create_from_format('d-m-Y H:i:s', $tgl_batas), "Y-m-d H:i:s") < date("Y-m-d H:i:s")){
			array_push($errors, "Job Closed must be greater than now");
		}
		
		if(empty($errors)){
			$data = Array("company_id" => $_SESSION["current"],
				"judul" => $judul,
				"posisi" => $posisi,
				"syarat" => $syarat,
				"deskripsi" => $deskripsi,
				"tgl_upload" => date("Y-m-d H:i:s"),
				"tgl_batas" => date_format(date_create_from_format('d-m-Y H:i:s', $tgl_batas), "Y-m-d H:i:s")
			);
			$id = $db->insert("lowongan", $data);
			if($id){
				unset($_POST);
				$success = '<div class="alert alert-success">
						<strong>Success!</strong> Add job Success. To see your created job <a href="index.php"><button type="button" class="btn btn-default btn-xs">Click here</button></a>.
					</div>';
			}
			else{
				array_push($errors, "Database lowongan error." . $db->getLastError());
			}
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<h1>Add Job</h1>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group">
					<label class="control-label col-sm-2" for="judul">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="judul" name="judul" placeholder="Enter title" value="<?php if(isset($_POST['judul'])){echo htmlentities($_POST['judul']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="posisi">Position</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="posisi" name="posisi" placeholder="Enter position" value="<?php if(isset($_POST['posisi'])){echo htmlentities($_POST['posisi']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="syarat">Requirement</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="syarat" name="syarat" placeholder="Enter requirement" value="<?php if(isset($_POST['syarat'])){echo htmlentities($_POST['syarat']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="deskripsi">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter description"><?php if(isset($_POST['deskripsi'])){echo htmlentities($_POST['deskripsi']);}?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="tgl_batas">Job Closed</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="tgl_batas" name="tgl_batas" placeholder="DD-MM-YYYY HH:MM:SS" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary" name="add">Submit</button>
					</div>
				</div>
			</form>
			<?php
			foreach($errors as $error){
				echo '<div class="alert alert-danger">
						<strong>Error!</strong> '. $error .'.
					</div>';
			}
			echo $success;
		?>
		</div>
	</div>
<?php
	require_once(__DIR__ . "/../footer.php");
?>
<script>
$(\'#tgl_batas\').daterangepicker({
	"singleDatePicker": true,
	"showDropdowns": true,
	"timePicker": true,
	"autoApply": true,
	"linkedCalendars": false,
	"autoUpdateInput": true,
	"showCustomRangeLabel": false,
	"timePicker24Hour":true,
	locale: {
		format: "DD-MM-YYYY hh:mm:ss"
	}
});</script>