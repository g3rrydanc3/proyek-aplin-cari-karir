<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}

	require '../PHPMailerAutoload.php';
	
	class Email{
		
		private static $mail;
		private $host = 'smtp.gmail.com';
		private $port = 587;
		private $username = "jobcomer@gmail.com";
		private $password = "iloveistts";
		private $name = "Job Comer";
		
		public function __construct() {
			//Create a new PHPMailer instance
			$mail = new PHPMailer;

			//Tell PHPMailer to use SMTP
			$mail->isSMTP();

			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;

			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';

			//Set the hostname of the mail server
			$mail->Host = $this->$host;
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6

			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;

			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';

			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;

			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = $this->$username;

			//Password to use for SMTP authentication
			$mail->Password = $this->$password;
			//Set who the message is to be sent from
			$mail->setFrom($this->$username, $this->$name);

			//Set an alternative reply-to address
			$mail->addReplyTo($this->$username, $this->$name);

			
		}
		
		public function setSendTo($sendtoEmail, $sendtoName){
			//Set who the message is to be sent to
			$mail->addAddress($sendtoEmail, $sendtoName);
		}
		
		public function setSubject($subject){
			//Set the subject line
			$mail->Subject = $subject;
		}
		
		public function setMsg($msg, $alt){
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($msg);
			
			$mail->AltBody = '<a href='. $alt .'>Click here if you can\'t see this email</a>';
		}
		
		public function addAttachment(){
			//Attach an image file
			$mail->addAttachment('images/phpmailer_mini.png');
		}
		
		public function send(){
			//send the message, check for errors
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				echo "Message sent!";
			}
		}
	}
	
	function emailRegister($data){
		
	}
?>