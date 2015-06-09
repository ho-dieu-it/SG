<div class="news">
<p> Home > Quy trình hiệu quả </p>
<div class="detail">
<div class="inner-news">
<?php
		// Paging ======
		$cate_id=32;$page=isset($_GET['page'])?$_GET['page']:((isset($page))?$page:0) + 0;
		
		//$page		=	((isset($page))?$page:0) + 0;
		$perpage	=	12;
		$r_all		=	$db->select("tgp_cms","hien_thi = 1 AND cat IN ('9') ","order by time desc");
		$sum		=	$db->num_rows($r_all);
		$pages		=	($sum-($sum%$perpage))/$perpage;
		if ($sum % $perpage <> 0 )	$pages = $pages+1;
		$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
		$min 		= 	abs($page-1) * $perpage;
		$max 		= 	$perpage;
		
		$r2	= $db->select("tgp_cms","hien_thi = 1 AND cat IN ('9') ","order by time desc limit $min,$max");
		while ($row2 = $db->fetch($r2))
		{
		?>
		<div class="itemnews"> 
		  <a href="<?php echo $liveSite.'/tin-tuc-xem/'.$row2['id'].'/'.lg_string::get_link($row2['ten']).'/'; ?>">
		  <?php if ($row2["hinh"] != "no") {
			$img_path=$ROOT_DIR."/uploads/cms/".$row2["hinh"];
			$img_url=$liveSite."/uploads/cms/".$row2["hinh"];
		  if (file_exists($img_path)) 
		  {
		  ?>
		  <img src="<?php echo $img_url;?>" class="img-itemnews">
		  <?php }
		  else{?>
			<img src="<?php echo $liveSite."/images/common/noimage.jpg";?>" class="img-itemnews">
		  <?php	}
		  }
		  else{?>
			<img src="<?php echo $liveSite."/images/common/noimage.jpg";?>" class="img-itemnews">
		  <?php	
		  }?>
		  </a>
			<div class="text-itemnews">
			  <h2><a href="<?php echo $liveSite."/quy-trinh-hieu-qua-chi-tiet/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>"><?php echo lg_string::crop($row2["ten"],7);?></a>
			   <?php 
			 	 $days_between = ceil(abs(time()-$row2['time']) / 86400);
			 	 if($days_between<7){
			  ?>
			  <img src="<?php echo $liveSite."/img/new.gif";?>">
			  <?php } ?>
			  </h2>
			  <p><?php echo lg_string::crop($row2["chu_thich"],24);?></p>
			</div>
		  </div>
			
		<?php
		}
	?>
 <!-- Paging -->
<?php

if ($pages > 1)
{
?>
<div style="width:100%;">
	<div id="page_paging" class="pagination">
		<dl>
			<dt class="first" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,1);">Trang đầu</dt>
			<dt class="last" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo abs($page-1)?>)">&laquo;Quay lại</dt>
		<?php
		$_start	=	$page - 2;
		$_end	=	$page + 2;
		
		if ($page < 4) $_end += (4-$page);
		if ($page > $pages - 3) $_start -= (3-($pages - $page));
		
		if ($_start < 1) $_start = 1;
		if ($_end   > $pages) $_end = $pages;
		
		for ($i = $_start; $i <= $_end; $i++)
		{
			if ($i == $page)
					echo "<dt class='current'> $i </dt>";
			else	echo "<dt onclick=\"paging('$liveSite',$cate_id,$i);\" class='rp_page'> $i </dt>";
		}
		?>
			<dt class="btn_chg_page" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo abs($page+1)?>)">Xem thêm&raquo;</dt>
			<dt class="btn_chg_page" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo ($pages)?>)">Cuối cùng</dt>
		</dl>
	</div>	
</div>
<?php
}
?>
<!-- End Paging -->
<script>
function paging(root,cateId,pageNo)
{
	var url=root+"/tin-tuc/"+cateId+"/"+pageNo+"/index.html";
	window.location.href=url;	
}
</script>
</div>
</div>
</div>

