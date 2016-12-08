<?php
	define('Access', TRUE);
	require_once("header.php");
	$errors = array();
	if(isset($_POST["signin"])){
		
		$username = $_POST["inputUsername"];
		$password = $_POST["inputPassword"];
		$db->where('username', $username);
		$results = $db->getOne('user');
		if(empty($results)){
			array_push($errors, "Username doesn't exist");
		}
		else if(password_verify($password, $results['password'])){
			$db->where("name", "activation");
			$activation = $db->getOne("option");
			$activation = $activation["value"];
			
			if($activation == "1" && $results["active"] == "0"){
				array_push($errors, "Account haven't actived, Check your email.");
			}
			else if($results["lost_password_request"] != "0"){
				array_push($errors, "Account had requested reset password, Check your email.");
			}
			else{
				$_SESSION["current"] = $results['id'];
				$_SESSION["role"] = $results['role'];
				
				$data = Array ('last_sign_in_stamp' => date("Y-m-d H:i:s"));
				$db->where ('id', $_SESSION["current"]);
				$db->update ('user', $data);
				header("location:index.php");
			}
		}
		else{
			array_push($errors, "Wrong password");
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<form class="form-signin" method="post" action="http://<?php echo getFolderUrl();?>login.php">
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
				<a href="http://<?php echo getFolderUrl();?>passwordreset.php"><button class="btn btn-lg btn-danger btn-block">Forgot password?</button></a>
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
	require_once("footer.php");
?>