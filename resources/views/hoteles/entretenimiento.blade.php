@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
	<div class="main-section main-section__entretenimiento ">
		@include('booking.booking', ['class' => 'booking__intern'])
		<div class="divisor divisor-intern"></div>
		<div class="container-fluid wrap-container">
			<h1 class="title--section h1">{{__('hoteles.entretenimiento')}} {{$hotel->nombre_en}}</h1>
		</div>
		<div class="main-section__entretenimiento">
			<div class="main-section--descr">
				@if(!empty($hotel->descripcion_entretenimiento_es))
                    {!! (App::getLocale() == 'es') ? $hotel->descripcion_entretenimiento_es : $hotel->descripcion_entretenimiento_en !!}
                @else
                    {!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}
                @endif
			</div>
			<div class="main-section__entretenimiento--cards container-fluid wrap-container">
				<div class="card--container slide_mobile dots">
					@foreach($entretenimientos as $entretenimiento)
						<div class="card--topimage--item main-section__entretenimiento--cards--item">
							<div class="card--topimage--item__image">
								<div class="gradient-card-shadow-darkfull"></div>
								<div class="rel card--topimage--item__image--img">
									<img src="{{ 'https://oasishoteles.sfo2.digitaloceanspaces.com/' . $entretenimiento->portada}}" alt="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de locación '.$entretenimiento->nombre : 'Cover image of a sample of the location '.$entretenimiento->nombre}}" title="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de locación '.$entretenimiento->nombre : 'Cover image of a sample of the location '.$entretenimiento->nombre}}">
								</div>
								<div class="card--topimage--item__image--title centered-md">
		                            <img src="{{ 'https://oasishoteles.sfo2.digitaloceanspaces.com/' . $entretenimiento->logo}}" alt="{{(App::getLocale() == 'es') ? 'Logo Blanco Locacion '.$entretenimiento->nombre : 'White Logo '.$entretenimiento->nombre.' Location'}}" title="{{(App::getLocale() == 'es') ? 'Logo Blanco Locacion '.$entretenimiento->nombre : 'White Logo '.$entretenimiento->nombre.' Location'}}">
		                        </div>
		                        <div class="card--topimage--item__image--footer">
		                        	<a href="#popupEntretenimiento-{{$entretenimiento->uri}}" class="btn btn-transparent-white btn-transparent-flat modal--popup" >
		                        		{{__('home.mas_info')}}
			                    	</a>
		                        </div>
							</div>
							<div id="popupEntretenimiento-{{$entretenimiento->uri}}" class="deco-popup backgrounds mfp-hide">
								<div class="gradient gradient-popup-dark"></div>
								<div class="deco-popup-container full">
									<button title="Close (ESC)" type="button" class="mfp-close"></button>
									<div class="deco-popup-content col-2">
										<div class="deco-popup-content--image">
											<img src="{{ 'https://oasishoteles.sfo2.digitaloceanspaces.com/' . $entretenimiento->portada}}" alt="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de locación '.$entretenimiento->nombre : 'Cover image of a sample of the location '.$entretenimiento->nombre}}" title="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de locación '.$entretenimiento->nombre : 'Cover image of a sample of the location '.$entretenimiento->nombre}}">
										</div>
										<div class="deco-popup-content--info">
											<img src="{{ 'https://oasishoteles.sfo2.digitaloceanspaces.com/' . $entretenimiento->logo}}" alt="{{(App::getLocale() == 'es') ? 'Logo Blanco Locacion '.$entretenimiento->nombre : 'White Logo '.$entretenimiento->nombre.' Location'}}" title="{{(App::getLocale() == 'es') ? 'Logo Blanco Locacion '.$entretenimiento->nombre : 'White Logo '.$entretenimiento->nombre.' Location'}}">
											@if($entretenimiento->descripcion)
												<div class="deco-popup-content--info--descr">
													{!!$entretenimiento->descripcion!!}
												</div>
											@endif
										</div>
									</div>
								</div>
		                    </div>
						</div>
						
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
@endsection