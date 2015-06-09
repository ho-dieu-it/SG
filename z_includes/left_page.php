<div class="danhmucsp" >
        
		<!-- Show Giờ-->
		<div id="clock"></div>		
		<!-- // -->
		
		<!-- Danh mục sản phẩm-->
		<?php include('danh_muc_san_pham.php');?>
		<!-- // -->
        <?php 
			$p	=	$db->select("tgp_product"," hien_thi = '1' AND san_pham_moi=1 ","order by time desc limit 2");
			if($db->num_rows($p)>0){
		?>
	<!-- SẢN PHẨM MỚI -->
      <div class="product-new">
        <h2 style="text-align:center; display:block">SẢN PHẨM MỚI</h2>
		<?php 
			while ($row = $db->fetch($p))
			{
		?>
		 <a href="<?php echo $liveSite."/san-pham-xem/".$row["id"]."/".lg_string::get_link($row['ten']);?>">
			<img src="<?php echo $liveSite;?>/uploads/product/<?php echo $row['hinh'];?>" class="img-pronew" />
		 </a> 
		<?php 
			}
		?>
       
		
	</div>
	<?php } ?>
	<!--//-->
	<!-- ĐẾM ONLINE -->
	<div class="danhmucsp">
		<div class="sitebar_title">
		<span>Thống kê</span>
		</div>
		<div id="danhmucsanpham">
			<?php include('thong_ke.php');?>			
		</div>
		<img src="<?php echo $liveSite;?>/img/bg-mune-bottom.gif" width="210" height="10" /> 
		</div>
	
	<!-- // -->
    