<?php 

Namespace Hcode;

use Rain\Tpl;

class Mailer{
  const Username = "gianfoeger@gmail.com";
 const Password ="Gikamui1!";
 const NAME_FROM = "code st";

private $mail;
  public function __construct($toAdddress,$toName,$subject,$tplName,$data = array())
  {
  	   $config = array(
                    "tpl_dir"       =>$_SERVER["DOCUMENT_ROOT"]."/views/email/",
                    "cache_dir"     =>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",
                    "debug"         => false 
        );

       Tpl::configure( $config );
       
       $this->tpl = new Tpl;
 
     foreach ($data as $key => $value) {
     	$this->tpl->assign($key,$value);
     }

     $html = $this->tpl->draw($tplName,true);
//require '../vendor/autoload.php';
//Create a new PHPMailer instance
$this->mail = new \PHPMailer;
//Tell PHPMailer to use SMTP
$this->mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$this->mail->SMTPDebug = 0;
//Set the hostname of the mail server
$this->mail->Host = 'smtp.gmail.com';
// use
// $this->mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$this->mail->Port = 587;



$this->mail->isSMTP();
$this->mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);




//Set the encryption system to use - ssl (deprecated) or tls
$this->mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$this->mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$this->mail->Username = Mailer::Username;
//Password to use for SMTP authentication
$this->mail->Password = Mailer::Password;
//Set who the message is to be sent from
$this->mail->setFrom(Mailer::Username, Mailer::NAME_FROM);
//Set the subject line
$this->mail->addAddress($toAdddress,$toName);
$this->mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$this->mail->msgHTML($html);
//Replace the plain text body with one created manually
$this->mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$this->mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors

}

public function send()
{

 return $this->mail->send();

}
}
?>