<div class="left_menu">
	<h1>DANH MỤC SẢN PHẨM</h1>
	<ul>
	<?php
	$r	=	$db->select("tgp_product_menu","cat = 'sp' and hien_thi = '1'","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
	?>
		<li><img src="<?php echo $liveSite;?>/images/bl.gif" align="absmiddle" hspace="5" /><a href="<?php echo $liveSite;?>/san-pham/<?php echo $row["id"]?>/<?php echo lg_string::get_link($row["ten"])?>"><?php echo $row["ten"]?></a></li>
	<?php
	}
	?>
	</ul>
</div>