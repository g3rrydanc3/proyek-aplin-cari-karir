function resize() {
	if($('.wrapper').height() < $(window).height()){
		$(".wrapper").height($(window).height());
	}
}

$(document).ready(function(){
	resize();
	$(window).resize(function() {
		$('.wrapper').height("");
		resize();
	});
	
	$('#accordion').on('shown.bs.collapse', function() {
		$('.wrapper').height("");
		resize()
	});
	$('#accordion').on('hidden.bs.collapse', function() {
		$('.wrapper').height("");
		resize()
	});
});