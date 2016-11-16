$(function() {
	var offset = $("#divCarrito").offset();
	var topPadding = 15;
	$(window).scroll(function() {
		if ($("#divCarrito").height() < $(window).height() && $(window).scrollTop() > offset.top) {
			$("#divCarrito").stop().animate({
				marginTop: $(window).scrollTop() - offset.top + topPadding
			});
		} else {
			$("#divCarrito").stop().animate({
				marginTop: 0
			});
		};
	});
});
