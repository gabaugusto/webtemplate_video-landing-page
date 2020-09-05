<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
$name = $_REQUEST['name'] ;
$email = $_REQUEST['email'] ;
$message = $_REQUEST['msg'] ;

$messageComplete =  '===============<br/>';
$messageComplete .= 'Esta mensagem foi enviada pelo site MeuAcordo.com.br<br/>';
$messageComplete .= '===============<br/><br/>';
$messageComplete .= 'E-mail enviado por: ';
$messageComplete .= $name . ' <br/><br/>E-mail: ' . $email . '<br/><br/>Telefone: '. $phone .'<br/><br/>Mensagem: '. $message. '<br/><br/>';
$messageComplete .= "===============<br/>";
$messageComplete .= "Fim da mensagem<br/>";
$messageComplete .= "===============<br/><br/><br/>";
$messageComplete .= "<a href='http://www.MeuAcordo.com.br'>MeuAcordo.com.br</a>.";

require './phpmailer/PHPMailerAutoload.php';

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
$mail->Host = '[YOUR_HOST]';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587; //or 467 

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls'; //or ssl 

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "[YOUR_USERNAME]";

//Password to use for SMTP authentication
$mail->Password = "[YOUR_PASSWORD]";

//Set who the message is to be sent from
$mail->setFrom('[YOUR_USERNAME]', '[YOUR_NAME]');

//Set an alternative reply-to address
$mail->addReplyTo('[YOUR_ANOTHER_MAIL]', '[YOUR_NAME]');

//Set who the message is to be sent to
$mail->addAddress('[TO_EMAIL]', '[TO_NAME]');
$mail->AddCC('[TO_EMAIL_CC]', '[TO_NAME_CC]');

$mail->Name = $email;
$mail->From = $email;
$mail->Body = $message;

//Set the subject line
$mail->Subject = '[SUBJECT]';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($messageComplete);

//Replace the plain text body with one created manually//
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
