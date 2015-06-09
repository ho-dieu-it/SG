<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/login.css" />
<title>Administration Control Panel - Đăng nhập</title>
<!--[if lt IE 7]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->

<!--[if lte IE 6]>
<style type="text/css">
.clearfix {height: 1%;}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->
</head>
<body>
<center>
	<div id="fw_frame" class="clearfix">
		<div id="frame_1">
			<h3>Khu vực dành cho người quản trị</h3>
			<div class="content">
				<center>
				<table width="98%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="left"><img src="images/login.png" /></td>
					<td align="left">
						<b>Để website hoạt động tốt :</b>
						<ol>
						  <li>Bật cookies trình duyệt</li>
						  <li>Bật javascript trình duyệt</li>
						  <li>Duyệt tốt trên IE7 và FF2 trở lên</li>
				    	</ol>
					</td>
				  </tr>
				</table>
				</center>
			</div>
		</div>
		<div id="frame_2">
			<h3>Đăng nhập</h3>
			<div class="content">
				<center>
				<form action="" method="post">
					<table width="90%" border="0" cellspacing="0" cellpadding="5">
					  <tr>
						<td width="35%" align="right">Tên người dùng :</td>
						<td width="65%" align="left"><input class="inputbox" style="width:80%" type="text" autocomplete="off" name="log_admin_user" /></td>
					  </tr>
					  <tr>
						<td align="right">Mật khẩu :</td>
						<td align="left"><input class="inputbox" style="width:80%" type="password" name="log_admin_pass" /></td>
					  </tr>
					  <tr>
						<td></td>
						<td align="left"><input class="button" type="submit" value="Đăng nhập" /></td>
					  </tr>
					  <tr>
						<td align="center" colspan="2"><font color="#990000"><?php echo $error_text?></font></td>
					  </tr>
					</table>
				</form>
				</center>
			</div>
		</div>
	</div>
	<?php
include "tpl/skin/copyright.php"; ?>
</center>
</body>
</html>
