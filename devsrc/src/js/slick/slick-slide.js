$(document).ready(function () {
  $('.slide_slick').each(function(index, el) {
    $(this).slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      focusOnSelect: true,
      adaptiveHeight: true,
      dotsClass: 'custom-dots dark'
    })
  });
});

