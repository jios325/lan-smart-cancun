<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
	<head>
		@include('layouts.styles')
		@include('layouts.metas')
	</head>
	<body class="{{config('app.hoteluri')}}">
		@include('layouts.menu')
		<div>
			@section('content') @show
			@include('layouts.redes_sociales')
			@include('layouts.newsletter')
		</div>
		@include('layouts.footer')
		@include('layouts.scripts')
	</body>
</html>