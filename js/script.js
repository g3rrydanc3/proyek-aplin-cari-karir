function resize() {
	if($('.wrapper').height() < $(window).height()){
		$(".wrapper").height($(window).height());
	}
}

$(document).ready(function(){
	resize();
	$(window).resize(function() {
		$('.wrapper').height(0);
		resize();
	});
});