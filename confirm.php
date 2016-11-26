<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(isset($_GET["confirm"])){
		
	}
?>
	<div class="wrapper">
		<div class="container">
			Confirm
		</div>
	</div>
<?php
	require_once("pages/footer.php");
?>