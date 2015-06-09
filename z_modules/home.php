<!-- Đôi nét về Singa -->	  
<div class="about-us">
        <h2>
			<!-- Title -->
			<?php
				//========================================== 
				$r2	= $db->select("tgp_cms","hien_thi = 1 AND cat IN ('6') ","order by time desc limit 1");
				$r_menu1	= $db->select("tgp_cms_menu","hien_thi = 1 AND id IN ('6')","");
				$row_doinet=array();
				while($row = $db->fetch($r2))
				{					
					$row_doinet=$row;
				}
				while($row = $db->fetch($r_menu1))
				{
			?>
		 <div style="position:relative; clear:both; margin-bottom:20px">
			<div style="position:absolute">
			<a href="<?php echo $liveSite."/doi-net-ve-singa/".$row_doinet["id"]."/".lg_string::get_link($row_doinet['ten'])."\"";?>" />
			<img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15" usemap="#Map2" border="0" />
			</a>
			 
			</div>
			<div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
			<?php echo $row['ten'];?>
			</div>
		  </div>
		  <?php } ?>
      <!-- // Title -->
			<?php
				$r_menu	= $db->select("tgp_cms_menu","hien_thi = 1 AND cat IN ('6')");
				while($row = $db->fetch($r_menu1))
				{
			?>
			  <img src="<?php echo $liveSite;?>/img/h2-about.gif" width="570" height="19" usemap="#Map2">
			  <map name="Map2">
				<area shape="rect" coords="526,5,556,13" href="#">
			  </map>
			  <?php } ?>
        </h2>
		<?php
			$r2	= $db->select("tgp_cms","hien_thi = 1 AND cat IN ('6') ","order by time desc limit 1");
			while ($row2 = $db->fetch($r2))
			{
		?>
        <div class="inner-ab"> 
		<a href="<?php echo $liveSite."/doi-net-ve-singa/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>">
			<img src="<?php echo $liveSite;?>/uploads/cms/<?php echo $row2["hinh"];?>" class="img-about">
		</a>
          <a href="<?php echo $liveSite."/doi-net-ve-singa/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>">
		  <p><?php echo lg_string::crop($row2["chu_thich"],24);?></p>
		  </a>
        </div>
		<?php } ?>
      </div>	
<!-- // -->	  
<!-- Tin tức -->	  
<div class="news">
			<!-- Title -->
			<?php
				$r_menu1	= $db->select("tgp_cms_menu","hien_thi = 1 AND id IN ('3')","");
				while($row = $db->fetch($r_menu1))
				{
			?>
		 <div style="position:relative; clear:both; margin-bottom:20px">
			<div style="position:absolute;padding-bottom:10px;">
			<a  href="<?php echo $liveSite."/tin-tuc/".$catid."/index.html";?>" />
			<img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15" usemap="#Map2" border="0" />
			</a>
			 
			</div>
			<div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
			<?php echo $row['ten'];?>
			</div>
		  </div>
		  <?php } ?>
      <!-- // Title -->
<div class="inner-news">
<?php
		$r2	= $db->select("tgp_cms","hien_thi = 1 AND cat IN ('3','2') ","order by time desc limit 12");
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
			  <h2><a href="<?php echo $liveSite."/tin-tuc-xem/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>"><?php echo lg_string::crop($row2["ten"],7);?></a></h2>
			  <p><a href="<?php echo $liveSite."/tin-tuc-xem/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>"><?php echo lg_string::crop($row2["chu_thich"],24);?></a></p>
			</div>
		  </div>
			
		<?php
		}
	?>
 
</div>
</div>
<!-- // -->	  

