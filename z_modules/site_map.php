<div CLASS="detail">
  <h1><span>SITE MAP</span></h1>
  <div class="detail">
    <ul class="sodosite">
      <li><a href="<?php echo $liveSite;?>/home/index.html">Trang chủ</a></li>
      <li><a href="<?php echo $liveSite;?>/san-pham/index.html">Sản phẩm</a>
        <ul class="inner-sodosite">
		<?php
			$r	=	$db->select("tgp_product_menu","cat = '7' and hien_thi = '1'","order by thu_tu asc");
			while ($row = $db->fetch($r))
			{
			?>
			<li>
				<a href="<?php echo $liveSite."/cac-san-pham/".$row['id']."/1/".lg_string::get_link($row['ten'])."\"";?>">
				<?php echo $row['ten'];?>
				</a>
			</li>
		  <?php } ?>
        </ul>
      </li>
      <li><a href="<?php echo $liveSite;?>/quy-trinh-hieu-qua/index.html">Quy trình hiệu quả</a></li>
      <li><a href="<?php echo $liveSite;?>/thu-nghiem/index.html">Thử nghiệm</a></li>
      <li><a href="<?php echo $liveSite;?>/tin-tuc/index.html">Tin tức</a>
      		<ul class="inner-sodosite">
      		 <li><a href="<?php echo $liveSite;?>/danh-muc-thong-bao/10/1/thong-bao/index.html">Thông báo</a></li>
      		 <li><a href="<?php echo $liveSite;?>/danh-muc-tin-tuc/3/1/tin-tuc/index.html">Tin tức</a></li>
      		</ul>
      </li>
      <li><a href="<?php echo $liveSite;?>/lien-he/index.html">Liên hệ</a></li>
      <li><a href="<?php echo $liveSite;?>/ca-phe-chia-se/index.html">Café chia sẻ</a></li>
      <li><a href="<?php echo $liveSite;?>/thu-vien-anh/index.html">Thư viện ảnh</a></li>
      <li><a href="<?php echo $liveSite;?>/site-map/index.html">Sơ đồ site</a></li>
    </ul>
  </div>
</div>
