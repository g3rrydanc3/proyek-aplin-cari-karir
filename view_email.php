<?php
	define('Access', TRUE);
	require_once(__DIR__."/config.php");
	
	$errors = [];
	
	if(!isset($_GET["type"])){
		if($_GET["type"] == "register" || $_GET["type"] == "reset" || $_GET["registerCompany"]){
			if(!isset($_GET["name"]) || !isset($_GET["email"]) || !isset($_GET["key"])){
				header("location:error.php");
			}
		}
		else if($_GET["type"] == ){
			
		}
		else{
			header("location:error.php");
		}
	}
	else{
		header("location:error.php");
	}
	
	else{
		$type = $_GET["type"];
		$name = $_GET["name"];
		$email = $_GET["email"];
		$key = $_GET["key"];
		if($type == "register"){
			echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Comer</title>
</head>
<body style="margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;font-family:\'Lato\',\'Helvetica Neue\' ,Helvetica,Arial,sans-serif;font-weight: 700;">
	<table id="body-table" style="border-collapse: collapse; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0; padding-left: 0; padding-bottom: 0; padding-right: 0; padding-top: 0; background-color: #f8f8f8; height: 100% !important; width: 100% !important;" bgcolor="#f2f2f2">
		<tbody>
			<tr>
				<td align="center" style="border-collapse: collapse;">
					<p style="text-align: center; margin-right: 0; margin-top: 30px; margin-bottom: 30px; margin-left: 0;" align="center">
					<a href="http://'. getFolderUrl() .'" style="color:#59595b;text-decoration:none;">
						<h1>Job Comer</h1>
					</a>
					</p>
					<table style="border-collapse: collapse; margin-top: 0px; width: 600px; background-color: #FFFFFF;" bgcolor="#FFFFFF" width="600">
						<tbody>
							<tr>
								<td style="border-collapse: collapse; padding-right: 40px; padding-top: 20px; padding-bottom: 20px; padding-left: 40px;">
								<p  style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									Hello ,'. $name .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									To finish setting up your account, please click below:
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'active.php?active='. $key .'&email='. $email .'" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">CONFIRM EMAIL ADDRESS</a>
								</div>
								<table style="border-collapse: collapse; background-color: #1c4b77; margin-top: 20px !important;" bgcolor="#1c4b77" width="520">
									<tr>
										<td style="border-collapse: collapse; background-color: #f8f8f8; text-align: center;" bgcolor="#f8f8f8">
											<p align="center">
												<strong>HAVE QUESTIONS?</strong>
											</p>
											<p style="margin-bottom: 20px;font-size: 14px; text-align: center; margin-top: 0 !important;" align="center">
												Email us 
												<a href="mailto:jobcomer@gmail.com" style="color:#59595b;">jobcomer@gmail.com</a>
											</p>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div style="padding-top: 30px; padding-right: 20px; padding-bottom: 50px; padding-left: 20px;">
						<div>&#169; 2016 Job Comer</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>';
		}
		else if($type == "reset"){
			echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Comer</title>
</head>
<body style="margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;font-family:\'Lato\',\'Helvetica Neue\' ,Helvetica,Arial,sans-serif;font-weight: 700;">
	<table id="body-table" style="border-collapse: collapse; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0; padding-left: 0; padding-bottom: 0; padding-right: 0; padding-top: 0; background-color: #f8f8f8; height: 100% !important; width: 100% !important;" bgcolor="#f2f2f2">
		<tbody>
			<tr>
				<td align="center" style="border-collapse: collapse;">
					<p style="text-align: center; margin-right: 0; margin-top: 30px; margin-bottom: 30px; margin-left: 0;" align="center">
					<a href="http://'. getFolderUrl() .'" style="color:#59595b;text-decoration:none;">
						<h1>Job Comer</h1>
					</a>
					</p>
					<table style="border-collapse: collapse; margin-top: 0px; width: 600px; background-color: #FFFFFF;" bgcolor="#FFFFFF" width="600">
						<tbody>
							<tr>
								<td style="border-collapse: collapse; padding-right: 40px; padding-top: 20px; padding-bottom: 20px; padding-left: 40px;">
								<p  style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									Hello, '. $name .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									To reset password your account, please click below:
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'passwordchange.php?key='. $key .'&email='. $email .'" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">RESET PASSWORD</a>
								</div>
								<table style="border-collapse: collapse; background-color: #1c4b77; margin-top: 20px !important;" bgcolor="#1c4b77" width="520">
									<tr>
										<td style="border-collapse: collapse; background-color: #f8f8f8; text-align: center;" bgcolor="#f8f8f8">
											<p align="center">
												<strong>HAVE QUESTIONS?</strong>
											</p>
											<p style="margin-bottom: 20px;font-size: 14px; text-align: center; margin-top: 0 !important;" align="center">
												Email us 
												<a href="mailto:jobcomer@gmail.com" style="color:#59595b;">jobcomer@gmail.com</a>
											</p>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div style="padding-top: 30px; padding-right: 20px; padding-bottom: 50px; padding-left: 20px;">
						<div>&#169; 2016 Job Comer</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>';
		}
		else if($type == "registerCompany"){
			echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Comer</title>
</head>
<body style="margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;font-family:\'Lato\',\'Helvetica Neue\' ,Helvetica,Arial,sans-serif;font-weight: 700;">
	<table id="body-table" style="border-collapse: collapse; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0; padding-left: 0; padding-bottom: 0; padding-right: 0; padding-top: 0; background-color: #f8f8f8; height: 100% !important; width: 100% !important;" bgcolor="#f2f2f2">
		<tbody>
			<tr>
				<td align="center" style="border-collapse: collapse;">
					<p style="text-align: center; margin-right: 0; margin-top: 30px; margin-bottom: 30px; margin-left: 0;" align="center">
					<a href="http://'. getFolderUrl() .'" style="color:#59595b;text-decoration:none;">
						<h1>Job Comer</h1>
					</a>
					</p>
					<table style="border-collapse: collapse; margin-top: 0px; width: 600px; background-color: #FFFFFF;" bgcolor="#FFFFFF" width="600">
						<tbody>
							<tr>
								<td style="border-collapse: collapse; padding-right: 40px; padding-top: 20px; padding-bottom: 20px; padding-left: 40px;">
								<p  style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									Hello, '. $name .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									To finish setting up your company account, please click below:
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'company/active.php?active='. $key .'&email='. $email .'" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">CONFIRM EMAIL ADDRESS</a>
								</div>
								<table style="border-collapse: collapse; background-color: #1c4b77; margin-top: 20px !important;" bgcolor="#1c4b77" width="520">
									<tr>
										<td style="border-collapse: collapse; background-color: #f8f8f8; text-align: center;" bgcolor="#f8f8f8">
											<p align="center">
												<strong>HAVE QUESTIONS?</strong>
											</p>
											<p style="margin-bottom: 20px;font-size: 14px; text-align: center; margin-top: 0 !important;" align="center">
												Email us 
												<a href="mailto:jobcomer@gmail.com" style="color:#59595b;">jobcomer@gmail.com</a>
											</p>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div style="padding-top: 30px; padding-right: 20px; padding-bottom: 50px; padding-left: 20px;">
						<div>&#169; 2016 Job Comer</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>';
		}
		else if($_GET["type"] == "message"){
			echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Comer</title>
</head>
<body style="margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;font-family:\'Lato\',\'Helvetica Neue\' ,Helvetica,Arial,sans-serif;font-weight: 700;">
	<table id="body-table" style="border-collapse: collapse; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0; padding-left: 0; padding-bottom: 0; padding-right: 0; padding-top: 0; background-color: #f8f8f8; height: 100% !important; width: 100% !important;" bgcolor="#f2f2f2">
		<tbody>
			<tr>
				<td align="center" style="border-collapse: collapse;">
					<p style="text-align: center; margin-right: 0; margin-top: 30px; margin-bottom: 30px; margin-left: 0;" align="center">
					<a href="http://'. getFolderUrl() .'" style="color:#59595b;text-decoration:none;">
						<h1>Job Comer</h1>
					</a>
					</p>
					<table style="border-collapse: collapse; margin-top: 0px; width: 600px; background-color: #FFFFFF;" bgcolor="#FFFFFF" width="600">
						<tbody>
							<tr>
								<td style="border-collapse: collapse; padding-right: 40px; padding-top: 20px; padding-bottom: 20px; padding-left: 40px;">
								<p  style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									Hello ,'. $name .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									Someone has been send you a message, to read please click here :
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'login.php?redir=profile/message_inbox" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">CHECK MESSAGE</a>
								</div>
								<table style="border-collapse: collapse; background-color: #1c4b77; margin-top: 20px !important;" bgcolor="#1c4b77" width="520">
									<tr>
										<td style="border-collapse: collapse; background-color: #f8f8f8; text-align: center;" bgcolor="#f8f8f8">
											<p align="center">
												<strong>HAVE QUESTIONS?</strong>
											</p>
											<p style="margin-bottom: 20px;font-size: 14px; text-align: center; margin-top: 0 !important;" align="center">
												Email us 
												<a href="mailto:jobcomer@gmail.com" style="color:#59595b;">jobcomer@gmail.com</a>
											</p>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div style="padding-top: 30px; padding-right: 20px; padding-bottom: 50px; padding-left: 20px;">
						<div>&#169; 2016 Job Comer</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>';
		}
	}
?>