<?php
$id	=	$id + 0;
if (in_array($act, array("tin_tuc_chi_tiet","thong_bao_chi_tiet","tin_tuc_noi_bo_chi_tiet","ca_phe_chia_se_chi_tiet",
		"quy_trinh_hieu_qua_xem","thu_nghiem_chi_tiet") ) ) 
{
		$r2	=	$db->select("tgp_cms","id = '".$id."'");
		$row2=$db->fetch_assoc($r2);
		
		
}
if(in_array($act, array('san_pham_xem'))){
	$r2	=	$db->select("tgp_product","id = '".$id."'");
	$row2=$db->fetch_assoc($r2);
}

if(in_array($act, array('thu_vien_anh_chi_tiet'))){
	$r2	=	$db->select("tgp_gallery","cat = '".$id."'");
	
}

$r_left=$db->select("tgp_gallery"," hien_thi= 1 ");
while($row_bn=$db->fetch_assoc($r_left)){
	if($row_bn['cat']==1){// top banner
		$top_banner=$row_bn;
	}
	else if($row_bn['cat']==2){// left banner
		$left_banner=$row_bn;
	}
	else if($row_bn['cat']==3){// right banner
		$right_banner=$row_bn;
	}
}