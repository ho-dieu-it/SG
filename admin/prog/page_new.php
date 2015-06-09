<font size="2" face="Tahoma"><b>Trang nội dung <img src="images/bl3.gif" border="0" /> Thêm trang</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/page.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên trang.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung.";
		else
		{
			$id = $db->insert("tgp_page","id,alias,ten,noi_dung,time,user","0,'".$db->escape($txt_alias)."','".$db->escape($txt_ten)."','".$txt_noi_dung."','".time()."','".$thanh_vien["id"]."'");
			admin_load("Đã thêm Trang vào CSDL","?act=page_list");
		}
	}
	else
	{
		$id = 0;
		$txt_alias		= "";
		$txt_ten		= "";
		$txt_noi_dung	= "";
	}
	
	if (!$OK)
		template_edit("?act=page_new","new",$id,$txt_alias,$txt_ten,$txt_noi_dung,$error)
?>
</center>