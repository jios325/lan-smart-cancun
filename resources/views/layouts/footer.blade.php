<footer class="footer">
	<div class="">
		<div class="footer_top">
			<div><span>@oasishoteles</span></div>
			<div class="footer_top_social">
				<a target="_blank" rel="noopener noreferrer nofollow" href="https://www.instagram.com/oasishotels/?utm_source=Web&utm_medium=Instagram&utm_campaign=OHR">
				  <i class="icon icon-instagram"></i>
				</a>
				<a target="_blank" rel="noopener noreferrer nofollow" href="https://twitter.com/OasisHotels?utm_source=Web&utm_medium=Twitter&utm_campaign=OHR">
				  <i class="icon icon-twitter"></i>
				</a>
				<a target="_blank" rel="noopener noreferrer nofollow" href="https://www.facebook.com/OasisHoteles/?utm_source=Web&utm_medium=Facebook&utm_campaign=OHR%20MX">
			  		<i class="icon icon-facebook"></i>
				</a>
			</div>
		</div>
		<div class="footer_bottom">
			<ul class="col-xs-12 col-md-11">
				<li class="visible-md visible-lg logo">
                	<i class="icon icon-icono-oasis"></i>
                </li>
				<li>
                	<a>{{__('footer.aviso_privacidad')}}</a>
              	</li>
              	<li>
                    <a>{{__('footer.politicas_cancelacion')}}</a>
                </li>
                <li>
                    <a href={{(App::getLocale() === 'es') ? 'https://blog.oasishoteles.net/es/' : 'https://blog.oasishoteles.net/en/'}} target="_blank" rel="noopener noreferrer nofollow">Blog</a>
                </li>
                <li>
                    <a href="http://fundacionoasis.com/" target="_blank" rel="noopener noreferrer nofollow">{{__('footer.fundacion')}}</a>
                </li>
                <li>
                    <a>{{__('footer.contacto')}}</a>
                </li>
                <li>
                	<a href="{{'https://oasishoteles.com/'.App::getLocale()}}">oasishoteles.com</a>
                </li>
			</ul>
			<ul class="col-xs-12 logo">
				<li class="hidden-md hidden-lg logo">
                	<i class="icon icon-icono-oasis"></i>
                </li>
			</ul>
		</div>
	</div>
</footer>