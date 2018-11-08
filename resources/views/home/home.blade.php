@extends('layouts.main')
@section('content')

	<div class="main-section main-section__home">
		<div class="main-section__home-head_home backgrounds" style="background-image: url({{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/' . $hotel->bgheader}})">
			<div class="gradient-home"></div>
			@include('booking.booking', ['class' => 'booking__home'])
			<div class="main-section__home-container">
				<div class="container-fluid">
					<h1 class="title--home">
						<span>{{$hotel->nombre_en}}</span>
						{!! $hotel->apellido_hotel !!}
					</h1>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__home-slick container-fluid wrap-container">
			<h2 class="title--section no-line">{{$hotel->nombre_en}}</h2>
			<div class="row center-xs">
				<div class="col-xs-11 col-md-10">
					<div class="slide_slick slick-justify">
						<div><a href="">{!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}</a></div>
						<div><a href="">{!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}</a></div>
						<div><a href="">{!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}</a></div>
						<div><a href="">{!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__home-habitaciones container-fluid wrap-container">
			<h2 class="title--section">{!! (App::getLocale() == 'es') ? __('menu.habitaciones').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('menu.habitaciones') !!}</h2>
			<div class="main-section__home-habitaciones--container">
				<div class="card--container">
					@foreach($habitaciones as $habitacion)
						<div class="card--topimage--item card--home--room">
							<div class="card--topimage--item__image">
								<div class="gradient-card-shadow"></div>
								<div class="slide_arrows">
									@foreach($habitacion->galeria as $img)
			                            <img src="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $img->url}}" alt="">
			                        @endforeach
								</div>
								<div class="card--topimage--item__image--title">
		                            <h3>{{$habitacion->habitacion_nombre_en}}</h3>
		                        </div>
		                        <div class="card--topimage--item__image--buttons">
		                            <a href="#popupHighlights-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">highlights</a>
		                            <a href="#popupInst-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">{{__('rooms.inst_serv')}}</a>
		                            <a href="#popupAmenidades-{{$habitacion->uri}}" class="btn btn-transparent modal--popup">{{__('rooms.amenidades')}}</a>
		                        </div>
							</div>
							<div class="card--topimage--item__info">
		                        {!! (App::getLocale() == 'es') ? $habitacion->pivot->descripcion_es : $habitacion->pivot->descripcion_en !!}
		                        <div class="card--topimage--item__info--button">
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
					@if($loop->iteration > 1) @break @endif @endforeach
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__home-rest_y_bares container-fluid wrap-container">
			<h2 class="title--section">{!! (App::getLocale() == 'es') ? __('menu.rest_y_bares').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('menu.rest_y_bares') !!}</h2>
			<div class="main-section__home-rest_y_bares--container">
				<div class="tabs-image--container">
					<div class="tabs-image--item restaurantes">
						<div class="tabs-image--item-container backgrounds">
							<div class="tabs-image--item-content">
								<h3>
									{{__('rest_bares.restaurantes')}}
								</h3>
								<div class="tabs-icon">
									<img src="{{asset('img/icons/icon-restaurantes.png')}}" alt="">
								</div>
								
								<a class="btn btn-transparent btn-transparent-flat">{{__	('rest_bares.ver_restaurantes')}}</a>

							</div>
						</div>
					</div>
					<div class="tabs-image--item bares">
						<div class="tabs-image--item-container backgrounds">
							<div class="tabs-image--item-content">
								<h3>
									{{__('rest_bares.bares')}}
								</h3>
								<div class="tabs-icon">
									<img src="{{asset('img/icons/icon-bares.png')}}" alt="">
								</div>
								
								<a class="btn btn-transparent btn-transparent-flat">{{__	('rest_bares.ver_bares')}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__home-galeria container-fluid wrap-container">
			<h2 class="title--section">{!! (App::getLocale() == 'es') ? __('menu.galeria').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('menu.galeria') !!}</h2>
			<div class="main-section__home-galeria--container">
				<div class="grid-gallery">
					<div class="grid-gallery--item">
						<div class="youtube-player" data-id="{{ last(explode('/', $hotel->video)) }}" data-thumbnail="{{($hotel->uri == 'oasis-palm') ? 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/img/hoteles/oasis-palm/header/op_vid.jpg' : 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/' . $hotel->bgheader}}"></div>
					</div>
					<div class="grid-gallery--item">
						<div class="grid-gallery--item-images--container popup-gallery--mobile slide_mobile">
							@foreach($galeria_destacados as $galeria)
								<div class="grid-gallery--item-images--item">
									<a href="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $galeria->url}}" alt="{{(App::getLocale() == 'es') ? $galeria->alt_es : $galeria->alt_en}}" rel="noopener noreferrer nofollow">
										<img src="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $galeria->url}}" alt="{{(App::getLocale() == 'es') ? $galeria->alt_es : $galeria->alt_en}}" title="{{(App::getLocale() == 'es') ? $galeria->alt_es : $galeria->alt_en}}">
									</a>
									
								</div>
							@if($loop->iteration >= 3) @break @endif @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__home-ubicacion">
			<h2 class="title--section">{!! (App::getLocale() == 'es') ? __('hoteles.ubicacion').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('hoteles.ubicacion') !!}</h2>
			<div class="main-section__home-ubicacion--container">
				<div class="map-container">
					<div class="map-container--item backgrounds">
						<div class="gradient gradient-popup-dark"></div>
						<div class="map-contaner--item--content">
							<i class="icon icon-icono-oasis"></i>
							<h3> {{$hotel->nombre_en}} </h3>
							<span class="tel">01 998 881 7000</span>
							<span class="tel"><strong>Reservas: </strong>00 000 000 0000</span>
							<span class="location">{{$hotel->calle}}</span>
						</div>
						
					</div>
					<div class="map-container--item">
						<img src="{{asset('img/mapas/'.$hotel->uri.'.jpg')}}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection