<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
	<head>
		@include('layouts.styles')
	</head>
	<body>
		@section('content')
			@include('layouts.newsletter')
		@show
		@if (App::environment('local'))
			<script type="text/javascript" src="http://localhost:9000/js/common.bundle.js"></script>
        	<script type="text/javascript" src="http://localhost:9000/js/app.bundle.js"></script>
        @else
        	<script type="text/javascript" src='https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/js/modernizr-bundle.js'></script>
	        <script type="text/javascript" src="{{mix('js/common.bundle.js')}}"></script>
	        <script type="text/javascript" src="{{mix('js/app.bundle.js')}}"></script>
		@endif
	</body>
</html>