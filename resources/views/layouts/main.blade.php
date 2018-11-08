<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
	<head>
		@include('layouts.styles')
	</head>
	<body class="{{$hotel->uri}}">
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