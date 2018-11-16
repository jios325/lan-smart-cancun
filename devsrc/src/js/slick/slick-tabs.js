$(document).ready(function () {
  $('.slide_tabs').each(function(index, el) {
    $(this).slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      focusOnSelect: true,
      adaptiveHeight: true,
      swipeToSlide: false,
      touchMove: false,
      swipe: false,
    })
  });



  $(function () {
    $('.tabs-navbar').each(function (index, el) {
      $(this).on('click', '.gotoSlide', function (event) {
        event.stopPropagation()
        var slide = $(this).attr('data-slide')

        $(this).parent().siblings('.slide_tabs').slick('slickGoTo', slide)
      
        // quita clase de active, por puro motivo de css
        $(this).addClass('active').siblings('.active').removeClass('active')
      })
      //si existe seccion de tabs
      if($(this).hasClass('tabs--section')){
        //al hacer clic en los tabs, los contenedores se contraen y quedan a su altura original 
        //para evitar alturas diferentes en cada tab y desfazar la altura de la vista
        $(this).on('click', '.gotoSlide', function(event) {
          event.preventDefault();
          /* Act on the event */
          console.log('taaab')
          var tab = $(this).context.classList[4]

          //busca al tab hermano *por ahora solo funciona con 2, puede mejorarse para mas*
          let $tabsSlide = $(this).siblings('.tabs--slide')
          let $tabsSlideChildren = $(this).siblings('.tabs--slide').children('.tabs--slide-content.'+tab).siblings().children('.viewmore_contenido')
          //si la altura es igual a la original, es que está abierto, hay que cerrarlo
          if($tabsSlide.height() != $tabsSlide.attr('data-originalheight')){
            //declara alturas para contenedores 
            var tabsslideheight = $tabsSlide.attr('data-originalheight')
            $tabsSlide.height(tabsslideheight)
            var tabscontentslideheight = $tabsSlideChildren.attr('data-newheight')
            //le quita la clase open a viewmore
            $tabsSlideChildren.height(tabscontentslideheight).removeClass('open')
            //hacer viewmore a boton 
            var $buttonviewmore = $tabsSlideChildren.siblings('.main-section__rest_y_bares--button').children('.viewmore')
            if (lang == 'es') {
                $buttonviewmore.text('VER MÁS')
            } 
            else {
                $buttonviewmore.text('VIEW MORE')
            }
          }

        });
        
      }
    })
  })

});

