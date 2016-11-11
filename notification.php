<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
?>
	<div class="container">
		Notification
	</div>
<?php
	require_once("pages/footer.php");
?>