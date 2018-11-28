@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
<div class="main-section main-section__galeria">
	@include('booking.booking', ['class' => 'booking__intern'])
	<div class="divisor divisor-intern"></div>
	<div class="container-fluid wrap-container">
		<h1 class="title--section h1">{{__('hoteles.galeria')}} {{$hotel->nombre_en}}</h1>
	</div>
	<div class="main-section__galeria--grid">
		<div class="grid-gallery container-fluid wrap-container popup-gallery">
				@foreach($galeria as $gallery)
					<div class="grid-gallery--row">
						<?$firstGal = $gallery->splice(0,1)?>
						@foreach($firstGal as $item_gal)
								<div class="grid-gallery--col">	
									<div class="grid-gallery--item-image">
										<a href="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $item_gal->url}}" alt="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}" rel="noopener noreferrer nofollow">
											<img src="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $item_gal->url}}" alt="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}" title="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}">
										</a>
									</div>
								</div>
						@endforeach
						<div class="grid-gallery--col">	
							@foreach($gallery as $item_gal)	
								<div class="grid-gallery--item-image">
									<a href="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $item_gal->url}}" alt="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}" rel="noopener noreferrer nofollow">
										<img src="{{'https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/' . $item_gal->url}}" alt="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}" title="{{(App::getLocale() == 'es') ? $item_gal->alt_es : $item_gal->alt_en}}">
									</a>
								</div>
							@endforeach
						</div>
					</div>
				@endforeach
		</div>
	</div>
</div>
@endsection