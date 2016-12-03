<?php
	define('Access', TRUE);
	require_once("header.php");
	require_once("pages/php-mailer/PHPMailerAutoload.php");
	require_once("pages/email.php");
	
	$errors = array();
	$success = "";
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	else if(strlen($_SESSION["current"]) != 0){
		header("location:index.php");
	}
	if(isset($_POST["register"])){
		if(isset($_POST["agree"])){
			$username = trim($_POST["username"]);
			$password = trim($_POST["password"]);
			$confirmPassword = trim($_POST["confirmPassword"]);
			$email = trim($_POST["email"]);
			$CompanyName = trim($_POST["CompanyName"]);
			if(strlen($username) < 4){
				array_push($errors, "Username minimum 4 character");
			}
			if(strlen($password) < 9){
				array_push($errors, "Password minimum 9 character");
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
				array_push($errors, "Email invalid");
			}
			if (!preg_match("/^[a-zA-Z ]*$/",$CompanyName) || empty($CompanyName)) {
				array_push($errors, "Company Name must letters and white space allowed");
			}
			if($password != $confirmPassword){
				array_push($errors, "Password not same");
			}
			if(count($errors) == 0){
				$db->where ('username', $username);
				if($db->has('company')){
					array_push($errors, "Username already exist");
				}
				$db->where ('email', $email);
				if($db->has('company')){
					array_push($errors, "Email already registered");
				}
				if(count($errors) == 0){
					$data = Array ("username" => $username,
							   "password" => password_hash($password, PASSWORD_DEFAULT),
							   "email" => $email,
							   "name" => $CompanyName,
							   "activation_token" => sha1(mt_rand(10000,99999).time().$email),
							   "sign_up_stamp" => date("Y-m-d H:i:s")
					);
					
					$insert = $db->insert ('company', $data);
					
					$db->where('username', $username);
					$temp = $db->getOne('company');
					
					if($insert){
						unset($_POST);
						$send = emailRegister($data, $view_email);
						if($send == true){
							$success = '<div class="alert alert-success">
								<strong>Success!</strong> Registration Success. Check your email for account confirmation.
							</div>';
						}
						else{
							array_push($errors, "Registration Success, but email didn't send succesfully. Make sure you use legit email.");
							array_push($errors, $send);
						}
					}
					else{
						array_push($errors, "Database fatal error");
						array_push($errors, $db->getLastError());
					}
				}
			}

		}
		else{
			array_push($errors, "You must agree <a href='tos.php'>Term of Service</a>");
		}
	}
?>

	<div class="wrapper">
		<div class="container">
		<h1>Register</h1>
		<form class="form-horizontal" method="post" action="http://<?php echo getFolderUrl();?>registerCompany.php">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Username</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username']);}?>" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="password">Password</label>
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
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);}?>" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="CompanyName">Company Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="CompanyName" id="CompanyName" placeholder="Enter Company name" value="<?php if(isset($_POST['CompanyName'])){echo htmlentities($_POST['CompanyName']);}?>" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label><input type="checkbox" name="agree" required> Agree <a href='tos.php'>Term of Service</a></label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default" name="register">Submit</button>
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