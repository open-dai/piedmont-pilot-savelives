<?php

error_reporting(E_ALL);
//error_reporting(E_STRICT);

date_default_timezone_set('Europe/Rome');

require_once('PHPMailer/class.phpmailer.php');
require_once ( 'phpwsdl/class.phpwsdl.php' );


class SaveusService {

	/**
	 * This method send a mail
	 *
	 * @param string $id
	 * @return string 
	 */
	public function getProcess($id){
		try {
//			$dbh = new PDO("pgsql:dbname=saveus;host=zf2-tutorial.localhost;port=35432;user=user;password=user" );
			$dbh = new PDO("pgsql:dbname=saveus;host=localhost;port=35432","user","user" );
		} catch (Exception $e) {
			//  $dbh->rollBack();
			echo "Failed: " . $e->getMessage();
		}

		$query = "select process from saveusview.user_processes where id=$id";
//		$query = "select process from saveusview.user_processes";
		$sth = $dbh->query($query);
//		print_r($sth);
		foreach($sth as $row) {
		$proc = new SimpleXMLElement($row['process']);
			return new SoapVar('<return>'.$row['process'].'</return>',XSD_ANYXML,null,null,'return');
			return $proc->asXML();
			return $row['process'];
		}
	
	}
	
	/**
	 * This method store an accident
	 *
	 * @param string $time
	 * @param string $longitude
	 * @param string $latitude
	 * @param string $onbehalf
	 * @return string 
	 */
	public function setAccident($time, $longitude, $latitude, $onbehalf){
		try {
//			$dbh = new PDO("pgsql:dbname=saveus;host=zf2-tutorial.localhost;port=35432;user=user;password=user" );
			$dbh = new PDO("pgsql:dbname=saveus;host=localhost;port=35432","user","user" );
		} catch (Exception $e) {
			//  $dbh->rollBack();
			error_log( $e->getMessage(),3,'error.log' );
			echo "Failed: " . $e->getMessage();
		}
		$date = DateTime::createFromFormat('d-m-Y H:i:s', $time);
		$mdate = $date->format('Y-m-d H:i:s');
		error_log( $mdate."\n",3,'error.log' );
		$query = "insert into saveusview.accident (saveusview.accident.time, longitude, latitude) values ('$mdate', $longitude, $latitude)";
		error_log( $query."\n",3,'error.log' );
		$sth = $dbh->query($query);
		if(!$sth){
			error_log( 'error in the query execution'."\n",3,'error.log' );
		}
	}
	
	/**
	 * This method send a mail
	 *
	 * @param string $message
	 * @param string $address
	 * @return string 
	 */
	public function sendMail($message, $address){
		// these will have to be a class variable
		$template = 'contents.html';
		//$host = "mailfarm.csi.it";
		//$sender = "Luca Gioppo";
		$host = "194.116.110.17";
		$sender = "saveus";
		//$sendermail = 'luca.gioppo@csi.it';
		$sendermail = 'saveus@cloudlabcsi.eu';
		$subject = "Mail from SaveUs system";
		error_log( $message."\n",3,'error.log' );
		// operation
		$mail             = new PHPMailer();

		$body             = file_get_contents($template);
		$body= $message;

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = $host; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only

		$mail->SMTPAuth = "true";
		$mail->Username = "saveus@cloudlabcsi.eu";
		$mail->Password =  '1!Saveus';
		$mail->SetFrom($sendermail, $sender);
		$mail->AddReplyTo($sendermail,$sender);
		$mail->Subject    = $subject;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($body);

		$mail->AddAddress($address, "");
		error_log( $address."\n",3,'error.log' );
		if(!$mail->Send()) {
		error_log( $mail->ErrorInfo."\n",3,'error.log' );
		// This will have to go to log
		  return "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  return "Message sent!";
		}
	}

}

$serv = new SaveusService();
echo $serv->sendMail('test','luca.gioppo@gmail.com');
//print_r($serv->getProcess(1));

/*
$hdr = file_get_contents("php://input");
if (strpos($hdr,'<s:Header>')===false) {
    $hdr = null;
} else {
    $hdr = explode('<s:Header>',$hdr);
    $hdr = explode('</s:Header>',$hdr[1]);
    $hdr = $hdr[0];
}
$srv = new SoapServer('saveusservice.wsdl', array('soap_version' => SOAP_1_2,'cache_wsdl' => WSDL_CACHE_NONE));
$srv->setClass("SaveusService",$hdr);
//$srv->addFunction(array('sendMail'));
$srv->handle();
*/

/*

$soap=PhpWsdl::CreateInstance();								// Don't start the SOAP server right now

// Disable caching for demonstration
ini_set('soap.wsdl_cache_enabled',0);	// Disable caching in PHP
PhpWsdl::$CacheTime=0;					// Disable caching in PhpWsdl
PhpWsdl::$Debugging=true;					// Disable caching in PhpWsdl
PhpWsdl::$DebugFile='debug.txt';					// Disable caching in PhpWsdl
PhpWsdl::$DebugBackTrace=false;					// Disable caching in PhpWsdl
$soap->SoapServerOptions['soap_version']=SOAP_1_2;
$soap->Debug('test Gioppo');
$soap->Debug(print_r($_REQUEST,true));
// Run the SOAP server
if($soap->IsWsdlRequested())
	$soap->Optimize=false;				// Don't optimize WSDL to send it human readable to the browser
$soap->RunServer(						// Finally, run the server and enable the proxy
	null,
	Array(								// Use an array for this parameter to enable the proxy:
		'SaveusService',						// The name of the target class that will handle SOAP requests
		new SaveusService()					// An instance of the target class that will handle SOAP requests
	)
);
*/



?>
