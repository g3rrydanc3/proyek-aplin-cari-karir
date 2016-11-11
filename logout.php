<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	unset($_SESSION["current"]);
	unset($_SESSION["role"]);
?>
	<div class="container">
		Berhasil Logout!.
	</div>
<?php
	require_once("pages/footer.php");
	header("location:index.php");
?>