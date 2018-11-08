<header>
	<nav>
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
		<ul class="principal">
			<ul class="col-xs-12 col-md-2">
				<li class="visible-md visible-lg logo_field">
					<a>
						<img class="logo" src="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/' . $hotel->logo}}">
						<i class="icon icon-icono-oasis hide"></i>
					</a>
				</li>
				<li class="hidden-md hidden-lg button_close">
					<a class="icon icon-cross"></a>
				</li>
			</ul>
			<ul class="col-xs-12 col-md-8">
				<li class="active">
					<a>{{__('menu.inicio')}}</a>
				</li>
				<li>
					<a>{{__('menu.habitaciones')}}</a>
				</li>
				<li>
					<a>{{__('menu.rest_y_bares')}}</a>
				</li>
				<li>
					<a>{{__('menu.galeria')}}</a>
				</li>
				<li>
					<a>{{__('menu.entretenimiento')}}</a>
				</li>
				<li>
					<a>{{__('menu.servicios')}}</a>
				</li>
				<li class="hidden-md hidden-lg">
					<a>llamar</a>
				</li>
				<li class="hidden-md hidden-lg">
					<a>contacto</a>
				</li>
			</ul>
			<ul class="col-xs-12 col-md-2 visible-md visible-lg lang_d">
				<li>
					<a><i class="icon icon-phone"></i></a>
				</li>
				<li>
					<a><i class="icon icon-envelope"></i></a>
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