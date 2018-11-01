$(document).ready(function () {
	$('.button_open').click(function(event) {
		/* Act on the event */
		if(!$('.principal').hasClass('opened')){
			$('.principal').addClass('opened');
		}
	});
	$('.button_close').click(function(event) {
		/* Act on the event */
		if($('.principal').hasClass('opened')){
			$('.principal').removeClass('opened');
		}
	});
})