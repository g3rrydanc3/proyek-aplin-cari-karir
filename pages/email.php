<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}

	$host = 'smtp.gmail.com';
	$port = 587;
	$username = "jobcomer@gmail.com";
	$password = "iloveistts";
	$name = "Job Comer";
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer;

	//Tell PHPMailer to use SMTP
	$mail->isSMTP();

	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;

	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

	//Set the hostname of the mail server
	$mail->Host = $host;
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = $port;

	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = $username;

	//Password to use for SMTP authentication
	$mail->Password = $password;
	//Set who the message is to be sent from
	$mail->setFrom($username, $name);

	//Set an alternative reply-to address
	$mail->addReplyTo($username, $name);
	
	function emailRegister($data, $view_email){
		global $mail;
		$msg = '
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
					<a href="http://'. getFolderUrl() .'view_email.php?type=register&email='. $view_email .'" style="color:#59595b;text-decoration:none;"><p>Click here if you can\'t see this email properly.</p></a>
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
									Hello, '. $data["name"] .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									To finish setting up your account, please click below:
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'active?active='. $data["activation_token"] .'" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">CONFIRM EMAIL ADDRESS</a>
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
		//$mail->addAttachment('images/phpmailer_mini.png');
		//$mail->AltBody = '<a href='. $link .'>Click here if you can\'t see this email</a>';
		$mail->Subject = "Job Comer - Account Confirmation";	
		$mail->msgHTML($msg);
		$mail->addAddress($data["email"], $data["name"]);
		
		$mail->SMTPOptions = array(
		'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		//send the message, check for errors
		if (!$mail->send()) {
			return $mail->ErrorInfo;
		} else {
			return true;
		}
	}
	
		function emailRegisterCompany($data, $view_email){
		global $mail;
		$msg = '
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
					<a href="http://'. getFolderUrl() .'view_email_company.php?type=register&email='. $view_email .'" style="color:#59595b;text-decoration:none;"><p>Click here if you can\'t see this email properly.</p></a>
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
									Hello, '. $data["name"] .'
								</p>
								<p style="color: #59595b; margin-bottom: 20px; text-align: center;" align="center">
									To finish setting up your company account, please click below:
								</p>
								<div style="text-align: center; margin-top: 30px !important; margin-bottom: 50px !important;" align="center">
									<a href="http://'. getFolderUrl() .'active?active='. $data["activation_token"] .'" style="color:#f1f1f1;background-color:#000000;border-radius:25px;display:inline-block;font-size:14px;letter-spacing:1px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:300px;">CONFIRM EMAIL ADDRESS</a>
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
		//$mail->addAttachment('images/phpmailer_mini.png');
		//$mail->AltBody = '<a href='. $link .'>Click here if you can\'t see this email</a>';
		$mail->Subject = "Job Comer - Company Account Confirmation";	
		$mail->msgHTML($msg);
		$mail->addAddress($data["email"], $data["name"]);
		
		$mail->SMTPOptions = array(
		'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		//send the message, check for errors
		if (!$mail->send()) {
			return $mail->ErrorInfo;
		} else {
			return true;
		}
	}
?>
