<?php
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$error)
{
?>
<?php echo $error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?php echo $url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="func" value="<?php echo $func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right">Tên hình ảnh : </td>
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
		<td align="right">Hình ảnh :</td>
		<td align="left">
		<input type="file" name="txt_hinh[]" class="inputbox" style="width:90%;" multiple/>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Lời chú thích ngắn :</td>
		<td align="left"><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?php echo $txt_chu_thich?></textarea></td>
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
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onclick="Forward('?act=gallery_manager');">
		</td>
	</tr>
	</table>
</form>
<?php
}
function	show_cat($name,$id)
{
	global $db;
	
$r2 = $db->select("tgp_cat","_gallery = 1","order by thu_tu asc");
?>
<select name="<?php echo $name?>" class="inputbox" style="width:50%;">
<?php
while ($row2 = $db->fetch($r2))
{
	echo "<optgroup label='".$row2["ten"]."'>";
	$r	=	$db->select("tgp_gallery_menu","cat = '".$row2["id"]."'","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
		echo "<option value='".$row["id"]."'";
		if ($id == $row["id"]) echo " selected ";
		echo ">".$row["ten"]."</option>";
	}
	echo "</optgroup>";
}
?>
</select>
<?php
}
?>