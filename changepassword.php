<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
	
	$header = "";
	$username = "";
	$success="";
	
	if(strlen($_SESSION["current"]) != 0){
		if(isset($_GET["key"])){
			header("location:error.php");
		}
		else{
			$header ="Change Password";
		}
	}
	else{
		if(isset($_GET["key"])){
			$header = "Forgot Password";
		}
		else{
			header("location:error.php");
		}
		
	}
	
	if(isset($_POST["change"])){
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$confirmPassword = trim($_POST["confirmPassword"]);
		if(strlen($username) < 4){
			array_push($errors, "Username minimum 3 character");
		}
		if(strlen($password) < 9){
			array_push($errors, "Password minimum 8 character");
		}
		if($password != $confirmPassword){
			array_push($errors, "Password not same");
		}
	}
?>
	<div class="wrapper">
		<div class="container">
			<h1><?php echo $header;?></h1>
			<form class="form-horizontal" method="post" action="http://<?php echo getFolderUrl();?>changepassword.php">
				<div class="form-group">
					<label class="control-label col-sm-2" for="username">Username</label>
					<div class="col-sm-10">
						<input type="text" disabled class="form-control" name="username" id="username" placeholder="Enter username" value="<?php $username;?>" required>
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
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default" name="change">Submit</button>
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