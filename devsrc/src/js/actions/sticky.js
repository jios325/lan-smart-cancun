$(document).ready(function () {
	$(window).scroll(function (e) {
		// $('nav').addClass('scrolled')
		var heightCont = $('nav').height()
		if ($(this).scrollTop() >= 40) {
			console.log('sticky')
			$('nav').addClass('fixed_nav')
		}
		else{
			console.log("nosticky")
			$('nav').removeClass('fixed_nav')
		}
  })
})