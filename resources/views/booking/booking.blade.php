<div class="booking {{isset($class) ? $class : ''}}">
	<div class="booking-button">
		<a class="btn btn-reserva-booking">¡Reserva Ahora!</a>
	</div>
	<div class="booking-container">
		<h2 class="title--booking">¡reserva ya!</h2>
		<form class="formHotelHab" data-mercado="{{(config("app.market")=='México')?'mx':'general'}}" action="{{App::getLocale() =='es' ?'https://reservas.oasishoteles.com':'https://booking.oasishoteles.com'}}/bookcore/v3cpax/search-dispo.htm" method="post" target="_blank">
			<div class="etWHide">
                <input type="hidden" name="destino" value="" id="codDestino"/>
            </div>
            <div class="container-fluid">
            	<div class="row middle-xs booking_contenedor--inputs">
            		<div class="col-xs-6">
                        <div class="select" id="select2-content">
                            <label></label>
                            <div class="no-margin-sm form-group__booking date br1px">
                                <div class="form-control select__label" id="llegada">{{(__('booking.llegada'))}}</div>
                                <input value="" class="EtDateFromGN" name="entrada" type="hidden">
                                <input value="" class="EtDateToGN" name="salida" type="hidden">
                            </div>
                        </div>
                        <div class="booking__hide_container date__container">
                            <button class="return__btn hidden-md mb-10">
                                <span class="icon icon-ios-arrow-back"></span>
                                <span class="return__btn__title">{{__('booking.llegada_salida')}}</span>
                            </button>
                            <div class="date__container__labels hidden-md">
                                <div class="label__left">
                                    <p>Check In</p>
                                    <span>-</span>
                                </div>
                                <div class="label__right">
                                    <p>Check Out</p>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="select" id="select2-content">
                            <label></label>
                            <div class="no-margin-sm form-group__booking date br1px">
                                <div class="form-control date-opener select__label" id="salida">{{(__('booking.salida'))}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                    	adultos
                    </div>
                    <div class="col-xs-6">
                    	niños
                    </div>
                    <div class="col-xs-12">
	                    <div class="booking__cupon">
	                        <div class="booking__cupon__label no-margin">
	                            <span>{{__('booking.codigo_promocion')}}</span>
	                        </div>
	                        <div class="booking__cupon__input no-margin">
	                            <div class="form-group no-margin">
	                                <div class="input-group">
	                                    <input type="text" placeholder="{{__('booking.inserte_codigo')}}" disabled name="codpromo">
	                                    <div class="input-group__add booking__cupon__input--button">
	                                        <div class="close-cuponInput"><span class="icon icon-cross"></span></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-xs-12">
                        <input class="btn btn-reservar" type="submit" value="{{__('booking.buscar')}}" id="submit-form-booking">
                    </div>
            	</div>
            </div>
		</form>
	</div>
</div>