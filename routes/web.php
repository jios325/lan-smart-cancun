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
        Route::get('/', 'Home\HomeController@index')
            ->name('RedirectHomeEs');
   		Route::get('/{slug}', 'Home\HomeController@index')
        	->name('HomeEs');
        Route::get('/{slug}/habitaciones', 'Hoteles\RoomsController@index')
            ->name('HotelRoomsEs');
        Route::get('/{slug}/restaurantes_y_bares', 'Hoteles\RestaurantsController@index')
            ->name('HotelRestaurantsAndBarsEs');
        Route::get('/{slug}/entretenimiento', 'Hoteles\EntretenimientoController@index')
            ->name('HotelEntertainmentEs');
        Route::get('/{slug}/galeria', 'Hoteles\GaleriaController@index')
            ->name('HotelGalleryEs');
        Route::get('/{slug}/servicios', 'Hoteles\ServiciosController@index')
            ->name('HotelServiciosEs');
        //Guarda variable de restaurante o bar en session
        Route::post('/ajax/set_restbar', function(){
             Session::put( 'restBar', Input::get('restBar') );
        });
    });

Route::prefix('en')
	->middleware(['checkIp', 'setLocals', 'marketValues'])
	->group(function () {
        Route::get('/', 'Home\HomeController@index')
            ->name('RedirectHomeEn');
    	Route::get('/{slug}', 'Home\HomeController@index')
        	->name('HomeEn');
        Route::get('/{slug}/rooms', 'Hoteles\RoomsController@index')
            ->name('HotelRoomsEn');
        Route::get('/{slug}/restaurants_and_bars', 'Hoteles\RestaurantsController@index')
            ->name('HotelRestaurantsAndBarsEn');
        Route::get('/{slug}/entertainment', 'Hoteles\EntretenimientoController@index')
            ->name('HotelEntertainmentEn');
        Route::get('/{slug}/gallery', 'Hoteles\GaleriaController@index')
            ->name('HotelGalleryEn');
        Route::get('/{slug}/services', 'Hoteles\ServiciosController@index')
            ->name('HotelServiciosEn');
        //Guarda variable de restaurante o bar en session
        Route::post('/ajax/set_restbar', function(){
             Session::put( 'restBar', Input::get('restBar') );
        });
    });