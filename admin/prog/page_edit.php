<font size="2" face="Tahoma"><b>Trang nội dung <img src="images/bl3.gif" border="0" /> Sửa trang</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/page.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_page","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại trang này.","?act=page_list");

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên trang.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung.";
		else
		{
			$db->query("update tgp_page set alias = '".$db->escape($txt_alias)."', ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."', time = '".time()."' where id = '".$id."'");
			admin_load("Đã cập nhật thành công.","?act=page_list");	
		}
	}
	else
	{
		$r	= $db->select("tgp_page","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_alias		= $row["alias"];
			$txt_ten		= $row["ten"];
			$txt_noi_dung	= $row["noi_dung"];
		}
	}
	
	if (!$OK)
		template_edit("?act=page_edit","update",$id,$txt_alias,$txt_ten,$txt_noi_dung,$error);
?>
</center>