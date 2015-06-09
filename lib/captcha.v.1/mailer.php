<?php
@session_start();
include("../../func.php");
include("../../config.php");
include("smtp.php");
include("Email.php");

ini_set('SMTP', SMTP_SERVER); 
ini_set('smtp_port', SMTP_PORT); 

//ini_set('sendmail_from ', "hodieu@gmail.com"); 
//ini_set('auth_password', "@#Hongocdieu$"); 

// load the variables form address bar
$subject = $_REQUEST["txtSubject"];
$message = $_REQUEST["txtContent"];
$from = $_REQUEST["txtEmail"];
$fullname = $_REQUEST["txtName"];
$address = $_REQUEST["txtAddress"];
$verif_box = $_REQUEST["txtCode"];

// remove the backslashes that normally appears when entering " or '
$message = "Họ và tên:".$fullname."<br/>Địa chỉ: ".$address."</br>".$message."<br/>"; 
$subject = $subject; 
$from = $from; 
$thongbao="";
// check to see if verificaton code was correct
if(md5($verif_box).'a4xn' == $_COOKIE['tntcon']){
	// if verification code was correct send the message and show this page
	// $mail=new CI_Email();
	// $config['protocol'] = 'sendmail';
	// $config['smtp_port'] = SMTP_PORT;
	// $config['smtp_host'] = SMTP_SERVER;
	// $config['mailpath'] = '/usr/sbin/sendmail';
	
	// $mail->from('hongocdieu@etc.net.vn', 'Your Name');
	// $mail->to('hodieu@gmail.com'); 
	// $mail->subject('Email Test');
	// $mail->message('Testing the email class.');	
	// $mail->send();


	$OK = gui_mail("<".$from.">",TO_EMAIL,$subject,$message);
	//$OK = SendMail($from,TO_EMAIL,$subject,$message,$fullname);
	if ($OK == true) $thongbao = "<b>Đã gởi thành công thư liên hệ của bạn</b>";
	else $thongbao = "Không thể gởi email của bạn vì có một vài lỗi từ phía máy chủ.";
	//mail("hongocdieu@etc.net.vn", $subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "From: $from");
	// delete the cookie so it cannot sent again by refreshing this page
	setcookie('tntcon','');	
	$_SESSION['msg']=$thongbao;
	session_write_close();
	header("Location:".$_SERVER['HTTP_REFERER']);
} else {
	// if verification code was incorrect then return to contact page and show error
	$_SESSION['msg']="Sai mã bảo vệ\n";
	session_write_close();
	//echo $_COOKIE['wrong_code'];
	printf("<script>location.href='".$_SERVER['HTTP_REFERER']."'</script>");
	//header("Location:".$_SERVER['HTTP_REFERER']);
	//header("Location:".$_SERVER['HTTP_REFERER']."?wrong_code=true");
	//exit;
}

?>
