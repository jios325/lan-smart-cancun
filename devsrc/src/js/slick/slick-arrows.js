$(document).ready(function () {
  $('.slide_arrows').each(function(index, el) {
    $(this).slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      nextArrow: '<div class="right-arrow right-arrow--white"><i class="icon icon-chevron-right"></i></div>',
      prevArrow: '<div class="left-arrow left-arrow--white"><i class="icon icon-chevron-left"></i></div>',
      dots: false,
      focusOnSelect: true,
      adaptiveHeight: true
    })
  });
});

