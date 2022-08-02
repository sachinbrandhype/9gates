<?php

require_once 'admin_library.php';

require_once 'phpmailer/class.phpmailer.php';

$mail = new PHPMailer(true); 
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
$mobile =$_REQUEST['mobile'];
$email =$_REQUEST['email'];
$topic =$_REQUEST['topic'];
$document =$_REQUEST['document'];
$subject =$_REQUEST['subject'];
$date =$_REQUEST['date'];
$reference_style =$_REQUEST['reference_style'];
$paper_length =$_REQUEST['paper_length'];
$academic =$_REQUEST['academic'];
$academic_option =$_REQUEST['academic_option'];
$msg =$_REQUEST['msg'];


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
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $mobile . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email-Id</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Topic</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $topic . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Document</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $document . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Subject</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $subject . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Date</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $date . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Reference Style</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $reference_style . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Paper Length</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $paper_length . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Academic</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $academic . PHP_EOL . "</td> </tr>";

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Academic Option</td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $academic_option . PHP_EOL . "</td> </tr>";

if ($_FILES ['file_1'] ['tmp_name'] != '') {
			$file_name = $_FILES ['file_1'] ['name'];
			$temp_name = $_FILES ['file_1'] ['tmp_name'];
			$file_parts = pathinfo ( $file_name );
			$file_1 = trim ( $file_parts ['filename'] ) . "." . $file_parts ['extension'];
			if ((strtolower ( $file_parts ['extension'] ) == 'docx') || (strtolower ( $file_parts ['extension'] ) == 'xlsx') || (strtolower ( $file_parts ['extension'] ) == 'xls') || (strtolower ( $file_parts ['extension'] ) == 'txt')  || (strtolower ( $file_parts ['extension'] ) == 'pdf') ||(strtolower ( $file_parts ['extension'] ) == 'doc')) {
				move_uploaded_file ( $temp_name, "document/$file_1" );
			

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>File </td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . "&nbsp;<a href='".$siteUrl."document/" . $file_1."'>Download</a>" . PHP_EOL . "</td> </tr>";
}
}
if ($_FILES ['file_2'] ['tmp_name'] != '') {
			$file_name = $_FILES ['file_2'] ['name'];
			$temp_name = $_FILES ['file_2'] ['tmp_name'];
			$file_parts = pathinfo ( $file_name );
			$file_2 = trim ( $file_parts ['filename'] ) . "." . $file_parts ['extension'];
			if ((strtolower ( $file_parts ['extension'] ) == 'docx') || (strtolower ( $file_parts ['extension'] ) == 'xlsx') || (strtolower ( $file_parts ['extension'] ) == 'xls') || (strtolower ( $file_parts ['extension'] ) == 'txt')  || (strtolower ( $file_parts ['extension'] ) == 'pdf') ||(strtolower ( $file_parts ['extension'] ) == 'doc')) {
				move_uploaded_file ( $temp_name, "document/$file_2" );
			

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>File </td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . "&nbsp;<a href='".$siteUrl."document/" . $file_2."'>Download</a>". PHP_EOL . "</td> </tr>";
}
}

if ($_FILES ['file_3'] ['tmp_name'] != '') {
			$file_name = $_FILES ['file_3'] ['name'];
			$temp_name = $_FILES ['file_3'] ['tmp_name'];
			$file_parts = pathinfo ( $file_name );
			echo $file_3 = trim ( $file_parts ['filename'] ) . "." . $file_parts ['extension'];
			if ((strtolower ( $file_parts ['extension'] ) == 'docx') || (strtolower ( $file_parts ['extension'] ) == 'xlsx') || (strtolower ( $file_parts ['extension'] ) == 'xls') || (strtolower ( $file_parts ['extension'] ) == 'txt')  || (strtolower ( $file_parts ['extension'] ) == 'pdf') ||(strtolower ( $file_parts ['extension'] ) == 'doc')) {
				move_uploaded_file ( $temp_name, "document/$file_3" );
			

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>File </td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . "&nbsp;<a href='".$siteUrl."document/" . $file_3."'>Download</a>" . PHP_EOL . "</td> </tr>";
}
}
if ($_FILES ['file_4'] ['tmp_name'] != '') {
			$file_name = $_FILES ['file_4'] ['name'];
			$temp_name = $_FILES ['file_4'] ['tmp_name'];
			$file_parts = pathinfo ( $file_name );
			$file_4 = trim ( $file_parts ['filename'] ) . "." . $file_parts ['extension'];
			if ((strtolower ( $file_parts ['extension'] ) == 'docx') || (strtolower ( $file_parts ['extension'] ) == 'xlsx') || (strtolower ( $file_parts ['extension'] ) == 'xls') || (strtolower ( $file_parts ['extension'] ) == 'txt')  || (strtolower ( $file_parts ['extension'] ) == 'pdf') ||(strtolower ( $file_parts ['extension'] ) == 'doc')) {
				move_uploaded_file ( $temp_name, "document/$file_4" );
			

$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>File </td>
<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . "&nbsp;<a href='".$siteUrl."document/" . $file_4."'>Download</a>" . PHP_EOL . "</td> </tr>";
}
}
$message .= "<tr>
 <td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Description</td>
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
  $mail->Subject = 'Order Enquiry';
  $mail->AltBody = ''; 
  $mail->MsgHTML($message);
  $mail->Send();
  echo "done";
} catch (phpmailerException $e) {
 echo "fail";
} catch (Exception $e) {
 echo "fail";
}
?>