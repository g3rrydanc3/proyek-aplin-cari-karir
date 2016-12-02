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
			$firstName = trim($_POST["firstName"]);
			$lastName = trim($_POST["lastName"]);
			$dob = trim($_POST["dob"]);
			$gender = trim($_POST["gender"]);
			$role = trim($_POST["role"]);
			if(strlen($username) < 4){
				array_push($errors, "Username minimum 3 character");
			}
			if(strlen($password) < 9){
				array_push($errors, "Password minimum 8 character");
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
				array_push($errors, "Email invalid");
			}
			if (!preg_match("/^[a-zA-Z ]*$/",$firstName) || empty($firstName)) {
				array_push($errors, "First Name must letters and white space allowed");
			}
			if (!preg_match("/^[a-zA-Z ]*$/",$lastName) || empty($lastName)) {
				array_push($errors, "Last Name must letters and white space allowed");
			}
			if($gender != "male" && $gender != "female"){
				array_push($errors, "Gender not allowed");
			}
			if(empty($dob)){
				array_push($errors, "Date of birth invalid");
			}
			$date = explode('-', $dob);
			if(!checkdate($date[1], $date[0], $date[2])){
				array_push($errors, "Date of birth invalid");
			}
			if($password != $confirmPassword){
				array_push($errors, "Password not same");
			}
			if($role != "Student" && $role != "Company"){
				array_push($errors, "Role invalid");
			}
			
			if(count($errors) == 0){
				$db->where ('username', $username);
				if($db->has('user')){
					array_push($errors, "Username already exist");
				}
				$db->where ('email', $email);
				if($db->has('user')){
					array_push($errors, "Email already registered");
				}
				if(count($errors) == 0){
					$role1 = 1;
					if($role == "Company"){
						$role1 = 2;
					}
					$data = Array ("username" => $username,
							   "password" => password_hash($password, PASSWORD_DEFAULT),
							   "email" => $email,
							   "name" => $firstName . " " . $lastName,
							   "gender" => $gender,
							   "birthdate" => $date[2] . "-" . $date[1] . "-" . $date[0],
							   "role" => $role1,
							   "activation_token" => sha1(mt_rand(10000,99999).time().$email),
							   "sign_up_stamp" => date("Y-m-d H:i:s")
					);
					
					$insert = $db->insert ('user', $data);
					
					$db->where('username', $username);
					$temp = $db->getOne('user');
					
					$data1 = Array ("user_id" => $temp["id"]);
					$insert = $db->insert ('user_setting_shown', $data1);
					
					$view_email = md5(uniqid($temp["id"], true));
					$data2 = Array("user_id" => $temp["id"],
						"email" => $view_email,
						"type" => "register"
					);
					$insertEmail = $db->insert ('email', $data2);
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
		<form class="form-horizontal" method="post" action="http://<?php echo getFolderUrl();?>register.php">
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
				<label class="control-label col-sm-2" for="firstName">First Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter first name" value="<?php if(isset($_POST['firstName'])){echo htmlentities($_POST['firstName']);}?>" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="lastName">Last Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter last name" value="<?php if(isset($_POST['lastName'])){echo htmlentities($_POST['lastName']);}?>" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="gender">Gender</label>
				<div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="gender" value="male" <?php if(isset($_POST['gender'])){if($_POST["gender"] == "male"){echo "checked";}}else{echo "checked";}?>>Male
					</label>
					<label class="radio-inline">
						<input type="radio" name="gender" value="female"<?php if(isset($_POST['gender'])){if($_POST["gender"] == "female"){echo "checked";}}?>>Female
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="dob">Date of Birth</label>
				<div class="col-sm-10">
					<input id="dob" name="dob" class="form-control" placeholder="DD-MM-YYYY" type="date" value="<?php if(isset($_POST['dob'])){echo htmlentities($_POST['dob']);}?>" required>
				</div>
			</div>
			 <div class="form-group">
				<label class="control-label col-sm-2" for="role">Role</label>
				<div class="col-sm-10">
					<select class="form-control" id="role" name="role">
						<option selected>Student</option>
						<option>Company</option>
					</select>
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