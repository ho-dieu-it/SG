<?php if($row2&&$type='cms'){?>
<meta property="og:type"               content="article" />
<meta property="og:image"              content="<?php echo $liveSite.'/uploads/cms/'.$row2['hinh'];?>"/>
<meta property="og:title"              content="<?php echo $row2['ten'];?>"/>
<meta property="og:site_name"              content="singa.com.vn"/>
<meta property="og:url"                content="<?php echo $liveSite.$_SERVER['REQUEST_URI']?>" />
<meta property="og:description"        content="<?php echo $row2['chu_thich'];?>" />
<?php 
}
else {?>
<meta property="og:type"               content="article" />
<meta property="og:image"              content="http://singa.com.vn/uploads/cms/154.jpg"/>
<meta property="og:title"              content="Singa"/>
<meta property="og:site_name"              content="singa.com.vn"/>
<meta property="og:url"                content="url" />
<meta property="og:description"        content="description" />
<?php }?>