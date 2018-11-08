<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Route;

class NavComposer
{
    protected $hoteles;

    public function __construct(Hotel $hoteles)
    {
        // Dependencies automatically resolved by service container...
        $this->hoteles = $hoteles;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $route = Route::currentRouteName();
        // genera las redirecciones a otros idiomas, si la ruta no tiene nombre solo redirige al home
        if($route) {
            $newRoute = substr($route, 0, strlen($route) - 2);
            $params = (Route::current()) ? Route::current()->parameters() : null;
            $redirectUrls = [
                'es' => route($newRoute . title_case('es'), $params),
                'en' => route($newRoute . title_case('en'), $params)
            ];
        } else {
            $redirectUrls = [
                'es' => url('es'),
                'en' => url('en')
            ];
        }

     
        $view->with(['redirectLang' => $redirectUrls]);
    }
}
