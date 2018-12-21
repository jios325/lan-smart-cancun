@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
	<div class="main-section main-section__rooms ">
		@include('booking.booking', ['class' => 'booking__intern'])
		<div class="divisor divisor-intern"></div>
		<div class="container-fluid wrap-container">
			<h1 class="title--section h1">{!! (App::getLocale() == 'es') ? __('menu.habitaciones').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('menu.habitaciones') !!}</h1>
		</div>
		@foreach($habitaciones as $habitacion)
			<div class="main-section__rooms--room {{$habitacion->uri}} container-fluid wrap-container">
				<div class="room--image">
					<div class="slide_arrows">
						@foreach($habitacion->galeria as $img)
			                <img src="{{'https://oasishoteles.sfo2.digitaloceanspaces.com/' . $img->url}}" alt="">
			            @endforeach

					</div>
					<div class="gradient-card-shadow"></div>
				</div>
				<div class="room--description backgrounds">
					<h2>{{$habitacion->habitacion_nombre_en}}</h2>
					{!! (App::getLocale() == 'es') ? $habitacion->pivot->descripcion_es : $habitacion->pivot->descripcion_en !!}
					<div class="room--description--buttons">
						<a href="#popupHighlights-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">highlights</a>
	                    <a href="#popupInst-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">{{__('rooms.inst_serv')}}</a>
	                    <a href="#popupAmenidades-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">{{__('rooms.amenidades')}}</a>

					</div>
					<div class="room--description--reserva">
						<label for="submit-form-booking" tabindex="0">
		                    <a class="btn btn-reserva">
		                        {{__('booking.reservar')}}
		                    </a>
		                </label>
					</div>
					
				</div>
				<div id="popupHighlights-{{$habitacion->uri}}" class="deco-popup backgrounds mfp-hide">
					<div class="gradient gradient-popup-dark"></div>
					<div class="deco-popup-container">
						<button title="Close (ESC)" type="button" class="mfp-close"></button>
						<h2 class="title--popup">highligts</h2>
	                    <div class="list_items">
	                        <ul class="col1-col2">
	                            @foreach($habitacion->highlights as $highlight)
	                                <li class="li-diamond">{{(App::getLocale() == 'es') ? $highlight->nombre_es : $highlight->nombre_en}}</li>
	                            @endforeach
	                        </ul>
	                    </div>
					</div>
	            </div>
	            <div id="popupInst-{{$habitacion->uri}}" class="deco-popup backgrounds mfp-hide">
	            	<div class="gradient gradient-popup-dark"></div>
	            	<div class="deco-popup-container">
	            		<button title="Close (ESC)" type="button" class="mfp-close"></button>
	                	<h2 class="title--popup">{{__('rooms.inst_serv')}}</h2>
	                    <div class="list_items">
	                        <ul class="icon col1-col2">
	                            @foreach($habitacion->facilidades as $facilidad)
	                                <li class="li-diamond {{($facilidad->costo_extra == '1') ? 'costo_extra' : ''}}">
	                                    {{ (App::isLocale('es')) ? $facilidad->nombre_es : $facilidad->nombre_en }}.
	                                </li>
	                            @endforeach
	                        </ul>
	                    </div>
	                    <div class="info_costo_extra">
	                    	<span>{{__('rooms.costo_extra')}}</span>
	                    </div>
	            	</div>
	            </div>
	            <div id="popupAmenidades-{{$habitacion->uri}}" class="deco-popup backgrounds mfp-hide">
	            	<div class="gradient gradient-popup-dark"></div>
	            	<div class="deco-popup-container">
	            		<button title="Close (ESC)" type="button" class="mfp-close"></button>
	            		<h2 class="title--popup">{{__('rooms.amenidades')}}</h2>
	                    <div class="list_items">
	                        <ul class="icon col1-col2">
	                            @foreach($habitacion->amenidades as $amenidad)
	                                <li class="li-diamond {{($amenidad->costo_extra == '1') ? 'costo_extra' : ''}}">
	                                    {{ (App::isLocale('es')) ? $amenidad->nombre_es : $amenidad->nombre_en }}.
	                                </li>
	                            @endforeach
	                        </ul>
	                    </div>
	                    <div class="info_costo_extra">
	                    	<span>{{__('rooms.costo_extra')}}</span>
	                    </div>
	            	</div>
	            </div>
			</div>
		@endforeach
	</div>
@endsection