<div class="booking {{isset($class) ? $class : ''}}">
	<div class="booking-button">
		<a class="btn btn-reserva-booking">{{App::getLocale() =='es' ? '¡' : ''}}{{__('booking.reserva_ahora')}}!</a>
	</div>
	<div class="booking-container">
        <div class="booking-content">
            <div class="title">
                <span class="title--booking">{{App::getLocale() =='es' ? '¡' : ''}}{{__('booking.reserva_ya')}}!</span>
                <div class="gradient-card-shadow-mob"></div>
            </div>
            

            @php $market=((config("app.market")=='México')?'mxn':'')@endphp
            <form class="formHotelHab" data-mercado="{{(config("app.market")=='México')?'mx':'general'}}" action="{{App::getLocale() =='es' ?'https://reservas.oasishoteles.com':'https://booking.oasishoteles.com'}}/bookcore/v3cpax/search-dispo.htm" method="post" target="_blank" data-slug="{{$hotel->uri.$market}}">
                <div class="etWHide">
                    <input type="hidden" name="destino" value="" id="codDestino"/>
                    <input type="hidden" name="coddestino" value="" id="hotel"/>
                    @if(preg_match( "/(grand-oasis-sens)|(oh-cancun)|(the-sian-ka-an)/",$hotel->uri))
                        <input type="hidden" name="ninos" value="0"/>
                    @endif
                </div>
                <div class="container-fluid">
                    <div class="booking_contenedor--inputs">
                        <div class="booking-close">
                            <i class="icon icon-cross"></i>
                        </div>
                        <div class="date">
                            <div class="select">
                                <label></label>
                                <div class="form-group__booking">
                                    <input class="form-control" id="llegada" name="llegada" type="text" readonly placeholder="{{__('booking.llegada_salida')}}">
                                    <input value="" class="EtDateFromGN" name="entrada" type="hidden">
                                    <input value="" class="EtDateToGN" name="salida" type="hidden">
                                </div>
                            </div>
                        </div>
                        <div class="adultos_ninos">
                            <div class="select inline">
                                <label>Adultos</label>
                                <select class="adultos_ninos_sel adultos" name="adultos">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            @if(!preg_match( "/(grand-oasis-sens)|(oh-cancun)|(the-sian-ka-an)/",$hotel->uri))
                                <div class="select inline">
                                    <label>Niños</label>
                                    <select class="adultos_ninos_sel ninos" name="ninos">      
                                        <option value="0">0</option>
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            @endif
                        </div>
                    
                        <div class="booking__cupon">
                            <div class="booking__cupon__label no-margin">
                                <span>{{__('booking.codigo_promo')}}</span>
                            </div>
                            <div class="booking__cupon__input no-margin">
                                <div class="form-group no-margin">
                                    <div class="input-group">
                                        <input type="text" placeholder="{{__('booking.inserte_codigo')}}" name="codpromo" disabled>
                                        <div class="input-group__add booking__cupon__input--button">
                                            <div class="close-cuponInput"><span class="icon icon-cross"></span></div>
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