<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class CheckIp
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
        if (App::environment('local')) {
            $ip = env('IP_DEV');
        } else {
            $ip = $request->ip();
        }
        $request->ipNumber = $this->get_ip_number($ip);
        return $next($request);
    }

    public function get_ip_number($ip)
    {
        $length = strlen($ip);
        $cont = substr_count($ip, '.');

        if ($cont < 1) {
            return 0;
        }

        for ($i = 0, $j = 3; $i < $cont; $i++, $j--) {
            $indexof = stripos($ip, '.');
            $segment = substr($ip, 0, $indexof);
            $left_ip = substr($ip, $indexof + 1, $length);

            $ip = $left_ip;

            $segments[$i] = $segment * pow(256, $j);
        }

        $segments[count($segments)] = substr($ip, strrpos($ip, '.'));

        return array_sum($segments);
    }
}
