<html>
<head>
<title>PHPMailer - SMTP basic test with no authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Europe/Rome');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded


class MailService {

	/**
	 *
	 * @param string $message
	 * @param string $address
	 */
	public function sendMail($message,$address){
		// these will have to be a class variable
		$template = 'contents.html';
		$host = "mailfarm.csi.it";
		$sender = "Luca Gioppo";
		$sendermail = 'luca.gioppo@csi.it';
		$subject = "Mail from SaveUs system";
		
		// operation
		$mail             = new PHPMailer();

		$body             = file_get_contents($template);
		$body             = preg_replace('/[\]/','',$body);
		$body= $message;

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = $host; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only

		$mail->SetFrom($sendermail, $sender);

		$mail->AddReplyTo($sendermail,$sender);

		$mail->Subject    = $subject;

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($body);

		$address = "gioppoluca@libero.it";
		$mail->AddAddress($address, "");

//		$mail->AddAttachment("images/phpmailer.gif");      // attachment
//		$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

		if(!$mail->Send()) {
		// This will have to go to log
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Message sent!";
		}
		
	}
}

$senderm = new MailService();
$senderm->sendMail("prova","gioppoluca@libero.it");

?>

</body>
</html>
