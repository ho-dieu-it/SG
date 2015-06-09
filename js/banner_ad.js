/**
 * 
 * date 12-10-2015
 */

$(document).ready(function(){
	//console.log(screen.width);
	$screen=screen.width;
	$width=$(window).width();;
	if($screen<1024){
   	 $('#left-ads').css('display','none');
   	 $('#right-ads').css('display','none');
   }else{
	$(window).resize(function(){
		$width=$(window).width();
		if($screen>=1024){
			$('#pageBody').removeAttr('width');
		   	 $('#left-ads').css('display','block');
		   	 $('#right-ads').css('display','block');
		   }
		else {
			$('#left-ads').css('display','none');
		   	 $('#right-ads').css('display','none');
		}
	});
	$doc_height=$(document).height();
	$t=0;
	$offset=$('.scroll-ads').offset();
    $(window).scroll(function () { 
        $height=$(window).height();
        $curr_height=$(window).scrollTop();
        $temp=0;
        if($offset.top<500){
        	$temp=$curr_height-140;
        	$limit_height=$doc_height-520;
        }
        else{
        	$temp=$curr_height-500;
        	$limit_height=$doc_height-700;
        }
        // scroll up
         if($curr_height<$t){
        	 $('.scroll-ads')
  			.stop()
  			.animate({"marginTop": ($temp)<=0?0:$temp},800);
    		}
         else{
        	 //scroll down
        	if($t<$limit_height){
            	 $('.scroll-ads')
     			.stop()
     			.animate({"marginTop": ($temp)<=0?0:$temp},800);
                 }
         }
			$t=$curr_height;
    });
   }
});    