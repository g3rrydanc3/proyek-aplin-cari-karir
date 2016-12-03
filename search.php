<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
	<div class="wrapper">
		<div class="container">
			<h1>Profile</h1>
		</div>
	</div>
<?php
	require_once("footer.php");
?>
<head>
	<link rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.css">
	<script src="js/jquery.js"></script>
	<script src="jquery-ui-1.11.4/jquery-ui.js"></script>  
	<script>
		function cari(){
			var arrKata = [
			  "[Job]" + $("#q").val(),
			  "[Company]" + $("#q").val(),
			  "[User]" + $("#q").val()
			];
			$("#q").autocomplete({
				source: arrKata
			});
		}
	</script>
</head>