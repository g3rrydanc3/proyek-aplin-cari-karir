<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
	<div class="wrapper">
		<div class="container">
			<h2>Inline form</h2>
			<p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
			<form class="form-inline">
				<div class="form-group">
					<input type="text" class="form-control" id="keywords" placeholder="Keywords">
				</div>
				<div class="form-group">
					<select class="form-control" id="location">
						<option value="" disabled selected>Select a location</option>
						<option value="hurr">Durr</option>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" id="Specification">
						<option value="" disabled selected>Select a Specification</option>
						<option value="hurr">Durr</option>
					</select>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>
<?php
	require_once("footer.php");
?>