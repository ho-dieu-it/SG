<?php
function get_user($id, $value) {
	global $db;
	
	$r = $db->select ( "tgp_user", "id = '" . $id . "'" );
	while ( $row = $db->fetch ( $r ) )
		return $row [$value];
}
function get_bien($id) {
	global $db;

	$r = $db->select ( "tgp_bien", "ten = '" . $id . "'" );
	while ( $row = $db->fetch ( $r ) )
		return $row ["gia_tri"];
}
function kt_user_dung($txt_username) {
	
	return (! ereg ( "(^[a-z]+([a-z\_0-9\-]*))$", $txt_username ));
}
function kt_email_dung($txt_email) {
	return (! ereg ( "[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txt_email ));
}
function show_order($name, $sum, $pos, $width, $style = 1) {
	?>
<select name="<?php echo $name?>" dir="rtl" size="1" class="inputbox" style="width:<?php echo $width?>;<?php echo $style==1?"font-weight:bold;color:red;":""?>">
<?php
	for($i = 1; $i <= $sum; $i ++) {
		echo "<option value=" . $i;
		if ($pos == $i)
			echo " selected ";
		echo ">" . $i . "</option>";
	}
	?>
</select>
<?php
}
// admin_load
function admin_load($thong_bao, $url) {
	?>
<center>
	<b><font size="2"><?php echo $thong_bao?></font></b> <br />
	<img vspace="3" src="images/83.gif" /> <br>Xin đợi vài giây hoặc bấm <b><a
		href="<?php echo $url?>">vào đây</a></b> để tiếp tục...
</center>
<head>
<meta http-equiv="Refresh" content="1; URL=<?php echo $url?>">
</head>
<?php
	die ();
}
// resize hình ảnh bất kỳ
function img_resize($src, $dis, $par) {
	require_once ('../lib/phpthumb/phpthumb.class.php');
	$phpThumb = new phpThumb ();
	$phpThumb->src = $src;
	$r = explode ( "&", $par );
	for($i = 0; $i <= count ( $r ); $i ++) {
		if ($r [$i] != "") {
			$q = explode ( "=", $r [$i] );
			if ($q [0] == 'h')
				$phpThumb->h = $q [1];
			if ($q [0] == 'w')
				$phpThumb->w = $q [1];
		}
	}
	$phpThumb->q = 100;
	$phpThumb->config_output_format = 'jpeg';
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail ()) {
		$phpThumb->RenderToFile ( $dis );
	} else {
	}
}
function get_email_from_string($str_mail) {
	if (empty ( $str_mail ))
		return false;
	$arr_temp = explode ( ';', $str_mail );
	return $arr_temp;
}
function send_mail($obj_mail = array()) {
	
	// send mail
	$success = false;
	$from = $obj_mail ['from'];
	$to = $obj_mail ['to'];
	$title = $obj_mail ['title'];
	$summary = $obj_mail ['summary'];
	$s_image = $obj_mail ['s_image'];
	$link = $obj_mail ['link'];
	$fullname=$obj_mail['fullname'];
	// Create a new PHPMailer instance
	$mail = new PHPMailer ();
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP ();
	// Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	// $mail->SMTPDebug = 2;
	// Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	// Set the hostname of the mail server
	$mail->Host = "mail.singa.com.vn";
	// Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 25;
	// Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	$mail->Username = "singacomvn";
	// Password to use for SMTP authentication
	$mail->Password = "ewY2tWfD";
	// Set who the message is to be sent from
	$mail->setFrom ($from, $fullname );
	// Set an alternative reply-to address
	// $mail->addReplyTo('hodieu@gmail.com', $fullname );
	// Set who the message is to be sent to
	for($i = 0; $i < count ( $to ); $i ++) {
		$mail->addAddress ( $to [$i], $to [$i] );
	}
	
	// Set the subject lines
	$mail->Subject = $title;
	$header_html = file_get_contents ( '../lib/mail/template/header.html' );
	$footer_html = file_get_contents ( '../lib/mail/template/footer.html' );
	$body_html = "<div style='margin-bottom: 20px' class=\"itemnews\">
		  <img src=" . $s_image . " style='width: 100px;height: 90px;float: left; display: block;margin-right: 10px;border: 3px solid #fff;' class=\"img-itemnews\"/>
			<div style=\"height: 100px;overflow: hidden;\" class=\"text-itemnews\">
			  <h2><a href=" . $link . ">" . $title . "</a></h2>
			  <p>" . $summary . "</p>
			</div>
		  </div>";
	$message_html = $header_html . $body_html . $footer_html;
	// Read an HTML message body from an external file, convert referenced images to embedded,
	// convert HTML into a basic plain-text alternative body
	$mail->msgHTML ( $message_html, dirname ( __FILE__ ) );
	// Replace the plain text body with one created manually
	$mail->AltBody = $title;
	// Attach an image file
	// $mail->addAttachment('images/phpmailer_mini.gif');
	
	// send the message, check for errors
	
	if (! $mail->send ()) {
		$thongbao = 'Xảy ra lỗi: ' . $mail->ErrorInfo . "</br> Không thể gởi email của bạn.";
	} else {
		$success = true;
		$thongbao = "<b>Đã gởi email thành công.</b>";
	}
	// $OK = SendMail($from,TO_EMAIL,$subject,$message,$fullname);
	
	// mail("hongocdieu@etc.net.vn", $subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "From: $from");
	// delete the cookie so it cannot sent again by refreshing this page
	
	$_SESSION ['msg'] = $thongbao;
	session_write_close ();
	// printf("<script>location.href='".$_SERVER['HTTP_REFERER']."'</script>");
	
	return array (
			'success' => $success,
			'msg' => $thongbao 
	);
}
?>