<div class="booking {{isset($class) ? $class : ''}}">
	<div class="booking-button">
		<a class="btn btn-reserva-booking">{{App::getLocale() =='es' ? '¡' : ''}}{{__('booking.reserva_ahora')}}!</a>
	</div>
	<div class="booking-container">
        <div class="booking-content">
            <span class="title--booking">{{App::getLocale() =='es' ? '¡' : ''}}{{__('booking.reserva_ya')}}!</span>
            <form class="formHotelHab" data-mercado="{{(config("app.market")=='México')?'mx':'general'}}" action="{{App::getLocale() =='es' ?'https://reservas.oasishoteles.com':'https://booking.oasishoteles.com'}}/bookcore/v3cpax/search-dispo.htm" method="post" target="_blank">
                <div class="etWHide">
                    <input type="hidden" name="destino" value="" id="codDestino"/>
                </div>
                <div class="container-fluid">
                    <div class="booking_contenedor--inputs">
                        <div class="date">
                            <div class="select">
                                <label></label>
                                <div class="">
                                    <input class="form-control" id="llegada" name="fechapaq" type="text" readonly placeholder="{{__('booking.llegada_salida')}}">
                                    <input value="" class="EtDateFromGN" name="sd" type="hidden">
                                    <input value="" class="EtDateToGN" name="ed" type="hidden">
                                </div>
                            </div>
                        </div>
                        <div class="adultos_ninos">
                            <div>adultos</div>
                            <div>niños</div>
                        </div>
                        
                        <div class="cupon_button">
                            <div class="booking__cupon">
                                <div class="booking__cupon__input no-margin">
                                    <div class="form-group no-margin">
                                        <div class="input-group">
                                            <input type="text" placeholder="{{__('booking.codigo_promo')}}" name="codpromo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reserva_button">
                            <input class="btn btn-reserva" type="submit" value="{{__('booking.reserva_ahora')}}" id="submit-form-booking">
                        </div>
                    </div>
                </div>
            </form>
        </div>
		
	</div>
</div>