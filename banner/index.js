$j(function(){
  var toggles = $j('.toggle a'),
      codes = $j('.code');
  
  toggles.on("click", function(event){
    event.preventDefault();
    var $jthis = $j(this);
    
    if (!$jthis.hasClass("active")) {
      toggles.removeClass("active");
      $jthis.addClass("active");
      codes.hide().filter(this.hash).show();
    }
	});
	if($j('#nghile').length>0){
	  $j('#nghile').advScroll({
			easing:'',
			timer:1000
		});
	}
	try{
		var winW = $j(window).width();
		var imgW = 1920;//$j('.banner').width();
		var _left = parseInt((winW-imgW)/2);
		$j('.travel .banner').css('margin-left', _left +'px');
	}catch(ex){}/**/
});

(function($){
	try{
	$j.fn.advScroll = function(option) {
		$j.fn.advScroll.option = {
			marginTop:0,
			easing:'',
			timer:400
		};
		option = $j.extend({}, $j.fn.advScroll.option, option);
        var _w = $j(document).height() - 95;
		var scroll = parseInt($j(window).scrollTop());
        var bottom = parseInt($j(".page").innerHeight()) ;
		var heightBot = parseInt($j("body footer").innerHeight()) ;
		var _t = parseInt(bottom - 600);
		return this.each(function(){
			var el = $j(this);
			$j(window).scroll(function(){
			    if (parseInt($j(window).scrollTop()) <= 464) { t = 0; }
			    else {t = parseInt($j(window).scrollTop()) + option.marginTop;}
				if (t > 464) t = t - 464;
				if ( t > _t) t = t - heightBot + 300;
				el.stop().animate({marginTop:t},option.timer,option.easing);
			})
		});
	};
	}catch(ex){}/**/
})(jQuery);
$j(window).resize(function() {
	try{
	var winW = $j(window).width();
	var imgW = 1920;//$j('.banner img').width();
	var _left = parseInt((winW-imgW)/2);
	$j('.travel .banner').css('margin-left', _left +'px');
	}catch(ex){}
});/**/