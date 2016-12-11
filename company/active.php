<?php
	define('Access', TRUE);
	require_once(__DIR__ . "header.php");
	
	$errors = [];
	
	if(strlen($_SESSION["current"]) != 0){
		header("location:error.php");
	}
	else if(!isset($_GET["active"]) || !isset($_GET["email"])){
		header("location:error.php");
	}
	else{
		$db->where('activation_token', $_GET["active"]);
		$db->where('email', $_GET["email"]);
		$result = $db->getOne('company');
		if($result["active"] == "1"){
			array_push($errors, "Account already activated.");
		}
		else if(empty($result)){
			header("location:error.php");
		}
		else{
			$db->where('id', $result["id"]);
			$data = Array("active" => "1");
			if (!$db->update ('company', $data)){
				header("location:error.php");
			}
		}
	}
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
					';
				}
				else{
					foreach($errors as $error){
						echo '<div class="alert alert-danger">
								<strong>Error!</strong> '. $error .'
							</div>
						';

					}
				}
				?>
				<a href="login.php"><button class="btn btn-primary">Click here to Login</button></a>
			</div>
		</div>
	</div>
<?php
	require_once(__DIR__ . "footer.php");
?>