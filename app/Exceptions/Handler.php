<?php

namespace App\Exceptions;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //Cachamos la Excepcion sin filtrar el Numero, y asignamos la localización con base a la IP encontrada
        if( is_a( $exception, \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class ) ) {
            if (App::environment('local')) {
                $ip = env('IP_DEV');
            } else {
                $ip = $request->ip();
            }
            $request->ipNumber = $this->get_ip_number($ip);
            $local = DB::table('vista_mercados')->where('ip_from', '<=', $request->ipNumber)->where('ip_to', '>=', $request->ipNumber)->first();
            $lang_array = ['MX' => 'es', 'CO' => 'es', 'AR' => 'es'];
            if ($request->segment(1) !== 'es' && $request->segment(1) !== 'en') {
                $locale=array_get($lang_array, $local->country_code, 'en');
            }else{
                $locale=$request->segment(1);
            }
            App::setLocale($locale);
        }
        return parent::render($request, $exception);
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

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
