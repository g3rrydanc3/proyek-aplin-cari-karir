<?php
	if(isset($_POST["submit"])){
		$password = $_POST["password"];
		echo password_hash($password, PASSWORD_DEFAULT);
	}
?>
<form method="post" action="encrypt.php">
	<input type="text" name="password">
	<input type="submit" name="submit" value="Submit">
</form>