$(document).ready(function () {

  //slick solo funciona en mobile
  if ($(window).width() < 1024) {
    makeSlickGal()
  }

  $(window).resize(function () {
    if ($(window).width() < 1024) { // de escritorio a mobile

      if(!$('.slide_mobile').hasClass('slick-initialized')){
        makeSlickGal()
      }
    } 
    else { // pasa de mobile a escritorio
      // if($('.slide_mobile').hasClass('slick-initialized')){
      //   $('.slide_mobile').slick('unslick');
      // }
      //se elimina el unslick de aqui por conflicto con resize de mobile a desktop
      //eliminaba todos los items dentro del slick al hacer unslick
      //funciona bien por el responsive del propio slick
    }
  }).resize()

  function makeSlickGal(){
    $('.slide_mobile').each(function(index, el) {
      var dots = false
      var slidesToShow = 1
      var rows = 1
      var slidesPerRow = 1
      var slide = ''
      if($(this).attr('data-slidestoshow')){
        slidesToShow = $(this).attr('data-slidestoshow')
      }
      if($(this).hasClass('dots')){
        dots = true
      }
      if($(this).attr('data-rows')){
        rows = $(this).attr('data-rows')
        slidesPerRow = $(this).attr('data-slidesperrow')
      }
     
      $(this).slick({
        infinite: true,
        slidesToShow: slidesToShow,
        slidesToScroll: 1,
        arrows: true,
        nextArrow: '<div class="right-arrow right-arrow--white"><i class="icon icon-chevron-right"></i></div>',
        prevArrow: '<div class="left-arrow left-arrow--white"><i class="icon icon-chevron-left"></i></div>',
        dots: dots,
        dotsClass: 'custom-dots dark',
        rows: rows,
        slidesPerRow: slidesPerRow,
        focusOnSelect: false,
        swipeToSlide: false,
        touchMove: false,
        swipe: true,
        adaptiveHeight: true,
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: "unslick"
          }
        ]
      })
    });
  }

});

