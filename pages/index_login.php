<?php
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
?>
<div class="wrapper">
	<div class="container">
		<h1>Home</h1>
		<?php
			if(is_numeric($_SESSION["role"])){
				echo "halo student.";
			}
			else{
				echo "<a href='job/add_job.php'><button type='button' class='btn btn-primary'>Add Job</button></a>";
			}
		
		?>
	</div>
</div>
