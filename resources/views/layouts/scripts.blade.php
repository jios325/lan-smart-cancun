		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		crossorigin="anonymous"></script>
		@if (App::environment('local'))
			<script type="text/javascript" src="http://localhost:9000/js/common.bundle.js"></script>
        	<script type="text/javascript" src="http://localhost:9000/js/app.bundle.js"></script>
        @else
        	<script type="text/javascript" src='https://oasishoteles.sfo2.cdn.digitaloceanspaces.com/assets/js/modernizr-bundle.js'></script>
	        <script type="text/javascript" src="{{mix('js/common.bundle.js')}}"></script>
	        <script type="text/javascript" src="{{mix('js/app.bundle.js')}}"></script>
		@endif