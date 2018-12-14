 import {makeSlickGal} from  '../slick/slick-mobile'

 $(document).ready(function () {
  //solo en mobile--------
  //el contenido de los tabs se oculta y se muestra via css por display block o none
  //al cargar los tabs y tener display none, no calcula correctamente la altura del slick, por lo tanto
  //al dar click en una tab, hace unslick y vuelve a hacer slick con un delay.
  $('.tabs-image--item label').each(function(index, el) {
   $(this).click(function(event) {
     /* Act on the event */
    if ($(window).width() < 1024){ //mobile
      if($('.slide_mobile').hasClass('slick-initialized')){
        $('.slide_mobile').slick('unslick')
        setTimeout(function () {
            makeSlickGal()
        },100)
      }
    }
    else{
      console.log($(this).find('label').context.htmlFor)
      var tabSelected = $(this).find('label').context.htmlFor
      // if(!$('.main-section__rest_y_bares--cards'+tabSelected).attr('data-newheight')){
      //   setTimeout(function () {
      //       sizeTabsDeskSpecific(tabSelected)
      //   },100)
      // }
      
    }

   });
  });

  //llama funciones de alturas en primer load
  if ($(window).width() >= 1024) { //desktop
    sizeTabsDesk()
  }
  //llama funciones de alturas en resize de ventana
  $(window).resize(function () {
    if ($(window).width() >= 1024) { // de escritorio a mobile
       sizeTabsDesk()
    }
    // else { // pasa de mobile a escritorio
    //     sizeTabsMob()
    // }
  }).resize()
  function sizeTabsDesk(){
    console.log('desktop')
    $('.main-section__rest_y_bares--cards').each(function(index, el) {
        var heightContainer = $(this).height()
        console.log(heightContainer)
        //guarda altura original en data para futuras animaciones
        $(this).attr('data-originalheight', heightContainer)

        //altura de cada item del contenedor
        var heightItem = $(this).children('.main-section__rest_y_bares--cards--item').height()
        //calculo de altura de numero de filas en base a altura de item
        var itemRows = (heightContainer / heightItem)
        //solo se van a mostrar dos filas, por lo que hace calculo de cuantas se deben ocultar
        var eliminateRows = (itemRows - 2 )
        //altura a ocultar en base a las filas
        var heightToHide = (heightItem * eliminateRows)
        //nueva altura a asignar
        var newHeight = (heightContainer - heightToHide)
        //asigna altura y attr para futuras funciones
        $(this).height(newHeight).attr('data-newheight', newHeight)
        //altura de contenedor de cards mas el resto del contenido para asignarlo al padre
        // var heightTotal = $(this).parent().height()
        // $(this).parent().parent().height(heightTotal).attr('data-originalheight', heightTotal)
    });
  }
  function sizeTabsDeskSpecific(tab){
    console.log('desktop')
    $('.main-section__rest_y_bares--cards.'+tab).each(function(index, el) {
        var heightContainer = $(this).height()
        console.log(heightContainer)
        //guarda altura original en data para futuras animaciones
        $(this).attr('data-originalheight', heightContainer)

        //altura de cada item del contenedor
        var heightItem = $(this).children('.main-section__rest_y_bares--cards--item').height()
        //calculo de altura de numero de filas en base a altura de item
        var itemRows = (heightContainer / heightItem)
        //solo se van a mostrar dos filas, por lo que hace calculo de cuantas se deben ocultar
        var eliminateRows = (itemRows - 2 )
        //altura a ocultar en base a las filas
        var heightToHide = (heightItem * eliminateRows)
        //nueva altura a asignar
        var newHeight = (heightContainer - heightToHide)
        //asigna altura y attr para futuras funciones
        $(this).height(newHeight).attr('data-newheight', newHeight)
        //altura de contenedor de cards mas el resto del contenido para asignarlo al padre
        // var heightTotal = $(this).parent().height()
        // $(this).parent().parent().height(heightTotal).attr('data-originalheight', heightTotal)
    });
  }
});
