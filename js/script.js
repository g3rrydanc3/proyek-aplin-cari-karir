function resize() {
	if($('.wrapper').height() + $('.navbar').height() + 60 < $(document).height()){
		$(".wrapper").height($(document).height() - $('.footer').height() - $('.navbar').height() - 60);
	}
}

$(document).ready(function(){
	resize();
	
	$(window).resize(function() {
		$('.wrapper').height(0);
		resize();
	});
});