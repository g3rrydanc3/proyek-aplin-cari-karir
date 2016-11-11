<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
	<div class="container">
		<h1>Home</h1>
	</div>

<?php
	require_once("footer.php");
?>