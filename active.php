<?php
	define('Access', TRUE);
	require_once(__DIR__."/config.php");
	
	$errors = [];
	
	if(strlen($_SESSION["current"]) != 0){
		header("location:error.php");
	}
	else if(!isset($_GET["active"]) || empty($_GET["active"])){
		header("location:error.php");
	}
	else{
		$db->where('activation_token', $_GET["active"]);
		$result = $db->getOne('user');
		if($result["active"] == "1"){
			array_push($errors, "Account already activated.");
		}
		else if(empty($result)){
			header("location:error.php");
		}
		else{
			$db->where('id', $result["id"]);
			$data = Array("active" => "1");
			if (!$db->update ('user', $data)){
				header("location:error.php");
			}
		}
	}
	require_once("header.php");
?>
	<div class="wrapper">
		<div class="container">
			<h1>Account Activation</h1>
			<div class="text-center">
				<?php
				if(empty($errors)){
					echo '<div class="alert alert-success">
							<strong>Success!</strong> Account successfully activated!.
						</div>
						<a href="login.php"><button class="btn btn-primary">Click here to Login</button></a>
					';
				}
				else{
					foreach($errors as $error){
						echo '<div class="alert alert-danger">
								<strong>Error!</strong> '. $error .'.
							</div>
							<a href="index.php"><button class="btn btn-primary">Click here to Home</button></a>
						';

					}
				}
				?>
				
			</div>
		</div>
	</div>
<?php
	require_once("footer.php");
?>