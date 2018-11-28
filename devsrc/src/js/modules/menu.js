$(document).ready(function () {
	$('.button_open').click(function(event) {
		/* Act on the event */
		if(!$('.principal').hasClass('opened')){
			$('.principal').addClass('opened');
			$('body').css('overflow', 'hidden')
		}
	});
	$('.button_close').click(function(event) {
		/* Act on the event */
		if($('.principal').hasClass('opened')){
			$('.principal').removeClass('opened');
			$('body').css('overflow', 'auto')
		}
	});
	$('.has_submenu').each(function(index, el) {
		$(this).hover(function() {
			$(this).find('.submenu').stop().slideDown("400");
			$(this).find('a').toggleClass('open');
		}, function() {
			/* Stuff to do when the mouse leaves the element */
			$(this).find('.submenu').slideUp("400")
			$(this).find('a').toggleClass('open');
		});
	});
	if($('nav').hasClass('intern__nav')){
		$('nav').children('.principal').find('.logo_field').find('a').find('img').hide()
		$('nav').children('.principal').find('.logo_field').find('a').find('i').show()
	}
			
})