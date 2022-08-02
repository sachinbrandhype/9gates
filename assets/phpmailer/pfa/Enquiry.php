<?php

require_once 'admin_library.php';



require_once 'phpmailer/class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
$ip = $_SERVER['REMOTE_ADDR'];
$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

$ipAddress=$ipdat->geoplugin_request;
$ipCity=$ipdat->geoplugin_city;
$ipState=$ipdat->geoplugin_regionName;
$ipcountry=$ipdat->geoplugin_countryName;

$emailTo='contact@plagiarismfreeassignment.com';
  $nameTo='Plagiarism Free Assignment';
  $emailFrom=$_REQUEST ['email'];
  $nameFrom=$_REQUEST ['name'];

$name =$_REQUEST['name'];
$phone =$_REQUEST['phone'];
$email =$_REQUEST['email'];
$msg =$_REQUEST['massege'];


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
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Name</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $name . PHP_EOL . "</td> </tr>";
	
$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Mobile No</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $phone . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email-Id</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Message</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $msg . PHP_EOL . "</td> </tr>";



$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>City</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $ipCity . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>State</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $ipState . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Country</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $ipcountry . PHP_EOL . "</td> </tr>";
$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>IP</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $ipAddress . PHP_EOL . "</td> </tr>";
		$message .= "</table></div>";
		$message .= "</body></html>";
$mail->AddAddress($emailTo, $nameTo);
  $mail->SetFrom($emailFrom, $nameFrom);
  $mail->AddReplyTo($emailFrom, $nameFrom);
  $mail->Subject = 'Contact Enquiry';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($message);
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "send";
} catch (phpmailerException $e) {
 echo "fail";
} catch (Exception $e) {
 echo "fail";
}
	
?>