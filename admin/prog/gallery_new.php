<font size="2" face="Tahoma"><b>Thư viện hình ảnh <img src="images/bl3.gif" border="0" /> Thêm Hình ảnh</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/gallery.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	$max_file_size	=	10000000;
	$up_dir			=	"../uploads/gal/";

	$OK = false;
	
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên Hình ảnh.";
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
				$id = $db->insert("tgp_gallery","id,cat,ten,chu_thich,hien_thi,time,user","0,'".($txt_cat+0)."','".$db->escape($txt_ten)."','".$txt_chu_thich."','".($txt_hien_thi+0)."','".time()."','".$thanh_vien["id"]."'");
				
				if ($hinh)
				{
					$txt_hinh_2	= "gal_".$id.".".$file_type;
// 					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=2000&h=1000");
// 					$txt_hinh_3	= $id.".".$file_type;
// 					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"w=2000&h=1000");
					rename($up_dir.$file_full_name, $up_dir.$txt_hinh_2);
					$db->update("tgp_gallery","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				$OK=true;
			}
			}
			if($OK)
				admin_load("Đã thêm Hình ảnh vào CSDL","?act=gallery_list&id=".($txt_cat+0));
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_hinh_note	= "";
		$txt_noi_dung	= "";
		$txt_hien_thi	= 1;
	}
	
	if (!$OK)
		template_edit("?act=gallery_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$error)
?>
</center>