<?php
	include "templates/product.php";
	// include send mail
	date_default_timezone_set('Etc/UTC');
	require  '../lib/mail/PHPMailerAutoload.php';
	
	if (empty($func)) $func = "";
	$r	= $db->select("tgp_product_menu","id = '".$cate_id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Sản phẩm này.","?act=product_manager");
	$pro_menus=$db->fetch_array($r);
?>
<font size="2" face="Tahoma"><b><a href="?act=product_manager">Quản lý sản phẩm</a><img src="images/bl3.gif" border="0" /><a href="?act=product_list&cate_id=<?php echo $cate_id?>">Sản phẩm </a>
<img src="images/bl3.gif" border="0" />Sửa sản phẩm</b></font>
<hr size="1" color="#cadadd" />
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_product","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Sản phẩm này.","?act=product_manager");
	
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/product/";
	$image_src=$liveSite."/uploads/product/";
	$OK = false;

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên sản phẩm.";
		else if (empty($txt_chu_thich))
			$error = "Vui lòng nhập sơ lược về sản phẩm.";
		else
		{
			// kiểm tra file uploads.
			$file_type = $_FILES['txt_hinh']['type'];
			$file_name = $_FILES['txt_hinh']['name'];
			$file_size = $_FILES['txt_hinh']['size'];
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
						if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
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
				$new_thu_tu=$txt_thu_tu;
				$thu_tu=$thu_tu+0;
				if($new_thu_tu!=$thu_tu){				
					if($thu_tu>$new_thu_tu)
						$db->query("update tgp_product set thu_tu=thu_tu+1 where thu_tu >= ".($new_thu_tu)." and thu_tu< ".($thu_tu));
					else 
						$db->query("update tgp_product set thu_tu=thu_tu-1 where thu_tu <= ".($new_thu_tu)." and thu_tu >".($thu_tu));
				}
				else{
					$new_thu_tu=$thu_tu;
				}
				$db->query("update tgp_product set cat = '".$db->escape($cate_id)."', ten = '".$db->escape($txt_ten)."', chu_thich = '".$db->escape($txt_chu_thich)."', noi_dung = '".$db->escape($txt_noi_dung)."', gia = 0 , hien_thi = '".$db->escape($txt_hien_thi+0)."' , noi_bat = '".$db->escape($txt_noi_bat+0)."',san_pham_moi=".$db->escape($txt_san_pham_moi).", thu_tu=".$db->escape($new_thu_tu).", slide=".$db->escape($txt_slide)." where id = '".$db->escape($id)."'");
				
				if ($hinh)
				{
					$txt_hinh_2	= $id.".".$file_type;
					//img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=2000&h=1000");
					rename($up_dir.$file_full_name, $up_dir.$txt_hinh_2);
					$db->update("tgp_product","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				else{
					$r	= $db->select("tgp_product","id = '".$id."'");
					while ($row = $db->fetch($r))
					{
						$txt_hinh_2		= $row["hinh"];
					}
				}
				if($chk_gui_mail==1){
					$from ='admin@singa.com.vn';
					$to = $txt_gui_mail;
					$emails=get_email_from_string($to);
					$obj_mail=array(
							'from'=>$from,
							'to'=>$emails,
							'title'=>$txt_ten,
							'summary' =>$txt_chu_thich,
							's_image'=>$image_src.$txt_hinh_2,
							'message'=>$txt_ten,
							'link'=>$liveSite."/san-pham-xem/".$id."/".lg_string::get_link($txt_ten),
							'fullname' => 'Singa.com.vn',
					);
					
					$result=send_mail($obj_mail);
					admin_load("Đã cập nhật thành công & ".$result['msg'],"?act=product_list&cate_id=".($cate_id+0));
				}
				else
					admin_load("Đã cập nhật thành công.","?act=product_list&cate_id=".($cate_id+0));
			}			
		}
	}
	else
	{
	
		$r	= $db->select("tgp_product","id = '".$id."'");
		
		while ($row = $db->fetch($r))
		{
			$cate_id		= $row["cat"];
			$txt_ten		= $row["ten"];
			$txt_chu_thich	= $row["chu_thich"];
			$txt_hinh_note	= $row["hinh_note"];
			$txt_noi_dung	= $row["noi_dung"];
			$txt_gia		= $row["gia"];
			$txt_hien_thi	= $row["hien_thi"];
			$txt_noi_bat	= $row["noi_bat"];
			$txt_san_pham_moi= $row["san_pham_moi"];
			$txt_slide=$row["slide"];
			$thu_tu= $row["thu_tu"];
			$txt_gui_mail="";
			$chk_gui_mail=0;
		}
	}
	
	if (!$OK)
		template_edit("?act=product_edit","update",$id,$cate_id,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$txt_san_pham_moi,$txt_slide,$thu_tu,$chk_gui_mail,$txt_gui_mail,$error)
?>
</center>