<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '307333802678358',
      xfbml      : true,
      version    : 'v2.3'
    },function(response){
		console.log(response);
        });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<p> Home > Thử nghiệm > Chi tiết</p>
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
     <!-- <img src="<?php //echo $url_image; ?>" alt="" class="img-detailnews" /> -->
     <div class="text-detailnews"><h1><?php echo $row2["ten"]?></h1>
   <div >
             <!-- <div class="decription">
				<?php //echo $row2["chu_thich"]?>  
			</div> -->
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
	else{
	?>
	<div class="fb-share-button" data-href="<?php echo $liveSite.$_SERVER['REQUEST_URI']?>" data-layout="button_count"></div>
	<?php }?>
	<div class="box-other-news-list">
          <h3 class="title"> Thông tin khác </h3>
		  <?php
		$r	=$db->select("tgp_cms","cat = '".$row2["cat"]."' and time < '".$row2["time"]."' and hien_thi = 1","order by time desc limit 5");
		while ($row = $db->fetch($r))
		{
		?>
		<div class="video">
			
		
		<p><a href="<?php echo $liveSite.'/thu-nghiem-chi-tiet/'.$row['id'].'/'.lg_string::get_link($row['ten']).'/'; ?>"> 
			<?php echo lg_string::crop($row["ten"],7);?></a></p>
		</div>  
		  
			
			
		<?php
		}
	?>
		  
		  
		  
		
	</div>
	</div>
