<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class SetLocals
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

        $local = DB::table('vista_mercados')->where('ip_from', '<=', $request->ipNumber)->where('ip_to', '>=', $request->ipNumber)->first();
        //Sesion Varaibles
        // $request->session()->put('country', $local->country_name);
        // session(['country' => $local->country_name,'city'=>$local->city_name,'ip'=>request()->ip()]);
        $currency = ($local->country_code === 'MX') ? 'MXN' : 'USD';
        $markets_array = ['MX' => 'México', 'US' => 'USA', 'CA' => 'USA', 'BR' => 'Brasil', 'AR' => 'Argentina', 'CO' => 'Colombia'];
        $market = array_get($markets_array, $local->country_code, 'LATAM');
        config(['app.market' => $market,'app.ip'=>$request->ipNumber, 'app.currency' => $currency, 'app.continent' => $local->continent]);
        $request->market = $market;
        if ($request->segment(1) !== 'es' && $request->segment(1) !== 'en') {
            $lang_array = ['MX' => 'es', 'CO' => 'es', 'AR' => 'es', 'ES' => 'es'];
            return redirect('/' . array_get($lang_array, $local->country_code, 'en'));
        }

        return $next($request);
    }
}
