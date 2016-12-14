<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	if (isset($_POST['collect'])){
		$keywords = $_POST['keywords'];
		$location = $_POST['location'];
		if(!empty($keywords) && $location != ""){
			$query1 = $db->rawQuery('SELECT * from pekerjaan where nama like "%'. $keywords . '%" and lokasi = "'.$location.'"');
		}
		print_r($query1);
	}
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<div class="wrapper">
		<div class="container">
			<form class="form-inline" method = "post">
				<div class="form-group">
					<input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords" style="width:400px;">
				</div>
				<div class="form-group">
					<select class="form-control" id="location" name = "location" style="width:400px;">
						<option value="" disabled selected>Select a location</option>
						<option value="Jakarta">&nbsp;&nbsp;&nbsp;Jakarta</option>
						<option value="Surabaya">&nbsp;&nbsp;&nbsp;Surabaya</option>
						<option value="Medan">&nbsp;&nbsp;&nbsp;Medan</option>
						<option value="Bandung">&nbsp;&nbsp;&nbsp;Bandung</option>
						<option value="Bekasi">&nbsp;&nbsp;&nbsp;Bekasi</option>
						<option value="Depok">&nbsp;&nbsp;&nbsp;Depok</option>
						<option value="Semarang">&nbsp;&nbsp;&nbsp;Semarang</option>
						<option value="Palembang">&nbsp;&nbsp;&nbsp;Palembang</option>
						<option value="Makassar">&nbsp;&nbsp;&nbsp;Makassar</option>
						<option value="Tangerang Selatan">&nbsp;&nbsp;&nbsp;Tangerang Selatan</option>
						<option value="Bogor">&nbsp;&nbsp;&nbsp;Bogor</option>
						<option value="Batam">&nbsp;&nbsp;&nbsp;Batam</option>
						<option value="Pekanbaru">&nbsp;&nbsp;&nbsp;Pekanbaru</option>
						<option value="Denpasar">&nbsp;&nbsp;&nbsp;Denpasar</option>
					</select>
				</div>
				<button type="submit" class="btn btn-default" name = "collect" style="width:300px; border-radius: 5px; border: 2px solid #006600; background: #009900;">Submit</button>
			</form>
		</div>
		<div id = "container">
			<h2>Job</h2><hr>
			<?php
				if(empty($query1)){
					
				}
				else{
					echo '<div class="row">';
					foreach($query1 as $data){
						echo $data['nama'];
					}
					echo '</div>';
				}
			?>	
		</div>
	</div>
<?php
	require_once("footer.php");
?>