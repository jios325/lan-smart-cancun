<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<meta charset="UTF-8">
	<title>Activacion de Cuenta</title>
	<style>
		body {width: 640px; font-family: Verdana, sans-serif; color: #7c6a55; font-size: 1em; background-color: #ebebeb;}
		.push {height: 2em;}
		.wrap{padding: 20px; margin-top: 30px; box-sizing: border-box;min-height: 500px;width: 100%; background-color: #FFF}
		.row{text-align: center;}
		.text-center{text-align: center}
		.block-center{margin: 0 auto;}
		h1, h2 {font-weight: lighter; font-size: 30px}
		h2{font-size: 25px;}
		a {text-decoration: none; color: #7c6a55;}
		.box {color: #818181; background-color: #FFF; padding: 25px; padding-top: 0; box-sizing: border-box;}
		.btn.btn-confirm {
		    color: #fff;
		    -webkit-box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.24);
		    box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.24);
		    background-color: #DAC78F;
		    border: 1px solid #DAC78F;
		}
		.newsletter{
			color: #DAC78F;
		}
		.btn {
		    padding: 15px 20px;
		    cursor: pointer;
		    text-align: center;
		    font-size: 14px;
		    font-weight: 400;
		    border: 1px solid transparent;
		    border-style: none;
		    display: inline-block;
		    margin-bottom: 15px;
		}
		small{font-size: 80%}
		small a, small p{color: #a1a1a1;}
	</style>
</head>
<body class="block-center">
	<div class="wrap">
		<div class="row">
			<img src="https://oasishoteles.sfo2.digitaloceanspaces.com/assets/img/logos/logo-oasis-gris.svg" alt="Logo Oasis Hoteles">
		</div>
		<div class="push"></div>
		<div class="row">
			<h4 class="newsletter">OASIS-NEWSLETTER</h4>
			<h2 style="color: #000;">{{__('newsletter.confirmar')}}</h2>
		</div>
		<div class="row">
			<p style="color: #000000; text-align: center;"><img src="{{'https://oasishoteles.sfo2.digitaloceanspaces.com/assets/img/logos/lapiz.jpg'}}" alt=""></p>
			<div class="box">
				<p class="info">{{__('newsletter.click_confirmar')}}</p>
        <a href="{{$data['url']}}" class="btn btn-confirm">{{__('newsletter.confirmar')}}</a>
			</div>
		</div>
		<div class="row">
			<img src="https://oasishoteles.sfo2.digitaloceanspaces.com/assets/img/home/oasis-loves-u.svg" alt="OASISLOVESU">
		</div>
		<div class="push"></div>
	</div>
	<div class="row">
			<small><p>(998) 8817000 Blvd, Kukulkan Km 16.5 Cancún, México</p></small>
		</div>
		<div class="row">
			<div style="width: 200px; float: left; display: inline-block;">
				<small><a href="http://oasishoteles.com" target="_blank">www.oasishoteles.com</a></small>
			</div>
			<div style="width: 200px; float: left; display: inline-block;">
				<small><a href="https://www.facebook.com/OasisHotels" target="_blank">Facebook: OasisCancun</a></small>
			</div>
			<div style="width: 200px; float: left; display: inline-block;">
				<small><a href="https://twitter.com/OasisHotels" target="_blank">Twitter: @oasis_cancun</a></small>
			</div>
		</div>
</body>
</html>
