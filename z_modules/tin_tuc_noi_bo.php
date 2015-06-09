
<?php 	
	if($_SESSION['tinnb']!="ok")
	{
	?>
	<div class="news">
		<p> Home > Tin nội bộ</p>
		<div class="detail">
		<div class="inner-news">
				Bạn không có quyền truy cập !
				</div>
		</div>
		</div>
	<?php }
	else {
?>

<div class="news">
<p> Home > Tin nội bộ</p>
<div class="detail">
<div class="inner-news">
<?php
		$r2	= $db->select("tgp_cms","hien_thi = 1 AND cat IN ('5')  ","order by time desc limit 12");
		while ($row2 = $db->fetch($r2))
		{
		?>
		<div class="itemnews"> 
		  <a href="<?php echo $liveSite.'/tin-tuc-noi-bo-chi-tiet/'.$row2['id'].'/'.lg_string::get_link($row2['ten']).'/'; ?>">
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
			  <h2><a href="<?php echo $liveSite."/tin-tuc-noi-bo-chi-tiet/".$row2["id"]."/".lg_string::get_link($row2["ten"])."\"";?>"><?php echo lg_string::crop($row2["ten"],7);?></a>
			   <?php 
			 	 $days_between = ceil(abs(time()-$row2['time']) / 86400);
			 	 if($days_between<7){
			  ?>
			  <img src="<?php echo $liveSite."/img/new.gif";?>">
			  <?php } ?></h2>
			  <p><?php echo lg_string::crop($row2["chu_thich"],24);?></p>
			</div>
		  </div>
			
		<?php
		}
	?>
 
</div>
</div>
</div>
<?php } ?>

