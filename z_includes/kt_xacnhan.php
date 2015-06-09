<?php
session_start();
@error_reporting(1);
@set_time_limit(0);
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
if(!function_exists("json_encode")){
	function json_encode($a=false){
		if(is_null($a)) return 'null';
		if($a === false) return 'false';
		if($a === true) return 'true';
		if(is_scalar($a)){
			if(is_float($a)) return floatval(str_replace(",", ".", strval($a)));
			if(is_string($a)){
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			} else return $a;
		}
		$isList = true;
		for($i=0, reset($a); $i<count($a); $i++, next($a)){
			if(key($a) !== $i){
				$isList = false;
				break;
			}
		}
		$result = array();
		if($isList){
			foreach($a as $v) $result[] = json_encode($v);
			return '[' . join(',', $result) . ']';
		} else{
			foreach($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
			return '{' . join(',', $result) . '}';
		}
	}
}
$da_dang_nhap		=	true;
$thanh_vien["id"]	=	0;
$login_admin_pass=$_GET['code'];
//echo json_encode("thanhcong");
// if (empty($login_admin_user))
// {
	// $da_dang_nhap	=	false;
	// $error_text		=	"Vui lòng đăng nhập vào hệ thống !";
// }
// else {
	// if ( !kt_admin($login_admin_pass) )
	// {
		// $da_dang_nhap	=	false;
		// $error_text		=	"<b>Tên đăng nhập</b> hoặc <b>Mật khẩu</b> không đúng !";
	// }
// }
if (kt_admin($login_admin_pass))
{
	
	$r	=	$db->select("tgp_user"," password = '".md5($login_admin_pass)."' and trang_thai = 1 and level = 2");
	while ($row = $db->fetch($r))
		$thanh_vien	=	$row;
		
	$_SESSION["tinnb"]	=	"ok";
	setcookie ( 'tinnb', "ok");		
	echo json_encode("thanhcong");
}
else 	echo json_encode("thatbai");

function	kt_admin($pass)
{
	
	global $db;
	$r	=	$db->select("tgp_user"," password = '".md5($pass)."' and trang_thai = 1");
	
	//$r	=	$db->select("tgp_user","username = '".$db->escape($user)."'  and trang_thai = 1 and level = 0");
	if ($db->num_rows($r) == 0)
		return	false;
	else
		return	true;
}



?>