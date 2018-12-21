		<script>
	        var lang = '{!! App::getLocale() !!}'
	    </script>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
		<script src="https://unpkg.com/sweetalert@2.1.0/dist/sweetalert.min.js"></script>
		@if (App::environment('local'))
			<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_3Sfv5nolC4EaRjRBFzpJwvUbUtPvu_M"></script>
			<script type="text/javascript" src="http://localhost:9000/js/common.bundle.js"></script>
        	<script type="text/javascript" src="http://localhost:9000/js/app.bundle.js"></script>
        @else
        	<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhI-p4GfTO9fWrASenVPdwNrKIQuPxUsg"></script>
        	<script type="text/javascript" src='https://oasishoteles.sfo2.digitaloceanspaces.com/assets/js/modernizr-bundle.js'></script>
	        <script type="text/javascript" src="{{mix('js/common.bundle.js')}}"></script>
	        <script type="text/javascript" src="{{mix('js/app.bundle.js')}}"></script>
		@endif