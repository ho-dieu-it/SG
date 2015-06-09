<?php
	$LegoPHP	=	"_CORE";
	include	$LegoPHP."/index.php";	
	$host = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$csdl = "singacomvn_db";
	
	/*13-8-2013	Author: Dieu*/
	/**HOST INFORMATION**/
	$ROOT_DOC = "/singa";
	$ROOT_DIR  = $_SERVER['DOCUMENT_ROOT'].$ROOT_DOC;	
	$PORT="";
	$SERVER_PORT=$_SERVER['SERVER_PORT'];
	$HOST_NAME='http://'.$_SERVER['HTTP_HOST'].$ROOT_DOC;
	$liveSite =  $HOST_NAME;
	// =====================
	define(TO_EMAIL,"congbinh@singa.com.vn");
	define(SMTP_SERVER,"imap.singa.com.vn");
	define(SMTP_PORT,25);// smtp_host: smtp.mail.yahoo.com smtp_port: 25
?>