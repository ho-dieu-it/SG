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
<p> Home > Sản phẩm > Chi tiết</p>
      <div class="detail">
     <div class="detail-news">
    <!--  <img src="<?php echo $liveSite;?>/uploads/product/<?php echo $row2["hinh"]?>" alt="" class="img-detailnews" />
	-->
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
          <h3 class="title"> Các sản phẩm liên quan</h3>
		<?php
		$r = $db->select("tgp_product","cat = '".$row2["cat"]."' and id <>  '".$row2["id"]."' and hien_thi = 1","order by time desc limit 5");
		if ($db->num_rows($r) != 0)
		{
			//echo "<br><img src='/images/more_post.jpg' />";
		}
		while ($row = $db->fetch($r))
		{?>
		<div> <a href="<?php echo $liveSite;?>/san-pham-xem/<?php echo $row["id"]?>/<?php echo lg_string::get_link($row["ten"])?>" title="H5N1 CHƯA QUA - H7N9 ĐÃ ĐẾN">
		<?php echo $row["ten"]?></a> </div>	
        
          
         
		<?php }
		?>
	</div>
	</div>

