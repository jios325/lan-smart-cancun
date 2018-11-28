<div class="newsletter">
    <div class="gradient"></div>
    <div class="newsletter_contenedor">
    	<div class="gradient-card-shadow-inside"></div>
    	<div class="container-fluid wrap-container">
	        <div class="row center-xs middle-xs">
	            <div class="col-xs-12">
	                <div class="title">
	                    <span>{{__('newsletter.suscribete')}} </span>
	                    <span>newsletter</span>
	                </div>
	            </div>
	            <div class="col-xs-12">
	                <div class="descr">
	                    <span>{{__('newsletter.enterado')}}</span>
	                </div>
	            </div>
	            <div class="col-xs-11 col-sm-6">
	                <form action=""  id="newsletter-form">
	                    <div class="sendmail">
	                        <div class="form-group no-margin">
	                            <input type="hidden" name="ip" value="{{config('app.ip')}}">
	                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                            <input type="email" name="email" placeholder="{{__('newsletter.email')}}" required>
	                        </div>
	                        <input class="btn btn-newsletter" type="submit" value="{{__('newsletter.suscribirme')}}">
	                    </div>
	                </form>
	            </div>
	        </div>

	    </div>
    </div>
   
</div>
