@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
	<div class="main-section main-section__servicios ">
		@include('booking.booking', ['class' => 'booking__intern'])
		<div class="divisor divisor-intern"></div>
		<div class="container-fluid wrap-container">
			<h1 class="title--section h1">{{__('servicios.servicios')}} {{$hotel->nombre_en}}</h1>
		</div>
		<div class="main-section__servicios--spa">
			<div class="container-fluid wrap-container">
				<h2 class="title--section">spa {{$hotel->nombre_en}}</h2>
			</div>
			<div class="main-section__servicios--spa--container backgrounds">
				<div class="main-section__servicios--spa--content card--container slide_mobile dots container-fluid wrap-container">
					<div class="main-section__servicios--spa--item card--topimage--item">
						<div class="card--topimage--item__image">
							<div class="gradient-card-shadow-over"></div>
							<div class="gradient-card-shadow"></div>
							<div class="rel card--topimage--item__image--img">
								<img src="{{asset('img/servicios/spa/spa-1.jpg')}}" alt="">
							</div>
							<div class="card--topimage--item__image--title">
	                            <img src="{{asset('img/servicios/spa/sensoria.png')}}" alt="">
	                        </div>
						</div>
						<div class="card--topimage--item__info pt-50-im">
							<a href="https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/factsheets/spa/completo/factsheet-{{App::getLocale()}}.pdf" class="btn btn-transparent-border" target="_blank">
								{{__('home.mas_info')}}
		                    </a>
						</div>
					</div>
					<div class="main-section__servicios--spa--item card--topimage--item">
						<div class="card--topimage--item__image">
							<div class="gradient-card-shadow-over"></div>
							<div class="gradient-card-shadow"></div>
							<div class="rel card--topimage--item__image--img">
								<img src="{{asset('img/servicios/spa/spa-2.jpg')}}" alt="">
							</div>
							<div class="card--topimage--item__image--title">
	                            <img src="{{asset('img/servicios/spa/kinha.png')}}" alt="">
	                        </div>
						</div>
						<div class="card--topimage--item__info pt-50-im">
							<a href="https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/factsheets/spa/completo/factsheet-{{App::getLocale()}}.pdf" class="btn btn-transparent-border" target="_blank">
								{{__('home.mas_info')}}
		                    </a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__servicios--tours container-fluid wrap-container no-pad-xs">
			<h2 class="title--section">tours & transfers {{$hotel->nombre_en}}</h2>
			<div class="main-section__servicios--tours--container">
				<div class="main-section__servicios--tours--content card--container">
					<div class="card--leftright-text--item">
						<div class="card--leftright-text--item__image">
							<img src="{{asset('img/servicios/tours.jpg')}}" alt="">
						</div>
						<div class="card--leftright-text--item__info">
							<div class="card--leftright-text--item__info--container">
								<h3 class="title_card">TOURS LOREM IPSUM</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
								</p>
								<a class="more_information">Obtén más infotmación<i class="icon icon-arrow-thin-right"></i></a>
							</div>
						</div>
					</div>
					<div class="card--leftright-text--item">
						<div class="card--leftright-text--item__image">
							<img src="{{asset('img/servicios/transfers.jpg')}}" alt="">
						</div>
						<div class="card--leftright-text--item__info">
							<div class="card--leftright-text--item__info--container">
								<h3 class="title_card">transportes LOREM</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
								</p>
								<a class="more_information">Obtén más infotmación <i class="icon icon-arrow-thin-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="divisor"></div>
		<div class="main-section__servicios--renta-autos container-fluid wrap-container">
			<h2 class="title--section">{{__('servicios.renta_autos').' '.$hotel->nombre_en}}</h2>
			<div class="main-section__servicios--renta-autos--container">
				<div class="main-section__servicios--renta-autos--content card--container">
					<div class="card--imageabsolute--item">
						<div class="card--imageabsolute--item__image">
							<img src="{{asset('img/servicios/auto-smart.png')}}" alt="">
						</div>
						<div class="card--imageabsolute--item__info">
							<div class="card--imageabsolute--item__info--container">
								<h3 class="title_card">BE SMART, BE FREE</h3>
								<p>
									{{__('servicios.smart_descr')}}
								</p>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection