<div class="top-header <?php echo $act=="home"?"hHome":"hPage"?>">
<div id="top-banner">
<?php 
$r = $db->select ( "tgp_gallery", " cat=1 and hien_thi=1", "order by time desc" );
while ( $row = $db->fetch ( $r ) ) {

?>
<a href="http://singa.com.vn" title="singa.com.vn"  class='top-banner'>
	<img src="<?php echo $liveSite;?>/uploads/banner/<?php echo $row['hinh']?>" alt="singa.com.vn">
</a>
		<?php } ?>
</div>
 <div class="menu-outer">
 <div class="table">
<ul id="menu">
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="home"?"active":""?>"><a
			href="<?php echo $liveSite;?>/home/index.html" class="main">Trang chủ</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="san_pham"?"active":""?>"><a
			href="<?php echo $liveSite;?>/san-pham/index.html" class="main">Sản
				phẩm</a>
			</li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="quy_trinh_hieu_qua"?"active":""?>"><a
			href="<?php echo $liveSite;?>/quy-trinh-hieu-qua/index.html"
			class="main">Quy trình hiệu quả</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="thu_nghiem"?"active":""?>"><a
			href="<?php echo $liveSite;?>/thu-nghiem/index.html" class="main">Thử
				nghiệm</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="tin_tuc"?"active":""?>"><a
			href="<?php echo $liveSite;?>/tin-tuc/index.html" class="main">Tin
				tức</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="lien_he"?"active":""?>"><a
			href="<?php echo $liveSite;?>/lien-he/index.html" class="main">Liên
				hệ</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="ca_phe_chia_se"?"active":""?>"><a
			href="<?php echo $liveSite;?>/ca-phe-chia-se/index.html" class="main">CAFé
				CHIA SẺ</a></li>
				<li style="padding: 0"><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="thu_vien_anh"?"active":""?>"><a
			href="<?php echo $liveSite;?>/thu-vien-anh/index.html" class="main">THƯ VIỆN ẢNH</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
		<li class="<?php echo $act=="site_map"?"active":""?>"><a
			href="<?php echo $liveSite;?>/site-map/index.html" class="main">SƠ ĐỒ
				SITE</a></li>
		<li><img src="<?php echo $liveSite;?>/img/hr.gif"
			width="2" height="54" /></li>
	
</ul></div></div>
<?php

/* FOR TRANG CHỦ */
if ($act == "home") {
	?>
<!-- Banner -->
	<div id="ctl00_content_sectionSlider" class="sec-banner index">
		<div id="scroller_roll" class="scroller_roll"
			style="border: 0px solid transparent; padding: 0px; position: relative;">
			<ul>
        <?php 
	$r = $db->select ( "tgp_product", " slide=1 ", " order by time desc limit 16" );
	while ( $row = $db->fetch ( $r ) ) {
		$catid = $row ['id'];
		$cat = $row;
		?>
        <li style="width: 500px; margin-left: 0px; display: block;"><a
					href="<?php echo $liveSite."/san-pham-xem/".$row["id"]."/".lg_string::get_link($row['ten'])."\"";?>">
						<img title="<?php echo $row['chu_thich']?>"
						src="<?php echo $liveSite;?>/uploads/product/<?php echo $row['hinh'];?>"
						class="img-banner">
				</a></li>
        <?php } ?>
      </ul>
		</div>
	</div>
	<!-- // Banner -->
	<script defer type="text/javascript">
		
        $(function () {
              $("#scroller_roll").scroller_roll({
                 title_show: 'disable', //enable disable
                 time_interval: '25',
                 window_background_color: "none",
                 window_padding: '0',
                 border_size: '0',
                border_color: 'transparent',
                 images_width: 'auto',
                 images_height: '330',
                 images_margin: '0',
                 title_size: '12',
                 title_color: 'black',
                show_count: '16'
             });
           // $("#scroller_roll").height("250");
        }); 
	
	
    </script> 
  <?php } // If action == trang_chu?>

</div>
<script src="<?php echo $liveSite;?>/js/scroller_banner.js"></script>
