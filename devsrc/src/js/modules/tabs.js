import {makeSlickGal} from  '../slick/slick-mobile'
import {modalPopup} from  '../modals/magnific' 

$(document).ready(function () {
  // Llama funciones de alturas en primer load --------------------------------------------------------------
    if ($(window).width() >= 1024) { //desktop
      sizeTabsDesk()
    }
  // Llama funciones de alturas en resize de ventana --------------------------------------------------------
    $(window).resize(function () {
      if ($(window).width() >= 1024) { // escritorio
         sizeTabsDesk()
         modalPopup()
      }
    }).resize()
  // Click de cada tab --------------------------------------------------------------------------------------
    $('.tabs-image--item label').each(function(index, el) {
      $(this).click(function(event) {
        /* Act on the event */
        if ($(window).width() < 1024){ //mobile
          //solo en mobile 
          //el contenido de los tabs se oculta y se muestra via css por display block o none
          //al cargar los tabs y tener display none, no calcula correctamente la altura del slick, por lo tanto
          //al dar click en una tab, hace unslick y vuelve a hacer slick con un delay.
          if($('.slide_mobile').hasClass('slick-initialized')){
            $('.slide_mobile').slick('unslick')
            setTimeout(function () {
                makeSlickGal()
                modalPopup()
            },100)
          }
        }
        else{ //desktop
          var tabSelected = $(this).find('label').context.htmlFor
          //si no tiene altura asignada el tab seleccionado, se le asigna
          if($('.main-section__rest_y_bares--cards.'+tabSelected).attr('data-originalheight') == 0){
            setTimeout(function () {
                sizeTabsDeskSpecific(tabSelected)
                modalPopup()
            },100)
          }
        }
      });
    });
  //oculta los cuadros de restaurantes y solo muestra 2 lineas en escritorio --------------------------------
    function sizeTabsDesk(){
      console.log('desktop')
      $('.main-section__rest_y_bares--cards').each(function(index, el) {
        sizes($(this))
      });
    }
  //oculta los cuadros de el tab especificado y solo muestra 2 lineas en escritorio -------------------------
    function sizeTabsDeskSpecific(tab){
      console.log('desktop specific')
      $('.main-section__rest_y_bares--cards.'+tab).each(function(index, el) {
        sizes($(this))
      });
    }
  //funcion que hace todos los calculos de alturas para ocultar el resto de contenido -----------------------
    function sizes(element) {
      var heightContainer = element.height()
      //guarda altura original en attr para futuras acciones
      if(!element.attr('data-originalheight') || element.attr('data-originalheight') == 0){ //si aun no tiene asignada altura original, la asigna
        element.attr('data-originalheight', heightContainer)
      }
      //altura de cada item del contenedor
      var heightItem = element.children('.main-section__rest_y_bares--cards--item').height()
      //calculo de altura de numero de filas en base a altura de item
      var itemRows = (heightContainer / heightItem)
      //solo se van a mostrar dos filas, por lo que hace calculo de cuantas se deben ocultar
      var eliminateRows = (itemRows - 2 )
      //altura a ocultar en base a las filas
      var heightToHide = (heightItem * eliminateRows)
      //nueva altura a asignar
      var newHeight = (heightContainer - heightToHide)
      //asigna altura y attr para futuras funciones
      element.height(newHeight).attr('data-newheight', newHeight)
    }
  // boton ver mas ------------------------------------------------------------------------------------------
    $('.viewmore').each(function(index, el) {
      let $this = $(this)
      let $content = $this.parent().siblings('.viewmore_contenido')
      $(this).on('click', function(event) {
          /* Act on the event */
           console.log('click')
          if (!$content.hasClass('open')) { // al "abrir" con el boton
              $content.css({
                  height: $content.attr('data-originalheight') + 'px'
              }).addClass('open')
              if (lang == 'es') {
                  $this.text('VER MENOS')
              } 
              else {
                  $this.text('VIEW LESS')
              }
          } 
          else { //al "cerrar" con el boton
              $content.css({
                  height: $content.attr('data-newheight') + 'px'
              }).removeClass('open')
              if (lang == 'es') {
                  $this.text('VER MÁS')
              } 
              else {
                  $this.text('VIEW MORE')
              }
          }

      });    
    });
});


