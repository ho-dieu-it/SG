<?php
	
	include "templates/cms.php";
	// include send mail
	date_default_timezone_set('Etc/UTC');
	require  '../lib/mail/PHPMailerAutoload.php';
	//------------------
	if (empty($func)) $func = "";
	$cate_id = $cate_id + 0;
	$r	= $db->select("tgp_cms_menu","id = '".$cate_id."'");
	$cat=$db->fetch_array($r);
?>
<font size="2" face="Tahoma"><b><a href="?act=cms_manager">Quản lý tin tức</a>
<img src="images/bl3.gif" border="0" /><a href="?act=cms_list&cate_id=<?php echo $cat['id']?>"><?php echo $cat['ten']?></a>
<img src="images/bl3.gif" border="0" />  Thêm bài viết</b></font>
<hr size="1" color="#cadadd" />

<center>
<?php
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/cms/";
	$image_src=$liveSite."/uploads/cms/";
	$OK = false;
	
	if ($func == "new")
	{
		$is_check_email=true;
		if($chk_gui_mail==1&&!empty($txt_gui_mail)){
			$emails=get_email_from_string($txt_gui_mail);
			for($i=0;$i<count($emails);$i++){
				$validate_email=lg_string::check_email($emails[$i]);
				if($validate_email==false) {
					$is_check_email=false;
					break;
				}
			}
		}
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên bài viết.";
		else if (empty($txt_chu_thich))
			$error = "Vui lòng nhập sơ lược bài viết.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung bài viết.";
		else if($chk_gui_mail==1&&empty($txt_gui_mail)){
				$error = "Vui lòng nhập địa chỉ email.";
		}
		else if($is_check_email==false){
			$error="Địa chỉ email không hợp lệ.";
		}
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
			//$file_full_name = "tmp_".time().".".$file_type;
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
				$id = $db->insert("tgp_cms","id,cat,ten,chu_thich,hinh_note,noi_dung,hien_thi,noi_bat,time,user","0,'".($cate_id+0)."','".$db->escape($txt_ten)."','".$db->escape($txt_chu_thich)."','".$db->escape($txt_hinh_note)."','".$db->escape($txt_noi_dung)."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".time()."','".$thanh_vien["id"]."'");
				if ($hinh)
				{
					$txt_hinh_2	= $id.".".$file_type;
					rename($up_dir.$file_full_name, $up_dir.$txt_hinh_2);
					//img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=2000&h=1000");
					$db->update("tgp_cms","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				// send mail 
				//3,4,5,10
				if($chk_gui_mail==1){
					
					if($cate_id==3){
						$cat_url="tin-tuc-xem";
					}
					else if($cate_id==4){
						$cat_url="ca-phe-chia-se-chi-tiet";
					}
					else if($cate_id==5){
						$cat_url="tin-tuc-noi-bo-chi-tiet";
					}
					else if($cate_id==7){
						$cat_url="thu-nghiem-chi-tiet";
					}
					else if($cate_id==9){
						$cat_url="quy-trinh-hieu-qua-chi-tiet";
					}
					else if($cate_id==10){
						$cat_url="thong-bao-chi-tiet";
					}
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
							'link'=>$liveSite."/".$cat_url."/".$id."/".lg_string::get_link($txt_ten),
							'fullname' => 'Singa.com.vn',
						);
						
						$result=send_mail($obj_mail);
						admin_load("Đã thêm Bài viết vào CSDL & ".$result['msg'],"?act=cms_list&cate_id=".($cate_id+0));
				}
				else 
					admin_load("Đã thêm Bài viết vào CSDL.","?act=cms_list&cate_id=".($cate_id+0));
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_hinh_note	= "";
		$txt_noi_dung	= "";
		$txt_hien_thi	= 1;
		$txt_gui_mail="";
		$chk_gui_mail=0;
	}
	
	if (!$OK)
		template_edit("?act=cms_new&cate_id=".$cate_id, "new", 0 , $cate_id,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$chk_gui_mail,$txt_gui_mail,$is_nv,$error)
?>
</center>