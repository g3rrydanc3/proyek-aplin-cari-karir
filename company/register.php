<?php
	define('Access', TRUE);
	require_once("header.php");
	require_once( __DIR__ . "/../pages/php-mailer/PHPMailerAutoload.php");
	require_once( __DIR__ . "/../pages/email.php");
	
	$errors = array();
	$success = "";
	
	if(!isset($_SESSION["current"])){
		$_SESSION["current"] = "";
	}
	else if(strlen($_SESSION["current"]) != 0){
		header("location:http://". getFolderUrl() ."index.php");
	}
	if(isset($_POST["register"])){
		if(isset($_POST["agree"])){
			$username = trim($_POST["username"]);
			$password = trim($_POST["password"]);
			$confirmPassword = trim($_POST["confirmPassword"]);
			$CompanyName = trim($_POST["CompanyName"]);
			$email = trim($_POST["email"]);
			$nama_cp = trim($_POST["nama_cp"]);
			$tel = trim($_POST["tel"]);
			$alamat = trim($_POST["alamat"]);
			$deskripsi = trim($_POST["deskripsi"]);
			if(strlen($username) < 4){
				array_push($errors, "Username minimum 4 character");
			}
			if(strlen($password) < 9){
				array_push($errors, "Password minimum 9 character");
			}
			if($password != $confirmPassword){
				array_push($errors, "Password not same");
			}
			if (!preg_match("/^[a-zA-Z ]*$/",$CompanyName) || empty($CompanyName)) {
				array_push($errors, "Company Name must letters and white space allowed");
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
				array_push($errors, "Email invalid");
			}
			if (!preg_match("/^[a-zA-Z ]*$/",$nama_cp) || empty($nama_cp)) {
				array_push($errors, "Contact Person Name must letters and white space allowed");
			}
			if (!preg_match('/^[0-9-\s]+$/D',$tel) || empty($tel)) {
				array_push($errors, "Telephone must number or "-" and white space allowed");
			}
			if (empty($alamat)) {
				array_push($errors, "Address cannot be empty");
			}
			if (empty($_FILES['logo'])) {
				array_push($errors, "Logo cannot be empty");
			}
			
			$ext = explode('.', basename($_FILES["logo"]['name']));
			$filename = $username . "." . array_pop($ext);
			$target = "../img/company/" . $filename;
			$imageFileType = pathinfo($target,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["logo"]["tmp_name"]);
			if($check === false) {
				array_push($errors, "Logo file is not an image.");
			}
			// Check file size
			if ($_FILES["logo"]["size"] > 5000000) {
				array_push($errors, "Logo file is too large.");
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				array_push($errors, "Logo file only JPG, JPEG, PNG & GIF files are allowed.");
			}
			
			if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $target)) {
				array_push($errors, "Sorry, there was an error uploading your file.");
			}
			if(count($errors) == 0){
				//$db->setTrace (true);
				$db->where ('username', $username);
				if($db->has('company')){
					array_push($errors, "Username already exist");
				}
				$db->where ('email', $email);
				if($db->has('company')){
					array_push($errors, "Email already registered");
				}
				if(count($errors) == 0){
					$data = Array (
						"username" => $username,
						"password" => password_hash($password, PASSWORD_DEFAULT),
						"nama" => $CompanyName,
						"email" => $email,
						"nama_cp" => $nama_cp,
						"tel" => $tel,
						"alamat" => $alamat,
						"deskripsi" => $deskripsi,
						"logo" => $filename,
						"activation_token" => sha1(mt_rand(10000,99999).time().$email),
						"sign_up_stamp" => date("Y-m-d H:i:s")
					);

					if($db->insert ('company', $data)){
						$db->where('username', $username);
						$data = $db->getOne('company');
						unset($_POST);
						$send = emailRegisterCompany($data);
						if($send == true){
							$success = '<div class="alert alert-success">
								<strong>Success!</strong> '.password_hash($password, PASSWORD_DEFAULT) . $password .'Registration Success. Check your email for account confirmation.
							</div>';
						}
						else{
							array_push($errors, "Registration Success, but email didn't send succesfully. Make sure you use legit email." . $send);
						}
					}
					else{
						array_push($errors, "Database fatal error" . $db->getLastError());
					}
				}
				//print_r ($db->trace);
			}
			
		}
		else{
			array_push($errors, "You must agree <a href='http://". getFolderUrl() . "contact.phptos.php'>Term of Service</a>");
		}
	}
	
	$javascript.='
		<script>
				$("#logo").fileinput({
					previewFileType: "image",
					browseClass: "btn btn-success",
					browseLabel: "Pick Logo",
					browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
					removeClass: "btn btn-danger",
					removeLabel: "Delete",
					removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
					showUpload: false,
					allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
				});
		</script>
	';
?>

	<div class="wrapper">
		<div class="container">
			<h1>Register Company Account</h1>
			<p class="text-muted"><a href="http://<?php echo getFolderUrl();?>register.php"><button type="button" class="btn btn-default btn-xs">Register Student Account</button></a> if you want to create a student account instead.</p>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-sm-2" for="username">Username <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="confirmPassword">Confirm Password <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter password again" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="CompanyName">Company Name <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="CompanyName" id="CompanyName" placeholder="Enter Company name" value="<?php if(isset($_POST['CompanyName'])){echo htmlentities($_POST['CompanyName']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Email <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="nama_cp">Contact Person Name <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nama_cp" id="nama_cp" placeholder="Enter contact person name" value="<?php if(isset($_POST['nama_cp'])){echo htmlentities($_POST['nama_cp']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="tel">Telephone <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tel" id="tel" placeholder="Enter telephone" value="<?php if(isset($_POST['tel'])){echo htmlentities($_POST['tel']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="alamat">Address <span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Enter address" value="<?php if(isset($_POST['alamat'])){echo htmlentities($_POST['alamat']);}?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="deskripsi">Description</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Enter description" value="<?php if(isset($_POST['deskripsi'])){echo htmlentities($_POST['deskripsi']);}?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="logo">Logo (jpg|jpeg|gif|png)<span class="glyphicon glyphicon-asterisk"></span></label>
					<div class="col-sm-10">
							<input id="logo" name="logo" type="file" class="file-loading" data-show-preview="false">
							<div id="errorBlock" class="help-block"></div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label><input type="checkbox" name="agree" required> Agree <a href='http://<?php echo getFolderUrl();?>tos.php'>Term of Service</a></label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary" name="register">Submit</button>
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