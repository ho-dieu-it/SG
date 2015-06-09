<?php
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_hien_thi,$txt_type,$txt_noi_bat,$error)
{
?>
<?php echo $error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?php echo $url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="func" value="<?php echo $func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="640">
	<tr>
		<td width="35%" align="right">Tên mục : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value="<?php echo $txt_ten?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right">Nhóm :</td>
		<td align="left">
			<?php
show_cat("txt_cat",$txt_cat); ?>
		</td>
	</tr>
	<tr>
		<td align="right">
			Hiển thị :
		</td>
		<td align="left">
			<input name="txt_hien_thi" type="radio" value="0" <?php echo $txt_hien_thi==0?"checked":""?> /> Tắt
			<input name="txt_hien_thi" type="radio" value="1" <?php echo $txt_hien_thi==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<!--
	<tr>
		<td align="right">
			Type view :
		</td>
		<td align="left">
			<input name="txt_type" type="radio" value="0" <?php echo $txt_type==0?"checked":""?> /> 1 column
			<input name="txt_type" type="radio" value="1" <?php echo $txt_type==1?"checked":""?> /> 2 columns
			<input name="txt_type" type="radio" value="2" <?php echo $txt_type==2?"checked":""?> /> 1 page
		</td>
	</tr>
	-->
	<tr>
		<td align="right">
			Nổi bật :
		</td>
		<td align="left">
			<input name="txt_noi_bat" type="radio" value="0" <?php echo $txt_noi_bat==0?"checked":""?> /> Tắt *
			<input name="txt_noi_bat" type="radio" value="1" <?php echo $txt_noi_bat==1?"checked":""?> /> Mở
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onclick="Forward('?act=cms_manager');">
		</td>
	</tr>
	</table>
</form>
<?php
}
function	show_cat($name,$id)
{
	global $db;
	
$r = $db->select("tgp_cat","_cms = 1","order by thu_tu asc");
?>
<select name="<?php echo $name?>" class="inputbox" style="width:50%;">
<?php
while ($row = $db->fetch($r))
{
	echo "<option value='".$row["id"]."'";
	if ($id == $row["id"]) echo " selected ";
	echo ">".$row["ten"]."</option>";
}
?>
</select>
<?php
}
function	cat_count($id)
{
	global $db;
	
	$r	=	$db->select("tgp_cms_menu","cat = '".$id."'");
	return $db->num_rows($r);
}
?>