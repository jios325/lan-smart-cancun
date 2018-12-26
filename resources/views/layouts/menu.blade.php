<header id="">
	<nav class="{{isset($classMenu) ? $classMenu : ''}}">
		<ul class="mobile_bar hidden-md hidden-lg">
			<li class="button_open">
				<a class="icon icon-menu"></a>
			</li>
			<li class="namehotel">
				<a>
					{{$hotel->nombre_en}}
				</a>
			</li>
		</ul>
		<ul class="principal" id="menu-hotel">
			<ul class="col-xs-12 col-md-2">
				<li class="visible-md visible-lg logo_field">
					<a>
						<img class="logo" src="{{'https://oasishoteles.sfo2.digitaloceanspaces.com/assets/' . $hotel->logo}}">
						<i class="icon icon-icono-oasis hide"></i>
					</a>
				</li>
				<li class="hidden-md hidden-lg button_close">
					<a class="icon icon-cross"></a>
				</li>
			</ul>
			<ul class="col-xs-12 col-md-8">
				<li {{ (preg_match( "/(Home)/", Route::currentRouteName())) ?
                'class=active' : '' }}>
					<a href="{{route( 'Home' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.inicio')}}</a>
				</li>
				<li {{ (preg_match( "/(HotelRooms)/", Route::currentRouteName())) ?
                'class=active' : '' }}>
					<a href="{{route( 'HotelRooms' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.habitaciones')}}</a>
				</li>
				<li {{ (preg_match( "/(HotelRestaurantsAndBars)/", Route::currentRouteName())) ?
                'class=active' : '' }}>
					<a href="{{route( 'HotelRestaurantsAndBars' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.rest_y_bares')}}</a>
				</li>
				<li {{ (preg_match( "/(HotelGallery)/", Route::currentRouteName())) ?
                'class=active' : '' }}>
					<a href="{{route( 'HotelGallery' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.galeria')}}</a>
				</li>
				@if(count($entretenimiento->where('id_hotel', $hotel->id_hotel)->all()) > 0)
					<li {{ (preg_match( "/(HotelEntertainment)/", Route::currentRouteName())) ?
	                'class=active' : '' }}>
						<a href="{{route( 'HotelEntertainment' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.entretenimiento')}}</a>
					</li>
				@endif
				<li {{ (preg_match( "/(HotelServicios)/", Route::currentRouteName())) ?
                'class=active' : '' }}>
					<a href="{{route( 'HotelServicios' . title_case(App::getLocale()), [ 'slug' => $hotel->uri])}}">{{__('menu.servicios')}}</a>
				</li>
				<li class="hidden-md hidden-lg">
					<a href="tel:529982874478">llamar</a>
				</li>
				<li class="hidden-md hidden-lg">
					<a href="https://oasishoteles.com/es/contacto" target="_blank" rel="noopener noreferrer nofollow">contacto</a>
				</li>
			</ul>
			<ul class="col-xs-12 col-md-2 visible-md visible-lg lang_d">
				<li>
					<a href="tel:529982874478"><i class="icon icon-phone"></i></a>
				</li>
				<li>
					<a href="https://oasishoteles.com/es/contacto" target="_blank" rel="noopener noreferrer nofollow"><i class="icon icon-envelope"></i></a>
				</li>
				<li class="language has_submenu">
					<a><i class="icon icon-lenguaje"></i></a>
					<ul class="submenu">
						@foreach($redirectLang as $l => $url)
							<li {{(App::getLocale() === $l) ? "class=active" : ''}} ><a href={{$url}}>{{$l}}</a></li>
						@endforeach
					</ul>
				</li>
			</ul>
			<ul class="col-xs-12 hidden-md hidden-lg lang_m">
				@foreach($redirectLang as $l => $url)
					<li {{(App::getLocale() === $l) ? "class=active" : ''}} ><a href={{$url}}>{{$l}}</a></li>
				@endforeach
			</ul>
		</ul>
	</nav>
	<div class="gradient gradient-menu"></div>
</header>