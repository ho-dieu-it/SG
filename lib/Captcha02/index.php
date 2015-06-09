<?php
include "Functions.php";
/*
  CAPTCHA control condition...
*/
if ( isset ( $_POST [ 'go' ] ) && strlen ( $_POST [ 'uid' ] ) > 0 ) {
	$cid = md5_decrypt ( $_POST [ 'cid' ] );
	if ( $cid == $_POST [ 'uid' ] ) {
		$passed = true;
	}
	else {
		$passed = false;
	}
}
/*
  Re-Generating variables for html form...
*/
$rnd = rnd_string	( );
$uid = urlencode	( md5_encrypt ( $rnd ) );
$cid = md5_encrypt	( $rnd );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>
	<form method="post" action="index.php">
		<table width=200 cellpadding=10 cellspacing=0 border=0>
			<tr>
				<td align=center colspan=2>
					<?php
						if ( isset ( $_POST [ 'go' ] ) && $passed ) {
							echo "<span class=\"str\"><b>Passed OK</span>\n";
						}
						else if ( isset ( $_POST [ 'go' ] ) && ! $passed ) {
							echo "<span class=\"str\"><b>Sorry, it was a failure!</b></span>\n";
						}
						else if ( ! isset ( $_POST [ 'go' ] ) ) {
							echo "<span class=\"str\"><b>Animated CAPTCHA 2.0 form is ready...</b></span>\n";
						}
					?>
				</td>
			</tr>
			<tr>
				<td align=center class="td_0" colspan=2><input type=text name="uid" size=35></td>
			</tr>
			<tr>
				<td align=center class="td_0" colspan=2><img src="CaptchaImage.php?uid=54;<?php echo  $uid ?>" alt=""></td>
			</tr>
			<tr>
				<td align=center class="td_1"><input type=submit name="go" value="Test"></td>
				<td align=center class="td_1"><input type=submit value="Redraw" onclick="window.location.href='index.php'"></td>
			</tr>
			<tr style="display:none;">
				<td colspan=2 align=center><input type=hidden name="cid" value="<?php echo  $cid ?>"></td>
			</tr>
		</table>
	</form>
</html>
