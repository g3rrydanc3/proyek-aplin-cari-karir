
function resize() {
	if($('.wrapper').height() + $('.navbar').height() + 300 < $(document).height()){
		$(".wrapper").height($(document).height() - $('.footer').height() - $('.navbar').height() + 50);
	}
}

$(document).ready(function(){
	resize();
	var bottom = false;
	var lastScrollTop = 0;
	$(window).scroll(function() {
		var st = $(this).scrollTop();
		if (st > lastScrollTop){
			if($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
				if(!bottom){
					 $('html, body').animate({
						scrollTop: $("footer").offset().top
					}, 100);
					bottom = true;
				}
			}
			else{
				bottom = false;
			}
		} else {
			if(bottom && $(window).scrollTop() + $(window).height() + 50 > $(document).height()) {
				 $('html, body').animate({
					scrollTop: $("footer").offset().top - $(window).height()
				}, 100);
				bottom = false;
			}
		}
		lastScrollTop = st;
	});
	
	
	$(window).resize(function() {
		$('.wrapper').height(0);
		resize();
	});
});