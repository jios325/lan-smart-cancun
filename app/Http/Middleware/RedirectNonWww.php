<?php

namespace App\Http\Middleware;

use Closure;

class RedirectNonWww
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

        $segments = join('/', $request->segments());

        if (env('APP_URL') !== $request->root()) {
            return redirect('http://grandoasiscancunhotel.com/' . $segments);
        }

        return $next($request);
    }
}
