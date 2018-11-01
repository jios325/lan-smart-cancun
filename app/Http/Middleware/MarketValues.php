<?php

namespace App\Http\Middleware;

use Closure;

class MarketValues
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $array_market_values = [
			'México' => ['af' => 'OASISMX', 'afmobile' => 'MOASISMX', 'ln' => 'esp', 'cu' => 'pe', 'link_promo' => 'link_es', 'tel_mercado' => '+52 998 287 4478', 'mail_info' => 'info@oasishoteles.com'],
			'Argentina' => ['af' => 'OASISARG', 'afmobile' => '9007464', 'ln' => 'esp', 'cu' => 'pa', 'link_promo' => 'link_latam', 'tel_mercado' => '1.800.44.OASIS (62747)', 'mail_info' => 'info@oasishoteles.com'],
			'Brasil' => ['af' => 'OASISBR', 'afmobile' => '9007465', 'ln' => 'por', 'cu' => 're', 'link_promo' => 'link_br', 'tel_mercado' => '1.800.44.OASIS (62747)', 'mail_info' => 'info@oasishoteles.com'],
			'LATAM' => ['af' => 'OASISLATAM', 'afmobile' => 'MoasisLT', 'ln' => 'esp', 'cu' => 'usd', 'link_promo' => 'link_latam', 'tel_mercado' => '1.800.44.OASIS (62747)', 'mail_info' => 'info@oasishoteles.com'],
			'USA' => ['af' => 'OASISLATAM', 'afmobile' => 'MoasisLT', 'ln' => 'esp', 'cu' => 'usd', 'link_promo' => 'link_en', 'tel_mercado' => '1.800.44.OASIS (62747)', 'mail_info' => 'info@oasishotels.com'],
			'Colombia' => ['af' => '9007467', 'afmobile' => '9007466', 'ln' => 'esp', 'cu' => 'usd', 'link_promo' => 'link_es', 'tel_mercado' => '1.800.44.OASIS (62747)', 'mail_info' => 'info@oasishotels.com'],
        ];
        // cambiamos el valor si el mercado es mexicano y se visita en un disposito movil
        // dd($array_market_values);
        $market_values = array_get($array_market_values, $request->market, 'USA');
        config(['app.market_values' => $market_values]);
        return $next($request);
    }
}
