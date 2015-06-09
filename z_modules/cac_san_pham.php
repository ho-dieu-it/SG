
<?php
$cmid = $cmid + 0;
$r = $db->select("tgp_product_menu","id='".$id."'");

if ($db->num_rows($r) == 0)
{
	$cmid = 0;
}
else
{
	while ($row = $db->fetch($r))
	{	
		$cat = $row;
		?>
		
    <div>
     <div>
        <div style="position:absolute"><img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15" usemap="#Map2" border="0" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="534,4,566,11" href="#" />
          </map>
        </div>
        <div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
		<?php echo $cat['ten'];?>
		</div>
      </div>
		<!-- Show Product -->
		
		<?php 
		// Paging ======
		$cate_id=$_GET['id'];$page=isset($_GET['page'])?$_GET['page']:((isset($page))?$page:0) + 0;
		
		//$page		=	((isset($page))?$page:0) + 0;
		$perpage	=	9;
		$r_all		=	$db->select("tgp_product","hien_thi = 1 AND cat IN ('".$cat['id']."')  ","order by time desc ");
		$sum		=	$db->num_rows($r_all);
		$pages		=	($sum-($sum%$perpage))/$perpage;
		if ($sum % $perpage <> 0 )	$pages = $pages+1;
		$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
		$min 		= 	abs($page-1) * $perpage;
		$max 		= 	$perpage;
		
		$p = $db->select("tgp_product","hien_thi = 1 AND cat IN ('".$cat['id']."')  ","order by thu_tu desc LIMIT $min,$max");
		$count_rows=$db->num_rows($p);
		if ($db->num_rows($p) == 0)
		{
			echo "Không có danh mục sản phẩm nào.";
		}
		$i=1;
		$count=1;
		
		while($row_p=$db->fetch($p))
		{
		$img_url=$liveSite."/uploads/product/".$row_p["hinh"];
		
		if($count==1 ||$count==4)
		{
			$count=1;
		?>	
		<div style="clear:both; margin-bottom:20px;overflow:hidden">
		<?php }?>
			
		  <div class="inner-product"> 
		  <a title="" href="<?php echo $liveSite."/san-pham-xem/".$row_p["id"]."/".lg_string::get_link($row_p['ten']);?>" rel="gallery1" class="fancybox">
	  <img title="<?php echo $row_p["chu_thich"];?>" class="img-product" alt="" src="<?php echo $img_url;?>"> </a>
        <h4> <a href="<?php echo $liveSite."/san-pham-xem/".$row_p["id"]."/".lg_string::get_link($row_p['ten'])."\"";?>" rel="gallery1" class="fancybox">
		<?php echo $row_p['ten'];?></a> </h4>
		<?php 
		  $days_between = ceil(abs(time()-$row_p['time'])/86400);
		  
		  if($days_between<7){
		  ?>
		  <img src="<?php echo $liveSite."/img/new-product.gif";?>" class="new-img">
		  <?php } ?> 
		</div>
		<?php if($count==3||$count_rows==$i)
		{		
			
		?>	
		</div>
		
		<?php } ?>
		<?php $i++;$count++; ?>			
		
	<?php } ?>
	</div>
   
	<?php }
}

?>    
 <!--/Area of Showing Product-->
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
	var url=root+"/cac-san-pham/"+cateId+"/"+pageNo+"/index.html";
	window.location.href=url;	
}
</script>
