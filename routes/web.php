<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('redirect/{lang}/{route}', 'Home\HomeController@changeLang')
//     ->where('lang', 'es|en');

Route::middleware(['checkIp', 'setLocals', 'marketValues'])
    ->get('/', 'Home\HomeController@index');
    
Route::prefix('es')
	->middleware(['checkIp', 'setLocals', 'marketValues'])
	->group(function () {
        // Route::get('/', 'Home\HomeController@index')
        //     ->name('RedirectHomeEs');
   		Route::get('/', 'Home\HomeController@index')
        	->name('HomeEs');
        Route::get('/habitaciones', 'Hoteles\RoomsController@index')
            ->name('HotelRoomsEs');
        Route::get('/restaurantes_y_bares', 'Hoteles\RestaurantsController@index')
            ->name('HotelRestaurantsAndBarsEs');
        Route::get('/entretenimiento', 'Hoteles\EntretenimientoController@index')
            ->name('HotelEntertainmentEs');
        Route::get('/galeria', 'Hoteles\GaleriaController@index')
            ->name('HotelGalleryEs');
        Route::get('/servicios', 'Hoteles\ServiciosController@index')
            ->name('HotelServiciosEs');
        //Guarda variable de restaurante o bar en session
        Route::post('/ajax/set_restbar', function(){
             Session::put( 'restBar', Input::get('restBar') );
        });
        //Newsletter
        Route::post('/ajax/subscribe/{slug}', 'Mail\MailController@subscribe');
        Route::get('/subscribe/{slug}/activate/{idSlug}', 'Mail\MailController@activateView')
            ->name('subscribeActivateEs');
        // Route::get('/subscribe', 'Mail\MailController@viewSubscribe')
        //     ->name('ViewSubscribeEs');
    });

Route::prefix('en')
	->middleware(['checkIp', 'setLocals', 'marketValues'])
	->group(function () {
        // Route::get('/', 'Home\HomeController@index')
        //     ->name('RedirectHomeEn');
    	Route::get('/', 'Home\HomeController@index')
        	->name('HomeEn');
        Route::get('/rooms', 'Hoteles\RoomsController@index')
            ->name('HotelRoomsEn');
        Route::get('/restaurants_and_bars', 'Hoteles\RestaurantsController@index')
            ->name('HotelRestaurantsAndBarsEn');
        Route::get('/entertainment', 'Hoteles\EntretenimientoController@index')
            ->name('HotelEntertainmentEn');
        Route::get('/gallery', 'Hoteles\GaleriaController@index')
            ->name('HotelGalleryEn');
        Route::get('/services', 'Hoteles\ServiciosController@index')
            ->name('HotelServiciosEn');
        //Guarda variable de restaurante o bar en session
        Route::post('/ajax/set_restbar', function(){
             Session::put( 'restBar', Input::get('restBar') );
        });
        //Newsletter
        Route::post('/ajax/subscribe/{slug}', 'Mail\MailController@subscribe');
        Route::get('/subscribe/{slug}/activate/{idSlug}', 'Mail\MailController@activateView')
            ->name('subscribeActivateEn');
        // Route::get('/subscribe', 'Mail\MailController@viewSubscribe')
        //     ->name('ViewSubscribeEn');
    });