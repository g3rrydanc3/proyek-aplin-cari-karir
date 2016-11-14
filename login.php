<?php
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(isset($_POST["signin"])){
		$username = $_POST["inputUsername"];
		$password = $_POST["inputPassword"];
		$role = 1;
		$_SESSION["current"] = $username;
		$_SESSION["role"] = $role;
		header("location:index.php");
	}
?>
	<div class="wrapper">
		<div class="container">
			<form class="form-signin" method="post" action="login.php">
				<h2 class="form-signin-heading">Sign in</h2>
				<label for="inputUsername" class="sr-only">Username</label>
				<input type="text" id="inputUsername" class="form-control" placeholder="Username" name="inputUsername" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="inputPassword" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
			</form>

		</div>
	</div>
	
<?php
	require_once("pages/footer.php");
?>