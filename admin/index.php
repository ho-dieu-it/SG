<?php
session_start();
@error_reporting(1);
@set_time_limit(0);

if( !empty($_SERVER['QUERY_STRING']) ){
	$act = explode('&', $_SERVER['QUERY_STRING']);
	foreach( $act as $k=>$v ){
		$v = explode('=', $v);
		eval('$'.$v[0].' = \''.$v[1].'\';');
	}
}

if( !empty($_POST) ){
	foreach( $_POST as $k=>$v ){
		eval('$'.$k.' = \''.str_replace("'", "\'",$v).'\';');
	}
}

include "kt_login.php";
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";
if ($da_dang_nhap)
{
	if(is_array($act)&&$act[0]=='logout=OK')$act = "cms_manager";// IF LOGIN SUCCESSFULLY
	if (empty($act)) $act = "cms_manager";
	//if (empty($act)) $act = "home";
	include "tpl/skin/header.php";
		include "tpl/skin/menu.php";
		echo "<div id=\"main_frame\">";
		if (is_file("prog/".$act.".php"))
			include "prog/".$act.".php";
		else{
			
			echo "<b>Chức năng này đã bị Khóa.</b>";
			}
		echo "</div>";
		include "tpl/skin/copyright.php";
	include "tpl/skin/footer.php";
}
else	include "login.php";
?>