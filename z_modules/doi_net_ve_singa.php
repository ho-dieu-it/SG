<p> Home > Đôi nét về Singa</p>
     <div class="detail">
     <div class="detail-news">
	 <?php
	$id	=	$id + 0;
	$r2	=	$db->select("tgp_cms","id = '".$id."'");
	while ($row2 = $db->fetch($r2))
	{	
		$db->update("tgp_cms","luot_xem",$row2["luot_xem"]+1,"id = '".$id."'");
		$url_image=$liveSite."/uploads/cms/".$row2["hinh"];
		$path_img="uploads/cms/".$row2["hinh"];
		if(!file_exists($path_img))
		{
			$url_image=$liveSite."/images/common/noimage.jpg";
		}
		?>		
		 <img src="<?php echo $url_image;?>" alt="" class="img-detailnews" />
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
	}
	?>
	
	</div>

