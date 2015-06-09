
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
<p> Home > Tin nội bộ > Chi tiết</p>
      <div class="detail">
     <div class="detail-news">
	 <?php
		$db->update("tgp_cms","luot_xem",$row2["luot_xem"]+1,"id = '".$id."'");
		$url_image=$liveSite."/uploads/cms/".$row2["hinh"];		
		$path_img="uploads/cms/".$row2["hinh"];
		if(!file_exists($path_img))
		{
			
			$url_image=$liveSite."/images/common/noimage.jpg";
		}
		?>		
     <img src="<?php echo $url_image; ?>" alt="" class="img-detailnews" />
     <div class="text-detailnews"><h1><?php echo $row2["ten"]?></h1>
   <div >
            <div class="decription">
				<?php echo $row2["chu_thich"]?>  
			</div>
            <br class="clear">
			<?php echo $row2["noi_dung"]?>
           </div>
     </div> 
     </div>
        <?php
    	
	if ($db->num_rows($r2) == 0)
	{
		echo "<h3>Bài viết này không tồn tại.</h3>";
	}
	?>
	<div class="box-other-news-list">
          <h3 class="title"> Thông tin khác </h3>
		<?php
		$r = $db->select("tgp_cms","cat = '".$row2["cat"]."' and time < '".$row2["time"]."' and hien_thi = 1","order by time desc limit 5");
		if ($db->num_rows($r) != 0)
		{
			//echo "<br><img src='/images/more_post.jpg' />";
		}
		while ($row = $db->fetch($r))
		{?>
		<div> <a href="<?php echo $liveSite;?>/ca-phe-chia-se-chi-tiet/<?php echo $row["id"]?>/<?php echo lg_string::get_link($row["ten"])?>" title="H5N1 CHƯA QUA - H7N9 ĐÃ ĐẾN">
		<?php echo $row["ten"]?></a> </div>	
        
          
         
		<?php }
		?>
	</div>
	</div>

<?php } ?>