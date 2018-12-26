<div class="footer--redes-sociales">
	<h3>{{__('footer.siguenos_redes_s')}}</h3>
	<div class="footer--redes-sociales--content">
		@if(isset($hotel->facebook))
	    <a target="_blank" rel="noopener noreferrer nofollow" href="{{$hotel->facebook}}">
	        <i class="icon icon-facebook"></i>
	    </a>
	    @endif
	    @if(isset($hotel->twitter))
	    <a target="_blank" rel="noopener noreferrer nofollow" href="{{$hotel->twitter}}">
	        <i class="icon icon-twitter"></i>
	    </a>
	    @endif
	    @if(isset($hotel->instagram))
	    <a target="_blank" rel="noopener noreferrer nofollow" href="{{$hotel->instagram}}">
	        <i class="icon icon-instagram"></i>
	    </a>
	    @endif
	</div>
	
</div>