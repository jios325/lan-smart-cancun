$(document).ready(function () {

  //TEXTO LEER MAS EN HABITACIONES PARA TEXTO DESCRIPTIVO
    var showChar = '200';
    var ellipsestext = "...";
    if (lang == 'es') {
      var moretext = "Leer Más";
      var lesstext = "Leer Menos";
    } else {
      var moretext = "Read More";
      var lesstext = "Read Less";
    }
    $('.more').each(function() {
      var content = $(this).html();
      // var showChar = $(this).attr('data-h');
      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);

        var html = c + '<span class="moreelipses">'+ellipsestext+'</span><span class="morecontent"><span style="display: none;">' + h + '</span>&nbsp;&nbsp;<a rel="noopener noreferrer nofollow" class="morelink" style="font-weight:500; cursor:pointer">'+moretext+'</a></span>';

        $(this).html(html);
      }

    });
    $(".morelink").click(function(){
      if($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
      } else {
        $(this).addClass("less");
        $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
    });
});