$(document).ready(function () {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
  $('#condiciones-de-uso , .condiciones-de-uso').each(function (index, el) {
    $(this).on('change', function (e) {
      console.log(e)
      var $this = $(this)
      var target = $this.closest('.form').find('input[type=submit]')
      if ($(this).is(':checked')) {
        target.prop('disabled', false)
      } else {
        target.prop('disabled', true)
      }
    })
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
	//Newsletter
	$('#newsletter-form').on('submit', function (e) {
    e.preventDefault()
    var data = $(this).serialize()
    var hotel = $(this).find('input[name=hotel]').val()
    console.log(`/${(lang === 'es' ? 'es' : 'en')}/ajax/subscribe/` + hotel)
    $.ajax({
      url: `/${(lang === 'es' ? 'es' : 'en')}/ajax/subscribe/` + hotel,
      method: 'POST',
      data: data,
      success: function (data) {
        console.log(data)
        success(data)
      },
      error: function (data) {
        console.log(data.responseJSON)
        set_errors(data.responseJSON)
      }
    })
  })
  // Confirmacion newsletter
  $('#form-contacto-subcripcion').on('submit', function (e) {
    e.preventDefault()
    var idSlug = $('#idSlug')
    var data = $(this).serialize()

    console.log(data)
    $.ajax({
      url: '/api/ajax/subscribe/' + idSlug,
      method: 'POST',
      data: data,
      beforeSend: function () {
        $('#form-contacto-subcripcion input[type=submit]').prop('disabled', true)
        $('#form-contacto-subcripcion').css('opacity', '0.4')
      },
      success: function (data) {
        console.log(data)
        swal(data)
        setTimeout(function () {
          document.location.href = '/'
        }, 2000)
      },
      error: function (data) {
        console.log(data.responseJSON)
        set_errors(data.responseJSON)
      },
      complete: function () {
        $('#form-contacto-subcripcion').css('opacity', '1')
        $('#form-contacto-subcripcion input[type=submit]').prop('disabled', false)
      }
    })
  })

  function set_errors (d) {
	  $.each(d, function (i, v) {
	    var tmp = $("[name*='" + i + "']")
	    $(tmp).siblings('.alert-message').detach()
	    $(tmp).after('<small class="alert-message" style="color: red">' + v + '</small>')
	  })
	}
	function success (d) {
	  swal(d)
	}
})