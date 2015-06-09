<div class="sitebar_title"><span>Danh mục sản phẩm</span></div>
<ul id="danhmucsanpham">
		<?php
			$r	=	$db->select("tgp_product_menu","cat = '7' and hien_thi = '1'","order by thu_tu asc");
			while ($row = $db->fetch($r))
			{
			?>
				<li>
					<a href="#" class="danhmucsanpham_item_487"><?php echo $row["ten"]?></a>
					<!-- SubMenu-->
					<ul>
					<?php 
						$p = $db->select("tgp_product","hien_thi = 1 AND cat IN ('".$row['id']."')  ","order by thu_tu desc");
						
						while($row_p=$db->fetch($p))
						{
						
							$img_url=$liveSite."/uploads/product/".$row_p["hinh"];
					?>
					<!--//-->
					
					
						<li>
						<a href="<?php echo $liveSite;?>/san-pham-xem/<?php echo $row_p["id"]?>/<?php echo lg_string::get_link($row_p["ten"])?>" class="danhmucsanpham_item_623">
						<?php echo $row_p["ten"]?></a>
						</li>
					
				<?php } ?>
				</ul>
				</li>
			<?php
			}
		?>          
</ul>
<img src="<?php echo $liveSite;?>/img/bg-mune-bottom.gif"/> </div>