<?php
function template_edit($url,$func,$id,$cate_id,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$chk_gui_mail,$txt_gui_mail,$is_nv,$error)
{
?>
<?php echo $error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?php echo $url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="func" value="<?php echo $func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right"><?php echo $is_nv==1?"Tên nhân viên":"Tên bài viết";?> : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value='<?php echo $txt_ten?>' class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right">Nhóm :</td>
		<td align="left">
			<?php
show_cat("cate_id",$cate_id); ?>
		</td>
	</tr>
	<tr>
		<td align="right">Hình ảnh :</td>
		<td align="left"><input type="file" name="txt_hinh" class="inputbox" style="width:90%;" /></td>
	</tr>
	<tr>
		<td align="right" valign="top">Ghi chú hình ảnh :</td>
		<td align="left">
			<input type="text" name="txt_hinh_note" value='<?php echo $txt_hinh_note?>' class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Sơ lược bài viết :</td>
		<td align="left"><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?php echo $txt_chu_thich?></textarea></td>
	</tr>
	<tr>
		<td align="right">Giới thiệu :</td>
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
		<td align="right">
			Hiển thị :
		</td>
		<td align="left">
			<input name="txt_hien_thi" type="radio" value="0" <?php echo $txt_hien_thi==0?"checked":""?> /> Tắt
			<input name="txt_hien_thi" type="radio" value="1" <?php echo $txt_hien_thi==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<tr>
		<td align="right">
			Nổi bật :
		</td>
		<td align="left">
			<input name="txt_noi_bat" type="radio" value="0" <?php echo $txt_noi_bat==0?"checked":""?> /> Tắt
			<input name="txt_noi_bat" type="radio" value="1" <?php echo $txt_noi_bat==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<?php if(in_array($cate_id, array(3,4,5,7,9,10))){ ?>
	<tr>
		<td align="right">
			Gửi e-mail
		</td>
		<td align="left">
			<input name="chk_gui_mail" type="checkbox" value="0" <?php echo $chk_gui_mail==1?"checked":""?> /> 
		</td>
	</tr>
	<tr>
		<td align="right">
			Địa chỉ e-mail :
		</td>
		<td align="left">
			<input name="txt_gui_mail" type="text" value='<?php echo $txt_gui_mail?>' class="inputbox" style="width:90%"/> 
		</td>
	</tr>
	<?php } ?>
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
	
$r2 = $db->select("tgp_cat","_cms = 1","order by thu_tu asc");
?>
<select name="<?php echo $name?>" class="inputbox" style="width:50%;">
<?php
while ($row2 = $db->fetch($r2))
{
	echo "<optgroup label='".$row2["ten"]."'>";
	$r	=	$db->select("tgp_cms_menu","cat = '".$row2["id"]."'","order by thu_tu asc");
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
<?php if($func!="update"){?>
<script type="text/javascript">
$(document).ready(function(){
	$chk_gui_mail=$('[name=chk_gui_mail]');
	$chk_gui_mail.click(function(){
		if($(this).is(':checked')){
			$(this).parent().parent().next().show();
			$(this).val(1);
		}
		else{
			$chk_gui_mail.parent().parent().next().hide();	
			$(this).val(0);
		}
	});
	if($chk_gui_mail.is(':checked')){
		$chk_gui_mail.val(1);
		$chk_gui_mail.parent().parent().next().show();
	}
	else{
		$chk_gui_mail.val(0);
		$chk_gui_mail.parent().parent().next().hide();
	}
			
});
</script>
<?php } ?>