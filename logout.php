<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	unset($_SESSION["current"]);
	unset($_SESSION["role"]);
?>
	<div class="container">
		Berhasil Logout!.
	</div>
<?php
	header("location:http://" . getFolderUrl() . "index.php");
	require_once("footer.php");
	
?>