<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
?>

<div class="wrapper">
	<div class="container text-center">
		<h1>Oops!</h1>
		<h2>404 Not Found</h2>
		<div class="error-details">
			Sorry, an error has occured, Requested page not found!
		</div>
		<div class="error-actions">
			<a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>Take Me Home </a>
		</div>
	</div>
</div>

<?php
	require_once("pages/footer.php");
?>