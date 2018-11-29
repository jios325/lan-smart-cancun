$(document).ready(function () {
	$(window).scroll(function (e) {
		// Scroll Menu!!--------------------------------------------------------------
		if(!$('nav').hasClass('intern__nav')){ //solo en home
			var heightCont = $('nav').height()
			if ($(this).scrollTop() >= 40) {
				console.log('sticky')
				$('nav').addClass('fixed_nav')
				$('nav').children('.principal').find('.logo_field').find('a').find('img').hide()
				$('nav').children('.principal').find('.logo_field').find('a').find('i').show()
				
			}
			else{
				console.log("nosticky")
				$('nav').removeClass('fixed_nav')
				$('nav').children('.principal').find('.logo_field').find('a').find('img').show()
				$('nav').children('.principal').find('.logo_field').find('a').find('i').hide()
			}
		}
		// Booking de HOME!!--------------------------------------------------------------
		//checa si existe booking
		if ($('.booking').height()) {
			//si es booking de home
			if ($('.booking').hasClass('booking__home')) {
				//altura de contenedor donde se encuentra el booking
				var heightCont = $('.main-section__home-head_home').height()
				console.log(heightCont, 'height section')
				// Booking de HOME - DESKTOP!!--------------------------------------------------------------
				if ($(window).width() >= 1024) { // desktop
					var percent = (8 / 100) * heightCont
					var totalHeight = heightCont - $('.principal').height()
					console.log(percent, 'desk')
					console.log(totalHeight, 'desk')
				}
				// else if ($(window).width() >= 768) { //tablet
				// 	//padding de 20 sobre el botton de booking
				// 	var totalHeight = heightCont - $('.mobile_bar').height() - $('.booking').height() - 20
				// 	console.log(totalHeight, 'tablet')
				// }
				// Booking de HOME - MOBILE!!--------------------------------------------------------------
				else { // mobile
					var totalHeight = heightCont - $('.mobile_bar').height() - $('.booking').height()
					console.log(totalHeight, 'mob')
				}

				//---//

				// animacion para cambios de tamaño y sticky de booking ----------------------------------
		        if ($(this).scrollTop() >= totalHeight) { // medida desde caja hasta top en home//hace sticky
		          if ($(window).width() >= 1024) { // solo desktop
		            $('.booking').addClass('booking__fixed')
		            $('.booking .booking-container').addClass('booking-container__fixed')
		          } 
		          else {
		            $('.booking').addClass('booking__fixed--mobile')
		          }
		        } 
		        else if ($(this).scrollTop() <= totalHeight) {
		          if ($(window).width() >= 1024) { // solo desktop
		            $('.booking').removeClass('booking__fixed') 
		            $('.booking .booking-container').removeClass('booking-container__fixed')
		          } 
		          else {
		            $('.booking').removeClass('booking__fixed--mobile')
		          }
		        }
			}
		}
  })

  // al hacer resize quita clases
  var windowWidthBooking = $(window).width()
  $(window).on('resize', function () {
    if ($(window).width() != windowWidthBooking) {
      windowWidthBooking = $(this).width()
      if (windowWidthBooking >= 1024) { //desktop
        $('.booking').removeClass('booking__fixed--mobile')
      } 
      else if (windowWidthBooking < 1024) { //mob
        $('.booking').removeClass('booking__fixed')
        $('.booking .booking-container').removeClass('booking-container__fixed')
      }
    }
  })
})