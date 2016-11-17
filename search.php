<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
?>
	<div class="wrapper">
		<div class="container">
			<h1>Profile</h1>
		</div>
	</div>
<?php
	require_once("pages/footer.php");
?>