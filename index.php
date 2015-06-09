<?php
@session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");

$THANHVIEN["id"] = 0;
include("z_includes/dem_online.php");

if( !empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'act=') !== false ){
	$act = explode('&', $_SERVER['QUERY_STRING']);
	foreach( $act as $k=>$v ){
		$v = explode('=', $v);
		eval('$'.$v[0].' = \''.$v[1].'\';');
	}
}

if (empty($act)) $act = "home";
if ( !in_array($act, array("doi_net_ve_singa","home","gioi_thieu","lien_he","san_pham","san_pham_xem","tin_tuc","tin_tuc_chi_tiet"
,"cac_san_pham","tin_tuc_noi_bo","tin_tuc_noi_bo_chi_tiet","tuyen_dung","site_map","ca_phe_chia_se","ca_phe_chia_se_chi_tiet",
		"thu_vien_anh","thu_vien_anh_chi_tiet","so_do_site","quy_trinh_hieu_qua","quy_trinh_hieu_qua_xem","thu_nghiem",
		"danh_muc_thong_bao","thong_bao_chi_tiet","danh_muc_tin_tuc","thu_nghiem_chi_tiet"
	) ) ) 
{
	$act = "home";
}
include("z_includes/get_detail.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('z_includes/meta_tags.php');?>
<title>SINGA</title>
<link rel="stylesheet" type="text/css" href="<?php echo $liveSite;?>/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $liveSite;?>/banner/all_index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $liveSite;?>/jquery.bxslider.css"/>
<!--[if IE]><link rel="stylesheet" type="text/css" href="http://statics.kay.com.vn/css/ie.css?v=1.1"><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="http://statics.kay.com.vn/css/ie78.css?v=1.1"><![endif]-->
<!--[if IE]><script type="text/javascript" language="javascript" src="http://statics.kay.com.vn/js/html5.js"></script><![endif]-->
 <link rel="stylesheet" href="<?php echo $liveSite;?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script src="<?php echo $liveSite;?>/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo $liveSite;?>/js/clock.js"></script>
<script src="<?php echo $liveSite;?>/js/vpb_script.js"></script> <!-- Popup -->
<script defer src="<?php echo $liveSite;?>/banner/scroller_roll.js"></script>  <!-- Scroller -->
<script defer src="<?php echo $liveSite;?>/js/jquery.bxslider.min.js"></script>  <!-- Scroller -->

	<script type="text/javascript" src="<?php echo $liveSite;?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo $liveSite;?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo $liveSite;?>/js/imgLiquid-min.js"></script>
	<script type="text/javascript" src="<?php echo $liveSite;?>/js/image-scale.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $liveSite;?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(function() {
	  if ($.browser.msie && $.browser.version.substr(0,1)<7)
	  {
		$('li').has('ul').mouseover(function(){
			$(this).children('ul').show();
			}).mouseout(function(){
			$(this).children('ul').hide();
			})
	  }
	});        
</script> 
<!--end -menu -->
</head>
<body>
<div id="container" >
  <div id="header">
	<?php include("z_includes/header.php");?>
  </div>
  <!-- <div id="content2"> -->
  <div id="pageBody">
  <?php if($right_banner1){?>
  <div id="left-ads" class='scroll-ads'>
  	<img src="<?php echo  $liveSite.'/uploads/banner/'.$left_banner['hinh'];?>"/>
  </div>
  	<?php }?>
    <div id="leftmain">
	<?php include('z_includes/left_page.php');?>
    </div>
    <div id="content"> 
		<?php 
			include "z_modules/".$act.".php";
		?>	
    </div>
    <div id="right"> 
	<?php include('z_includes/right_page.php');?>
    </div>
    <?php if($right_banne1r){?>
   <div id="right-ads" class='scroll-ads'>
    	<img src="<?php echo  $liveSite.'/uploads/banner/'.$right_banner['hinh'];?>"/>
    </div> 
     <?php }?>
  </div>
<!--     </div> -->
   
  <div id="footer">
    <?php include('z_includes/footer.php');?>
  </div>
</div>
<script src="<?php echo $liveSite;?>/js/fbplugin.js"></script>
<?php if($right_banner1){?>
<script src="<?php echo $liveSite;?>/js/banner_ad.js"></script>
<?php } ?>
</body>
</html>
