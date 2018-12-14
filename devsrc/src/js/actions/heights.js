$(document).ready(function () {
    //llama funciones de alturas en primer load
    if ($(window).width() >= 1024) { //desktop
        removeHeightHomeHeader()
    }
    else{
        heightHomeHeader()
    }
    //llama funciones de alturas en resize de ventana
    $(window).resize(function () {

        if ($(window).width() >= 1024) { // de escritorio a mobile
           removeHeightHomeHeader()
        }
        else { // pasa de mobile a escritorio
            heightHomeHeader()
        }

    }).resize()
    
    //fix de chrome
    function calcVH($class) {
      var vH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
      document.getElementById($class).setAttribute("style", "height:" + vH + "px;");
    }
    function removeH($class){
        document.getElementById($class).removeAttribute("style");
    }
    function heightHomeHeader(){
        if($('#main-section-home').length){
            calcVH('main-section-home');
            window.addEventListener('onorientationchange', calcVH, true);
        }
    }
    function removeHeightHomeHeader(){
        if($('#main-section-home').length){
            removeH('main-section-home');
        }
    }
})