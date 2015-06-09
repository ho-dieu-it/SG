<font size="2" face="Tahoma"><b><a href="?act=gallery_manager" >Thư viện hình ảnh</a> <img src="images/bl3.gif" border="0" /> Sửa bài viết</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/gallery.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_gallery","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại bài viết này.","?act=gallery_manager");
	
	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/gal/";

	$OK = false;

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên bài viết.";
		else
		{
			$files=$_FILES['txt_hinh'];
			for($i=0;$i<count($files['name']);$i++){
			// kiểm tra file uploads.
			$file_type = $files['type'][$i];
			$file_name = $files['name'][$i];
			$file_size = $files['size'][$i];
			switch ($file_type)
			{
				case "image/pjpeg"	: $file_type = "jpg"; break;
				case "image/jpeg"	: $file_type = "jpg"; break;
				case "image/gif" 	: $file_type = "gif"; break;
				case "image/x-png" 	: $file_type = "png"; break;
				case "image/png" 	: $file_type = "png"; break;
				default : $file_type = "unk"; break;
			}
			$file_full_name = "tmp_".time().".".$file_type;
			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
				if ($file_type != "unk")
						if ( @move_uploaded_file($files['tmp_name'][$i],$up_dir.$file_full_name) )
						{
							$OK = true;
							$hinh = true;
						}
						else
							$error = "Không thể upload hình ảnh.";
				else
				{
					$error = "Sai định dạng file - Không thể upload hình ảnh.";
				}
			else
			{
				if ($file_size == 0)
				{
					$OK		= true;
					$hinh	= false;
				}
				else
					$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
			}
			// Process xong
			if ($OK)
			{
				$db->query("update tgp_gallery set cat = '".$db->escape($txt_cat)."', ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', hien_thi = '".($txt_hien_thi+0)."' where id = '".$id."'");
				if ($hinh)
				{
					
					$txt_hinh_2	= "gal_".$id.".".$file_type;
					//img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"w=2000&h=1000");
					rename($up_dir.$file_full_name, $up_dir.$txt_hinh_2);
					$db->update("tgp_gallery","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				}
				if($OK)
					admin_load("Đã cập nhật thành công.","?act=gallery_list&id=".($txt_cat+0));
			}			
		}
	}
	else
	{
		$r	= $db->select("tgp_gallery","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_cat		= $row["cat"];
			$txt_ten		= $row["ten"];
			$txt_chu_thich	= $row["chu_thich"];
			$txt_noi_dung	= $row["noi_dung"];
			$txt_hien_thi	= $row["hien_thi"];
		}
	}
	
	if (!$OK)
		template_edit("?act=gallery_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$error)
?>
</center>