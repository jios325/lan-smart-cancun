$(document).ready(function () {	
	//modal para habitaciones
	$('.modal--popup').magnificPopup({
	    // fixedContentPos: false,
	    type: 'inline',
	    removalDelay: 300, // delay removal by X to allow out-animation
	    closeOnContentClick: true
  	})

  	//popup de galeria
  	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		tLoading: 'Loading image #%curr%...',
		type: 'image',
		gallery:{
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
	        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
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
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
	        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
	    },
	    disableOn: function() {
			if( $(window).width() < 1024 ) {
				return false;
			}
			return true;
		}
	});
})