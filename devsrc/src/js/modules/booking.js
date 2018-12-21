import moment from 'moment'
import 'select2'
import 'jquery-daterangepicker'

var hotelSeleccionado = '' // contiene valor que obtiene del Load del Hotel
var traducciones = {
  adultos: { es: 'Adultos', en: 'Adults' },
  ninos: { es: 'Niños', en: 'Children' },
  selehotel: { es: 'Selecciona hotel', en: 'Select Hotel' },
  reservar: { es: 'Reservar Ahora', en: 'Book Now' },
  edadnino: { es: 'niño', en: 'Child' },
  hab: { es: 'Hab.', en: 'Room' },
  habitacion: { es: 'Habitacion', en: 'Room' },
  aceptar: { es: 'Aceptar', en: 'Ok' },
  origen: { es: 'Por favor especifique una ciudad', en: 'Please enter a city' },
  from: {es: 'Día de ida', en: 'From'},
  noche: {es: 'Noche', en: 'Night'},
  noches: {es: 'Noches', en: 'Nights'},
  pool: {es: 'Alberca', en: 'Pool Area'},
  bares: {es: 'Bares y Restaurates', en: 'Bars & Restaurants'},
  dias: {es: 'Días', en: 'Days'},
  dia: {es: 'Día', en: 'Day'},
  ocupacion: {es: 'Ocupación Seleccionada', en: 'Occunpancy Selected'},
  edadNinos: {es: 'Edad de los niños', en: 'Age of children'},
  cupon: {es: 'Por favor introduzca un Código de Cupón', en: 'Type in your Code'},
  fecha: {es: 'Por favor introduzca las fechas', en: 'Please, Choose dates'},
  fechaDuplicada: {es: 'Estancia minima de Una noche', en: 'Minimum stay of one night'},
  otrasFechas: {es: 'Por favor selecciona otras fechas', en: 'Please, select a valide date'},
  notFoundResults: {es: 'Resultados no encontrados...', en: 'results not found...'}
}
var hotelMaxPax = {
  'oasis-palm': {
    'destino': 'Oasis Palm',
    'coddestino': 'oasispalm',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'oasis-palmmxn': {
    'destino': 'Oasis Palm',
    'coddestino': 'oasispalmmxn',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'grand-oasis-cancun': {
    'destino': 'Grand Oasis Cancún',
    'coddestino': 'granoasiscancun',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'grand-oasis-cancunmxn': {
    'destino': 'Grand Oasis Cancún',
    'coddestino': 'granoasiscancunmxn',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'oasis-cancun-lite': {
    'destino': 'Oasis Cancun Lite',
    'coddestino': 'oasiscancunlite',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'oasis-cancun-litemxn': {
    'destino': 'Oasis Cancun Lite',
    'coddestino': 'oasiscancunlitemxn',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'grand-oasis-sens': {
    'destino': 'Grand Oasis Sens',
    'coddestino': 'grandoasissens',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'grand-oasis-sensmxn': {
    'destino': 'Grand Oasis Sens',
    'coddestino': 'grandoasissensmxn',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'smart-cancun-by-oasis': {
    'destino': 'Smart Cancún By Oasis',
    'coddestino': 'oasissmart',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'smart-cancun-by-oasismxn': {
    'destino': 'Smart Cancún By Oasis',
    'coddestino': 'oasissmartmxn',
    'maxPax': 4,
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'grand-oasis-palm': {
    'destino': 'Grad Oasis Palm',
    'coddestino': 'grandoasispalm',
    'maxPax': 4, // valor original 5
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'grand-oasis-palmmxn': {
    'destino': 'Grad Oasis Palm',
    'coddestino': 'grandoasispalmmxn',
    'maxPax': 4, // valor original 5
    'MaxAdults': 4,
    'childrenAllowed': true
  },
  'grand-oasis-tulum': {
    'destino': 'Grad Oasis Tulum',
    'coddestino': 'grandoasistulum',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'grand-oasis-tulummxn': {
    'destino': 'Grad Oasis Tulum',
    'coddestino': 'grandoasistulummxn',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'oasis-tulum-lite': {
    'destino': 'Oasis Tulum Lite',
    'coddestino': 'oasistulumlite',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'oasis-tulum-litemxn': {
    'destino': 'Oasis Tulum Lite',
    'coddestino': 'oasistulumlitemxn',
    'maxPax': 4,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'the-pyramid-at-grand-oasis': {
    'destino': 'The Pyramid',
    'coddestino': 'grandoasispyramid',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'the-pyramid-at-grand-oasismxn': {
    'destino': 'The Pyramid',
    'coddestino': 'grandoasispyramidmxn',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': true
  },
  'oh-cancun': {
    'destino': 'Oh! The Urban Oasis',
    'coddestino': 'ohbyoasis',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'oh-cancunmxn': {
    'destino': 'Oh! The Urban Oasis',
    'coddestino': 'ohbyoasismxn',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'the-sian-ka-an-at-grand-tulum': {
    'destino': 'The Sian Ka\'an at Grand Tulum',
    'coddestino': 'siangrandtulum',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'the-sian-ka-an-at-grand-tulummxn': {
    'destino': 'The Sian Ka\'an at Grand Tulum',
    'coddestino': 'siangrandtulummxn',
    'maxPax': 3,
    'MaxAdults': 3,
    'childrenAllowed': false
  },
  'the-sian-ka-an-at-grand-sens': {
    'destino': 'The Sian Ka\'an at Grand Sens',
    'coddestino': 'siangrandsens',
    'maxPax': 2,
    'MaxAdults': 2,
    'childrenAllowed': false
  },
  'the-sian-ka-an-at-grand-sensmxn': {
    'destino': 'The Sian Ka\'an at Grand Sens',
    'coddestino': 'siangrandsensmxn',
    'maxPax': 2,
    'MaxAdults': 2,
    'childrenAllowed': false
  }
}

if ($('.booking').length) {

  //botones abrir y cerrar--------------------
    $('.booking-button').click(function(event) {// abre booking
      /* Act on the event */
      if ($(window).width() >= 1024) { // solo desktop
        $('.booking__fixed').addClass('open')
        $('.booking__intern').addClass('open')
      }
      else {
        $('.booking').addClass('open')
        if($('.booking').hasClass('booking__fixed--mobile') || $('.booking').hasClass('booking__home')){
         $('body').css('overflow', 'hidden')
        }
        
      }
      
    });
    $('.booking-close').click(function(event) { //cierra booking
      /* Act on the event */
      if ($(window).width() >= 1024) { // solo desktop
        $('.booking__fixed').removeClass('open')
        $('.booking__intern').removeClass('open')
      }
      else {
        $('.booking').removeClass('open')
        if($('.booking').hasClass('booking__fixed--mobile') || $('.booking').hasClass('booking__home')){
          $('body').css('overflow', 'auto')
        }
        
      }
      
    });
  //calendario ----------------------------
    var optionCalendar = {
      autoClose: true,
      format: 'DD/MM/YYYY',
      separator: ' - ',
      minDays: 2,
      duration: 100,
      maxDays: 30,
      startDate: moment(new Date()),
      endDate: moment().add(18, 'months'), // cambia dependiendo del
      extraClass: 'custom-calendar',
      singleMonth: 'auto',
      language: lang,
      showTopbar: true, // muestra barra superior
      customTopBar: function () {
        // retorna dias, noches y un boton de cerrar
        return '<span class="icon icon-calendar"></span> <span class="selected-days"><span class="selected-days-num">3 </span>' + traducciones['dias'][lang] + '</span>, <span class="selected-nights"><span class="selected-nights-num">2 </span>' + traducciones['noches'][lang] + '</span> <span class="close-booking"></span>'
      },
      stickyMonths: true,
      setValue: function (s, s1, s2) {
        // console.log(s, s1, s2)
        $('#llegada').val(s)
        $('.EtDateFromGN').val(s1)
        $('.EtDateToGN').val(s2)
      },
      hoveringTooltip: function (days, startTime, hoveringTime) {
        if (days === 1) {
          return traducciones['from'][lang]
        }
        if (days - 1 === 1) {
          return `${(days)} ${traducciones['dia'][lang]} , ${(days - 1)} ${traducciones['noche'][lang]}`
        }
        return `${(days)} ${traducciones['dias'][lang]} , ${(days - 1)} ${traducciones['noches'][lang]}`
      }
    }
    $('#llegada').dateRangePicker(optionCalendar).on('datepicker-change', function (event, obj) {
      // hace calculo de noches para la top bar
      var oneDay = 24 * 60 * 60 * 1000 // hours*minutes*seconds*milliseco
      var diffDays = Math.round(Math.abs((obj.date1.getTime() - obj.date2.getTime()) / (oneDay)))
      $('.selected-nights-num').text(diffDays)
    })
    $('#llegada').data('dateRangePicker').setDateRange(moment().add(7, 'days').format('DD/MM/YYYY'), moment().add(9, 'days').format('DD/MM/YYYY'))
    // llama funcion close en el click del icono cerrar en la top bar
    $('.close-booking').click(function (event) {
      $('#llegada').data('dateRangePicker').close()
    })
  //select2-------------------------------
    $('.adultos_ninos_sel.adultos').select2({
      placeholder: traducciones['adultos'][lang].toUpperCase(),
      theme: 'custom-select--adultos_ninos',
      minimumResultsForSearch: Infinity,

    })
    $('.adultos_ninos_sel.ninos').select2({
      placeholder: traducciones['ninos'][lang].toUpperCase(),
      theme: 'custom-select--adultos_ninos',
      minimumResultsForSearch: Infinity,

    })
  //Valores al cargar la página-------------------------------
      hotelSeleccionado = $('.formHotelHab').attr('data-slug')
      let hotel = getHotel(hotelSeleccionado)
      $('#codDestino').val(hotel.destino)
      $('#hotel').val(hotel.coddestino)
      console.log(hotel.childrenAllowed)
  //cupon
    $('.booking__cupon__label').on('click', function () {
      let $this = $(this)
      $this.hide().next().show().find('input').prop('disabled', false)
    })
    $('.close-cuponInput').on('click', function () {
      let $this = $(this)
      let $container = $this.closest('.booking__cupon__input')
      let $input = $container.find('input')
      $input.prop('disabled', true)
      $container.hide().siblings().show()
    })
  //Funciones -------------------------------
    function getHotel(cveHotel) {
      return hotelMaxPax[cveHotel]
    }
  //send del form-----------------------------------------------
    $('.formHotelHab').submit(function (e) {
      { if (!$('.formHotelHab input[name="codpromo"]').is(':disabled') && $('.formHotelHab input[name="codpromo"]').val() == '') {
        swal({
          title: traducciones['cupon'][lang],
          button: traducciones['aceptar'][lang]
        })
        return false
      } }
      // guardamos busquedas en LocalStorage
      let that = this
      var formData = $(that).serializeArray()
      console.log(formData)
      let dataObj = {}
      $(formData).each(function (index, obj) {
        dataObj[obj.name] = obj.value
      })
      let dataForm = {value: dataObj, time_stamp: new Date().getTime() + (1 * 30 * 60 * 1000)}
      window.localStorage.setItem('searchesHotel', JSON.stringify(dataForm))
    })
  //campos de booking
  // <input type="hidden" name="coddestino" />
  //  <input type="text" name="destino" />
  //  <input type="text" name="entrada" />
  //  <input type="text" name="salida" />
  //  <input type="text" name="adultos" />
  //  <input type="text" name="ninos" />
  //  <input type="text" name="edades" />
  //  <input type="text" name="codpromo" />
  //  <button>Buscar</button>
}