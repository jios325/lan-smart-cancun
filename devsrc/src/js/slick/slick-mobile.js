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
      if($('.slide_mobile').hasClass('slick-initialized')){
        $('.slide_mobile').slick('unslick');
      }
    }
  }).resize()

  function makeSlickGal(){
    $('.slide_mobile').each(function(index, el) {
      $(this).slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        nextArrow: '<div class="right-arrow right-arrow--white"><i class="icon icon-chevron-right"></i></div>',
        prevArrow: '<div class="left-arrow left-arrow--white"><i class="icon icon-chevron-left"></i></div>',
        dots: true,
        dotsClass: 'custom-dots dark',
        focusOnSelect: true,
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

