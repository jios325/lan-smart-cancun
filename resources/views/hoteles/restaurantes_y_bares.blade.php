@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
	<div class="main-section main-section__rest_y_bares ">
		@include('booking.booking', ['class' => 'booking__intern'])
		<div class="divisor divisor-intern"></div>
		<h1 class="title--section">{!! (App::getLocale() == 'es') ? __('menu.rest_y_bares').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('menu.rest_y_bares') !!}</h1>
		<div class="main-section__rest_y_bares--generales container-fluid wrap-container">
			<div class="tabs--section tabs-image--container tabs-navbar">
				<div class="tabs-image--item restaurantes small active gotoSlide tab-1">
					<div class="gradient-card-shadow"></div>
					<div class="tabs-image--item-container backgrounds gradient-after">
						<div class="tabs-image--item-content">
							<span>
								{{__('rest_bares.restaurantes')}}
							</span>
							<div class="tabs-icon">
								<img src="{{asset('img/icons/icon-restaurantes.png')}}" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tabs-image--item bares small gotoSlide tab-2">
					<div class="gradient-card-shadow"></div>
					<div class="tabs-image--item-container backgrounds gradient-after">
						<div class="tabs-image--item-content">
							<span>
								{{__('rest_bares.bares')}}
							</span>
							<div class="tabs-icon">
								<img src="{{asset('img/icons/icon-bares.png')}}" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tabs--slide">
					<div class="tabs--slide-content tab-1">
						<div class="divisor"></div>
						<h2 class="title--section no-line">
							{!! (App::getLocale() == 'es') ? __('rest_bares.restaurantes').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('rest_bares.restaurantes') !!}
						</h2>
						<div class="main-section__rest_y_bares--descr">
							@if(!empty($hotel->descripcion_restaurantes_es))
	                            {!! (App::getLocale() == 'es') ? $hotel->descripcion_restaurantes_es : $hotel->descripcion_restaurantes_en !!}
	                        @else
	                            {!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}
	                        @endif
						</div>
						<div class="main-section__rest_y_bares--cards tab-1 viewmore_contenido slide_mobile slick-arrow-out slick-arrow-dark" data-rows="2" data-slidesperrow="1">
							@foreach($restaurants['otros'] as $restaurant_otro)
								<div class="main-section__rest_y_bares--cards--item card--item-over">
									<div class="card--item-over-container gradient-after-strong">
									<!-- <div class="card--item-over-container"> -->

										<img class="img-background" src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $restaurant_otro->pivot->img_portada}}" alt="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$restaurant_otro->nombre : 'Cover image of a sample of the restaurant '.$restaurant_otro->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$restaurant_otro->nombre : 'Cover image of a sample of the restaurant '.$restaurant_otro->nombre.' Restaurant'}}">
										<div class="card--item-over-content">
											<img src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $restaurant_otro->pivot->logo_blanco}}" alt="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$restaurant_otro->nombre : 'White Logo '.$restaurant_otro->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$restaurant_otro->nombre : 'White Logo '.$restaurant_otro->nombre.' Restaurant'}}">
											<span>{{(App::getLocale() == 'es') ? $restaurant_otro->pivot->concepto_es : $restaurant_otro->pivot->concepto_en}}</span>
										</div>
										
									</div>
									
								</div>
							@endforeach
						</div>
						<div class="main-section__rest_y_bares--button center-xs visible-md visible-lg">
							<a class="btn btn-reserva viewmore ">{{__('home.ver_mas')}}</a>
						</div>
					</div>
					<div class="tabs--slide-content tab-2">
						<div class="divisor"></div>
						<h2 class="title--section no-line">
							{!! (App::getLocale() == 'es') ? __('rest_bares.bares').' '.$hotel->nombre_en : $hotel->nombre_en.' '.__('rest_bares.bares') !!}
						</h2>
						<div class="main-section__rest_y_bares--descr">
							@if(!empty($hotel->descripcion_bares_es))
                                {!! (App::getLocale() == 'es') ? $hotel->descripcion_bares_es : $hotel->descripcion_bares_en !!}
                            @else
                                {!! (App::getLocale() == 'es') ? $hotel->concepto_es : $hotel->concepto_en !!}
                            @endif
						</div>
						<div class="main-section__rest_y_bares--cards tab-2 viewmore_contenido slide_mobile slick-arrow-out slick-arrow-dark" data-rows="2" data-slidesperrow="1">
							@foreach($bares['otros'] as $bar_otro)
								<div class="main-section__rest_y_bares--cards--item card--item-over">
									<div class="card--item-over-container gradient-after-strong">
										<img class="img-background" src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $bar_otro->pivot->img_portada}}" alt="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$bar_otro->nombre : 'Cover image of a sample of the restaurant '.$bar_otro->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$bar_otro->nombre : 'Cover image of a sample of the restaurant '.$bar_otro->nombre.' Restaurant'}}">
										<div class="card--item-over-content">
											<img src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $bar_otro->pivot->logo_blanco}}" alt="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$bar_otro->nombre : 'White Logo '.$bar_otro->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$bar_otro->nombre : 'White Logo '.$bar_otro->nombre.' Restaurant'}}">
											<span>{{(App::getLocale() == 'es') ? $bar_otro->pivot->concepto_es : $bar_otro->pivot->concepto_en}}</span>
										</div>
										
									</div>
									
								</div>
							@endforeach
						</div>
						<div class="main-section__rest_y_bares--button center-xs visible-md visible-lg">
							<a class="btn btn-reserva viewmore">{{__('home.ver_mas')}}</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
		</div>	
		
		@if(isset($restaurants['destacados']))
		<div class="divisor"></div>
		<div class="main-section__rest_y_bares--exclusivos">
			<h2 class="title--section no-line">{{__('rest_bares.rest_exc')}}</h2>
			<div class="main-section__rest_y_bares--exclusivos--container backgrounds">
				<div class="rest--exclusivos--container container-fluid wrap-container">
					<div class="rest--exclusivos--content slide_mobile slick-arrow-out slick-arrow-dark">
						
						@foreach($restaurants['destacados'] as $exclusivo)
						<div class="rest--exclusivos--item ">
							<div class="rest--exclusivos--item--content backgrounds">
								<img class="img-background" src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $exclusivo->pivot->img_portada}}" alt="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$exclusivo->nombre : 'Cover image of a sample of the restaurant '.$exclusivo->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Imágen portada muestra de restaurante '.$exclusivo->nombre : 'Cover image of a sample of the restaurant '.$exclusivo->nombre.' Restaurant'}}">
								<div class="img-logo">
									<img src="{{ 'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $exclusivo->pivot->logo_blanco}}" alt="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$exclusivo->nombre : 'White Logo '.$exclusivo->nombre.' Restaurant'}}" title="{{(App::getLocale() == 'es') ? 'Logo Blanco Restaurante '.$exclusivo->nombre : 'White Logo '.$exclusivo->nombre.' Restaurant'}}">
								</div>
							</div>
						</div>
						@if($loop->iteration > 3) @break @endif @endforeach
					</div>
					<div class="costo-adicional">
						<span>

							<i class="costo"></i>
							{{__('rest_bares.costo_adicional')}}
						</span>
					</div>
				</div>
			</div>
		</div>
		@else
			<div class="divisor"></div>
		@endif
	</div>
@endsection