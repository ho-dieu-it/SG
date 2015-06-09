<font size="2" face="Tahoma"><b><a href='?act=banner_manager'>Quản lý banner</a> <img src="images/bl3.gif"
		border="0" /> Sửa banner
</b></font>
<hr size="1" color="#cadadd" />
<?php
include "templates/banner.php";
if (empty ( $func ))
	$func = "";
?>
<center>
<?php
// Kiểm tra sự tồn tại của ID
$id = $id + 0;
$r = $db->select ( "tgp_gallery", "id = '" . $id . "'" );
if ($db->num_rows ( $r ) == 0)
	admin_load ( "Không tồn tại ID này.", "?act=banner_manager" );

$max_file_size = 2048000;
$up_dir = "../uploads/banner/";

$OK = false;

if ($func == "update") {
	
	// kiểm tra file uploads.
	$file_type = $_FILES['txt_hinh']['type'];
	$file_name = $_FILES['txt_hinh']['name'];
	$file_size = $_FILES['txt_hinh']['size'];
	switch ($file_type) {
		case "image/pjpeg"	: $file_type = "jpg"; break;
		case "image/jpeg"	: $file_type = "jpg"; break;
		case "image/gif" 	: $file_type = "gif"; break;
		case "image/x-png" 	: $file_type = "png"; break;
		case "image/png" 	: $file_type = "png"; break;
		case "image/jpg" 	: $file_type = "jpg"; break;
		default :
			$file_type = "unk";
			break;
	}
	$file_full_name = "tmp_" . time () . "." . $file_type;
	if (($file_size > 0) && ($file_size <= $max_file_size))
		if ($file_type != "unk") {
			if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
			{
				$OK = true;
				$hinh = true;
			} else
				$error = "Không thể upload hình ảnh.";
		} else {
			$error = "Sai định dạng file - Không thể upload hình ảnh.";
		}
	else {
		if ($file_size == 0) {
			$OK = true;
			$hinh = false;
		} else
			$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
	}
	// Process xong
	
	if ($OK) {	
		
		$db->query("update tgp_gallery set hien_thi=0 where cat=".$db->escape($txt_cat+0) );
		
		$db->query ( "update tgp_gallery set cat = '" . ($txt_cat + 0) . "',  hien_thi = '" . ($txt_hien_thi + 0) . "' where id = '" . $id . "'" ) or die;
	
		if ($hinh) {
			$txt_hinh_2 = $id . "." . $file_type;
			//img_resize ( $up_dir . $file_full_name, $up_dir . $txt_hinh_2, "w=1344&h=160" );
			rename($up_dir.$file_full_name, $up_dir.$txt_hinh_2);
			$db->update ( "tgp_gallery", "hinh", $txt_hinh_2, "id = '" . $id . "'" ) or die;
		}
		
		admin_load ( "Đã cập nhật thông tin.", "?act=banner_manager" );
	}
} else {
	$r = $db->select ( "tgp_gallery", "id = '" . $id . "'" );
	while ( $row = $db->fetch ( $r ) ) {
		$txt_cat = $row ["cat"];
		$txt_ten = $row ["ten"];
		$txt_hien_thi = $row ["hien_thi"];
		$txt_hinh=$row ["hinh"];
	}
}

if (! $OK)
	template_edit ( "?act=banner_edit", "update", $id, $txt_cat, $txt_ten, $txt_hinh, $txt_hien_thi, $error )?>
</center>