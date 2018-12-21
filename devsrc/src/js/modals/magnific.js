export function modalPopup(){
	$('.modal--popup').each(function(index, el) {
		$(this).magnificPopup({
		    // fixedContentPos: false,
		    type: 'inline',
		    removalDelay: 300, // delay removal by X to allow out-animation
		    closeOnContentClick: true
	  	})
	});
}
$(document).ready(function () {	
	//modal texto
		modalPopup()
		
  	//popup de galeria
	  	$('.popup-gallery').magnificPopup({
			delegate: 'a',
			tLoading: 'Loading image #%curr%...',
			type: 'image',
			gallery:{
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1], // Will preload 0 - before current, and 1 after the current image
				arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow %dir%-arrow %dir%-arrow--white"></button>' // markup of an arrow button
				// arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', 
			},
			image: {
		        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		        markup: '<div class="mfp-figure">'+
		        			'<div class="deco-popup backgrounds">'+
		        				'<div class="gradient gradient-popup-dark"></div>'+
		        				'<div class="deco-popup-container no-close">'+
						            '<div class="mfp-close"></div>'+
						            '<div class="mfp-img"></div>'+
						            '<div class="mfp-bottom-bar">'+
						              '<div class="mfp-title"></div>'+
						              '<div class="mfp-counter"></div>'+
						            '</div>'+
						        '</div>'+
					        '</div>'+
				        '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
		    },
		});

  	//popup de galeria solo abre en desktop
		$('.popup-gallery--mobile').magnificPopup({
			delegate: 'a',
			tLoading: 'Loading image #%curr%...',
			type: 'image',
			gallery:{
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1], // Will preload 0 - before current, and 1 after the current image
				arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow %dir%-arrow %dir%-arrow--white"></button>' // markup of an arrow button
				// arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', 
			},
			image: {
		        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		        markup: '<div class="mfp-figure">'+
		        			'<div class="deco-popup backgrounds">'+
		        				'<div class="gradient gradient-popup-dark"></div>'+
		        				'<div class="deco-popup-container no-close">'+
						            '<div class="mfp-close"></div>'+
						            '<div class="mfp-img"></div>'+
						            '<div class="mfp-bottom-bar">'+
						              '<div class="mfp-title"></div>'+
						              '<div class="mfp-counter"></div>'+
						            '</div>'+
						        '</div>'+
					        '</div>'+
				        '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
		    },
		    disableOn: function() {
				if( $(window).width() < 1024 ) {
					return false;
				}
				return true;
			}
		});
})