<?php
function	template_edit($url,$func,$id,$txt_alias,$txt_ten,$txt_noi_dung,$error)
{
?>
<?php echo $error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?php echo $url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="func" value="<?php echo $func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td align="right" valign="top">Alias :</td>
		<td align="left">
			<input type="text" name="txt_alias" value="<?php echo $txt_alias?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td width="35%" align="right">Tên trang : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value="<?php echo $txt_ten?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right">Nội dung :</td>
		<td>&nbsp;</td>
	<tr>
		<td align="left" colspan="2">
			<?php
			include("../fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) ) ;
			
			$oFCKeditor = new FCKeditor('txt_noi_dung') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $txt_noi_dung;
			$oFCKeditor->Height		= 300;
			$oFCKeditor->Create() ;
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onClick="Forward('?act=page_list');">
		</td>
	</tr>
	</table>
</form>
<?php
}
?>