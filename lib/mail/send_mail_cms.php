<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - SMTP test</title>
</head>
<body>
<?php

//ini_set('sendmail_from ', "hodieu@gmail.com"); 
//ini_set('auth_password', "@#Hongocdieu$"); 

// load the variables form address bar
$subject = 'tests tetn';
$summary ='test chu thich';
$s_image='test hinh';
$message=$subject.$summary.$s_image;
$from = 'admin@singa.com.vn';
$fullname = 'Singa.com.vn';
$address = 'hodieu@gmail.com';
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mail.singa.com.vn";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
//$mail->Username = "test@singa.com.vn";
$mail->Username = "singacomvn";
//Password to use for SMTP authentication
//$mail->Password = "123456";
$mail->Password = "ewY2tWfD";
//Set who the message is to be sent from
$mail->setFrom($from, $fullname );
//Set an alternative reply-to address
//$mail->addReplyTo('hodieu@gmail.com', $fullname );
//Set who the message is to be sent to
$mail->addAddress($address, 'Administrator');
//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message, dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = $message;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.gif');

//send the message, check for errors

if (!$mail->send()) {
	$thongbao=$mail->ErrorInfo;
	//$thongbao = "Không thể gởi email của bạn vì có một vài lỗi từ phía máy chủ.";
} else {
	$thongbao = "<b>Đã gởi thành công thư liên hệ của bạn</b>";
	
}
echo $thongbao;
	//$OK = SendMail($from,TO_EMAIL,$subject,$message,$fullname);
	
	//mail("hongocdieu@etc.net.vn", $subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "From: $from");
	// delete the cookie so it cannot sent again by refreshing this page

$_SESSION['msg']=$thongbao;
session_write_close();
//printf("<script>location.href='".$_SERVER['HTTP_REFERER']."'</script>");

?>
</body>
</html>
