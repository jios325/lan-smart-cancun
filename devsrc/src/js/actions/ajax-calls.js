$(document).ready(function () {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
	$('a.setRestBar').each(function(index, el) {
		$(this).click(function(e) {
			/* Act on the event */
			e.preventDefault();
			if(lang == 'es'){
				var urlRedirect = '/es/'+$(this).data('slug')+'/restaurantes_y_bares'
			}
			else{
				var urlRedirect = '/en/'+$(this).data('slug')+'/restaurants_and_bars'
			}
			
			$.ajax({
		      url: `/${(lang === 'es' ? 'es' : 'en')}/ajax/set_restbar`,
		      method: 'POST',
		      data: {
		      	"restBar": $(this).data('type')
		      },
		      success: function (data) {
		        console.log(data)
		        window.location.href = urlRedirect
		      }
		    })
		});
	});
})