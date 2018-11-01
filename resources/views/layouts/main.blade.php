<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
	<head>
		@include('layouts.styles')
	</head>
	<body class="goc">
		@include('layouts.menu')
		<div>
			@section('content')
				@include('layouts.newsletter')
			@show
		</div>
		@include('layouts.scripts')
	</body>
</html>