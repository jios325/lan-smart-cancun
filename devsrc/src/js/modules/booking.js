import moment from 'moment'
import 'jquery-daterangepicker'

var traducciones = {
  adultos: { es: 'Adultos', en: 'Adults' },
  ninos: { es: 'Niños', en: 'Children' },
  selehotel: { es: 'Seleccione hotel', en: 'Select Hotel' },
  edadnino: { es: 'niño', en: 'Child' },
  hab: { es: 'Hab.', en: 'Room' },
  aceptar: { es: 'Aceptar', en: 'Ok' },
  origen: { es: 'Por favor especifique una ciudad', en: 'Please enter a city' },
  from: {es: 'Día de ida', en: 'From'},
  noche: {es: 'Noche', en: 'Night'},
  noches: {es: 'Noches', en: 'Nights'},
  pool: {es: 'Alberca', en: 'Pool Area'},
  bares: {es: 'Bares y Restaurates', en: 'Bars & Restaurants'},
  dias: {es: 'Días', en: 'Days'},
  dia: {es: 'Día', en: 'Day'},
  cupon: {es: 'Por favor introduzca un Código de Cupón', en: 'Type in your Code'},
  notFoundResults: {es: 'Resultados no encontrados...', en: 'results not found...'}
}

if ($('.booking').length) {
  $('.booking-button').click(function(event) {
    /* Act on the event */
    $('.booking__fixed').addClass('open')
  });

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
    console.log('hola')
    // hace calculo de noches para la top bar
    var oneDay = 24 * 60 * 60 * 1000 // hours*minutes*seconds*milliseco
    var diffDays = Math.round(Math.abs((obj.date1.getTime() - obj.date2.getTime()) / (oneDay)))
    $('.selected-nights-num').text(diffDays)
  })
  // llama funcion close en el click del icono cerrar en la top bar
  $('.close-booking').click(function (event) {
    $('#llegada').data('dateRangePicker').close()
  })
}