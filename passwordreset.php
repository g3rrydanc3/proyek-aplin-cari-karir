<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	require_once("pages/php-mailer/PHPMailerAutoload.php");
	require_once("pages/email.php");
	
	$success="";

	if(strlen($_SESSION["current"]) != 0 || !isset($_GET["role"])){
		header("location:error.php");
	}
	if(isset($_POST["reset"])){
		$input = trim($_POST["input"]);
		$db->where("email", $input);
		$db->orWhere ("username", $input);
		if($_POST["role"] == "user"){
			$results = $db->get('user');
		}
		else{
			$results = $db->get('company');
		}
		if(count($results) == 1){
			$results = reset($results);
			$data = Array ("lost_password_request" => "1",
				"activation_token" => sha1(mt_rand(10000,99999).time().$results["email"]),
				"last_activation_request" => date("Y-m-d H:i:s")
			);
			
			$db->where("id", $results["id"]);
			if($db->update("user", $data)){
				//update array with new data
				$db->where("id", $results["id"]);
				if($_Post["role"] == "user"){
					$results = $db->getOne('user');
					$send = emailForgotPassword($results);
				}
				else{
					$results = $db->getOne('company');
					$send = emailForgotPasswordCompany($results);
				}
				
				if($send == true){
					$success = '<div class="alert alert-success">
							<strong>Success!</strong> Request reset password Success! Check your email to continue.
						</div>';
				}
				else{
					array_push($errors, "Password reset success! But email didn't send succesfully. Make sure you use legit email." . $send);
				}
			}
			else{
				array_push($errors, "Database user error." . $db->getLastError());
			}
		}
		else if(count($results) == 0){
			$success = '<div class="alert alert-success">
							<strong>Success!</strong> Request reset password success. Check your email to continue. (notfound)
						</div>';
		}
		else{
			array_push($errors, "Database error. Contact admin to reset password.");
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<h1>Reset Password</h1>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group">
					<label class="control-label col-sm-2" for="input">Username / Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="input" id="input" placeholder="Enter Username / email" required>
					</div>
				</div>
				<input type="hidden" name="role" value="<?php echo $_GET["role"];?>">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary" name="reset">Request reset password</button>
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