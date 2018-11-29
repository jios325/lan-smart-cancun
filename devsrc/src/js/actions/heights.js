$(document).ready(function () {
    //llama funciones de alturas en primer load
    if ($(window).width() >= 1024) { //desktop
        sizeTabsDesk()
        removeHeightHomeHeader()
    }
    else{
        sizeTabsMob()
        heightHomeHeader()
    }
    //llama funciones de alturas en resize de ventana
    $(window).resize(function () {

        if ($(window).width() >= 1024) { // de escritorio a mobile
           sizeTabsDesk()
           removeHeightHomeHeader()
        }
        else { // pasa de mobile a escritorio
            sizeTabsMob()
            heightHomeHeader()
        }

    }).resize()


    function sizeTabsDesk(){
        console.log('desktop')
        $('.main-section__rest_y_bares--cards').each(function(index, el) {
            var heightContainer = $(this).height()
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
            var heightTotal = $(this).parent().height()
            $(this).parent().parent().height(heightTotal).attr('data-originalheight', heightTotal)
        });
    }

    function sizeTabsMob(){
        console.log('mobile')
        if(!$('.tabs--slide').hasClass('ismobile')){
            $('.main-section__rest_y_bares--cards').each(function(index, el) {
                var heightContainer = $(this).height()
                //guarda altura original en data para futuras animaciones
                $(this).attr('data-originalheight', heightContainer)
                //altura de cada item del contenedor
                var heightItem = $(this).children('.main-section__rest_y_bares--cards--item').height()
                //nueva altura a asignar 2 items en slide
                var newHeight = heightItem * 2
                console.log(heightItem)
                console.log(newHeight)
                //asigna altura y attr para futuras funciones
                $(this).height(newHeight).attr('data-newheight', newHeight)
            });
            $('.tabs--slide').each(function(index, el) {
                var heightTotal = $(this).children('.tabs--slide-content:first-child').height()
                console.log(heightTotal)
                $(this).height(heightTotal).attr('data-originalheight', heightTotal)
                $(this).addClass('ismobile')
            });
        }
        

       
        // //altura de contenedor de cards mas el resto del contenido para asignarlo al padre
        //     var heightTotal = $(this).parent().height()
        //     $(this).parent().parent().height(heightTotal).attr('data-originalheight', heightTotal)
    }
    //boton ver mas
    $('.viewmore').each(function(index, el) {
        let $this = $(this)
        let $content = $this.parent().siblings('.viewmore_contenido')
        //si existe padre contenedor, asigna altura
        if ($('.tabs--slide').length) {
            var $parent = $content.parent().parent()
        }
        $(this).on('click', function(event) {
            /* Act on the event */
            
            if (!$content.hasClass('open')) {
                $content.css({
                    height: $content.attr('data-originalheight') + 'px'
                }).addClass('open')
                //agrega altura a contenedor padre relativo
                if ($('.tabs--slide').length) {
                    var newh = Number($parent.attr('data-originalheight')) - Number($content.attr('data-newheight')) + Number($content.attr('data-originalheight'))
                    $('.tabs--slide').css({
                        height: newh + 'px'
                    }).attr('data-newheight' , newh)
                }
                if (lang == 'es') {
                    $this.text('VER MENOS')
                } 
                else {
                    $this.text('VIEW LESS')
                }
            } 
            else {
                $content.css({
                    height: $content.attr('data-newheight') + 'px'
                }).removeClass('open')
                //quita altura a contenedor padre relativo
                if ($('.tabs--slide').length) {
                    $('.tabs--slide').css({
                        height: Number($parent.height()) - Number($content.attr('data-originalheight')) + Number($content.attr('data-newheight')) + 'px'
                    })
                }
                // console.log("cerrado")
                if (lang == 'es') {
                    $this.text('VER MÁS')
                } 
                else {
                    $this.text('VIEW MORE')
                }
            }

        });    
    });

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