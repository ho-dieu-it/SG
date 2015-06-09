<?php
$cmid = $cmid + 0;
$r = $db->select("tgp_product_menu");

if ($db->num_rows($r) == 0)
{
	$cmid = 0;
}
else
{
	while ($row = $db->fetch($r))
	{	
		$catid= $row['id'];
		$cat = $row;
		?>
		<div id="content">
    <div style="padding-bottom:20px; overflow:hidden">
	<!-- Title -->
     <div style="position:relative; clear:both; margin-bottom:20px">
        <div style="position:absolute">
            <a href="<?php echo $liveSite."/cac-san-pham/".$catid."/1/".lg_string::get_link($row['ten'])."\"";?>">
            <img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15"/></a>
        </div>
        <div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
		<a href="<?php echo $liveSite."/cac-san-pham/".$catid."/1/".lg_string::get_link($row['ten'])."\"";?>">
		<?php echo $cat['ten'];?>
		</a>
		</div>
      </div>
      <!-- // Title -->
   
		<!-- Show Product -->
		<?php 
		$p = $db->select("tgp_product","hien_thi = 1 AND cat IN ('".$cat['id']."')  "," ORDER BY thu_tu DESC  limit 3");
		while($row_p=$db->fetch($p))
		{
		$img_url=$liveSite."/uploads/product/".$row_p["hinh"];
		?>
		 		  
		 <div class="inner-product"> <a title="" href="<?php echo $liveSite."/san-pham-xem/".$row_p["id"]."/".lg_string::get_link($row_p['ten'])."\"";?>" rel="gallery1" class="fancybox">
	  
	  <img  title="<?php echo $row_p["chu_thich"];?>"  class="img-product" alt="" src="<?php echo $img_url;?>"> </a>
        <h4> <a href="<?php echo $liveSite."/san-pham-xem/".$row_p["id"]."/".lg_string::get_link($row_p['ten'])."\"";?>" rel="gallery1" class="fancybox">
		<?php echo $row_p['ten'];?></a> </h4>
		<?php 
		  $days_between = ceil(abs(time()-$row_p['time'])/86400);
		  
		  if($days_between<7){
		  ?>
		  <img src="<?php echo $liveSite."/img/new-product.gif";?>" class="new-img">
		  <?php } ?> 
      </div>
	<?php } ?>
		</div>
    </div>
	<?php }
}

?>    
 <!--/Area of Showing Product-->