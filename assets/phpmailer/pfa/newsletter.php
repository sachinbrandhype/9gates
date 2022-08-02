<?php

require_once 'admin_library.php';



require_once 'phpmailer/class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {


$emailTo='contact@plagiarismfreeassignment.com';
  $nameTo='Plagiarism Free Assignment';
  $emailFrom=$_REQUEST ['email'];
  $nameFrom='New Letter Email';

$email =$_REQUEST['email'];



$message = "<html><body >";
		$message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
		<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
		<tr>
		<td colspan='2'>
		<table width='100%' cellpadding='0' cellspacing='0' border='0'>
		<tr>
		<td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;background: #000;'><img src='" . $siteUrl . "images/logo.png' style='margin:auto;
		max-height: 67px !important;'>
		</td></tr></table></td></tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email-Id</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email . PHP_EOL . "</td> </tr>";


		$message .= "</table></div>";
		$message .= "</body></html>";
$mail->AddAddress($emailTo, $nameTo);
  $mail->SetFrom($emailFrom, $nameFrom);
  $mail->AddReplyTo($emailFrom, $nameFrom);
  $mail->Subject = 'Contact Enquiry';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($message);

  $mail->Send();
  echo "send";
} catch (phpmailerException $e) {
 echo "fail";
} catch (Exception $e) {
 echo "fail";
}
	
?>