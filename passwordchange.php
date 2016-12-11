<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	
	$username = "";
	$success="";
	$mode = "";
	
	if(strlen($_SESSION["current"]) != 0){
		if(isset($_GET["key"])){
			header("location:error.php");
		}
		else{
			$db->where ("id", $_SESSION["current"]);
			$username = $db->getOne ("user")["username"];
			$mode = "Change";
		}
	}
	else{
		if(isset($_GET["key"])){
			$db->where("activation_token", $_GET["key"]);
			$db->where("lost_password_request", "1");
			$db->where("email", $_GET["email"]);
			$results = $db->getOne('user');
			if(empty($results)){
				header("location:error.php");
			}
			else{
				$mode = "Forgot";
			}
		}
		else if(isset($_POST["Forgot"])){}
		else{
			header("location:error.php");
		}
		
	}
	
	if(isset($_POST["Change"])){
		$oldPassword = trim($_POST["oldPassword"]);
		$password = trim($_POST["password"]);
		$confirmPassword = trim($_POST["confirmPassword"]);
		$db->where ("id", $_SESSION["current"]);
		$pwdlama = null;
		if(is_numeric($_SESSION["role"])){
			$pwdlama = $db->getOne ("user")["password"];
		}
		else{
			$pwdlama = $db->getOne ("company")["password"];
		}
		
		if(password_verify($oldPassword, $pwdlama)){
			if(strlen($password) < 9){
				array_push($errors, "Password minimum 8 character");
			}
			else if($password != $confirmPassword){
				array_push($errors, "Password not same");
			}
			if(count($errors) == 0){
				$data = Array ("password" => password_hash($password, PASSWORD_DEFAULT));
				$db->where ('id', $_SESSION["current"]);
				if(is_numeric($_SESSION["role"])){
					if($db->update('user', $data)){
						$success = '<div class="alert alert-success">
									<strong>Success!</strong> Change password success.
								</div>';
					}
				}
				else{
					if($db->update('company', $data)){
						$success = '<div class="alert alert-success">
									<strong>Success!</strong> Change password success.
								</div>';
					}
				}
				else{
					array_push($errors, "Database error! Contact admin to change password.");
				}
			}
		}
		else{
			array_push($errors, "Old password incorrect!");
		}
	}
	else if(isset($_POST["Forgot"])){
		$password = trim($_POST["password"]);
		$confirmPassword = trim($_POST["confirmPassword"]);
		
		$db->where("activation_token", $_POST["key"]);
		$db->where("lost_password_request", "1");
		$db->where("email", $_POST["email"]);
		$results = $db->getOne('user');
		
		if(empty($results)){
			//header("location:error.php");
		}
		else{
			if(strlen($password) < 9){
				array_push($errors, "Password minimum 8 character");
			}
			else if($password != $confirmPassword){
				array_push($errors, "Password not same");
			}
			if(count($errors) == 0){
				$data = Array ("password" => password_hash($password, PASSWORD_DEFAULT),
					"lost_password_request" => "0"
				);
				$db->where ('id', $results["id"]);
				if($db->update('user', $data)){
					$success = '<div class="alert alert-success">
								<strong>Success!</strong> Change password success. <a href="http://'. getFolderUrl() .'login.php">Click here to Login</a>
							</div>';
				}
				else{
					array_push($errors, "Database error! Contact admin to change password.");
				}
			}
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<h1>Change Password</h1>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<?php if($mode == "Change"){
					echo '<div class="form-group">
							<label class="control-label col-sm-2" for="username">Username</label>
							<div class="col-sm-10">
								<input type="text" disabled class="form-control" name="username" id="username" placeholder="Enter username" value=" ' . $username . '">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="oldPassword">Old Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Enter password" required>
							</div>
						</div>';
				}
				?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">New Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="confirmPassword">Confirm Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter password again" required>
					</div>
				</div>
				<?php
					if($mode == "Forgot"){
						echo "<input type='hidden' name='key' value='". $_GET["key"] ."'>";
						echo "<input type='hidden' name='email' value='". $_GET["email"] ."'>";
					}
				?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary" name="<?php echo $mode;?>">Change Password</button>
					</div>
				</div>
			</form>
			<?php
				foreach($errors as $error){
					echo '<div class="alert alert-danger">
							<strong>Error!</strong> '. $error .'.
						</div>';
				}
				echo $success;
			?>
		</div>
	</div>
<?php
	require_once("footer.php");
?>