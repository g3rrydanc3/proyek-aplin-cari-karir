<?php
	define('Access', TRUE);
	require_once(__DIR__ . "/../header.php");
	$errors = array();
	if(isset($_POST["signin"])){
		$username = trim($_POST["inputUsername"]);
		$password = trim($_POST["inputPassword"]);
		$db->where('username', $username);
		$results = $db->getOne('company');
		if(empty($results)){
			array_push($errors, "Username doesn't exist");
		}
		else if(password_verify($password, $results['password'])){
			//check website option needs activation
			if(getOption("activation") == "1" && $results["active"] == "0"){
				array_push($errors, "Account haven't actived, Check your email.");
			}
			//check if the account having lost password
			else if($results["lost_password_request"] != "0"){
				array_push($errors, "Account had requested reset password, Check your email.");
			}
			else{
				$_SESSION["current"] = $results['id'];
				$_SESSION["role"] = "Company";
				
				$data = Array ('last_sign_in_stamp' => date("Y-m-d H:i:s"));
				$db->where ('id', $_SESSION["current"]);
				$db->update ('company', $data);
				header("location:http://". getFolderUrl() ."index.php");
			}
		}
		else{
			array_push($errors, "Wrong password");
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<h2 class="form-signin-heading">Sign in Company</h2>
				<p class="text-muted"><a href="http://<?php echo getFolderUrl();?>login.php"><button type="button" class="btn btn-default btn-xs">Login Student Account</button></a></p>
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
				<a href="http://<?php echo getFolderUrl();?>passwordreset.php?role=company"><button class="btn btn-lg btn-danger btn-block">Forgot password?</button></a>
				<?php
					foreach($errors as $error){
						echo "<br>";
						echo '<div class="alert alert-danger">
								<strong>Error!</strong> '. $error .'.
							</div>';
					}
				?>
			</form>
		</div>
	</div>
	
<?php
	require_once(__DIR__ . "/../footer.php");
?>