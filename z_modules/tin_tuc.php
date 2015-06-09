<?php
$cmid = $cmid + 0;
$r = $db->select("tgp_cms_menu","id IN ('3','10')","ORDER BY id DESC");
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
    <div style="padding-bottom:20px; overflow:hidden">
	<!-- Title -->
     <div style="position:relative; clear:both; margin-bottom:20px">
        <div style="position:absolute">
            <a href="<?php echo $liveSite."/tin-tuc/".$catid."/1/".lg_string::get_link($row['ten'])."\"";?>">
            <img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15"/></a>
        </div>
        <div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
		<a href="<?php echo $liveSite."/danh-muc-".lg_string::get_url($row['ten'])."/".$catid."/1/".lg_string::get_link($row['ten'])."\"";?>"><?php echo $cat['ten'];?></a>
		</div>
      </div>
      <!-- // Title -->
   
		<!-- Show News -->
		<?php 
		
		$p = $db->select("tgp_cms","hien_thi = 1 AND cat IN ('".$catid."')  "," ORDER BY time DESC  limit 6");
		while($row2=$db->fetch($p))
		{
		$img_url=$liveSite."/uploads/cms/".$row2["hinh"];
		?>
		  <div class="itemnews"> 
		  <a href="<?php echo $liveSite.'/tin-tuc-chi-tiet/'.$row2['id'].'/'.lg_string::get_link($row2['ten']).'/'; ?>">
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
			  <h2><a href="<?php echo $liveSite."/tin-tuc-chi-tiet/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>">
			  <?php echo lg_string::crop($row2["ten"],7);
			  	//if($catid==10){
			 	 $days_between = ceil(abs(time()-$row2['time']) / 86400);
			 	 if($days_between<7){
			  ?>
			  <img src="<?php echo $liveSite."/img/new.gif";?>">
			  <?php } 
		//} ?>
			  </a></h2>
			  <p><?php echo lg_string::crop($row2["chu_thich"],24);?></p>
			</div>
		  </div>
	<?php 
		if($catid==10)break;
		}?>
	
		</div>
	<?php 
	}
}

?>    
 <!--/Area of Showing Product-->