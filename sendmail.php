<?php
$formname    = $_POST['name'];
$formemail   = $_POST['email'];
$formphone   = $_POST['phone'];
$formmessage = $_POST['message']; 
 
 
 
require_once 'PHPMailer-master/PHPMailerAutoload.php';
require_once 'creds/creds.php';
                 




$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = 'laleyeolamide@yahoo.com';
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 0;
$mail->Host       = EMAILHOST;
$mail->Port       = EMAILPORT;
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth   = true;
$mail->Username   = EMAILUSERNAME;
$mail->Password   = EMAILUSERPASS;
$mail->addReplyTo(EMAILUSERNAME, EMAILREPLYTO);
$mail->setFrom(EMAILUSERNAME, EMAILREPLYTO);
$mail->addAddress("laleyeolamide@yahoo.com", "Laleye Olamide");
$mail->Subject  = "YOU HAVE A MESSAGE FROM: ".$formname.".";
$body = ' Sender Name: '.$formname.'<br>
          Sender Phone: '.$formphone.'<br>
          Sender Email: '.$formemail.'<br>          

          The message reads ....<br>. '.$formmessage;
$mail->WordWrap = 78;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
 
try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
//if (count($results_messages) > 0) {
//  echo "<h2>Run results</h2>\n";
//  echo "<ul>\n";
//foreach ($results_messages as $result) {
//  echo "<li>$result</li>\n";
//}
//echo "</ul>\n";
//}
//  
//                        
                        
                        

                 

?>