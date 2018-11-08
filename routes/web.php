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

Route::get('redirect/{lang}/{route}', 'Home\HomeController@changeLang')
    ->where('lang', 'es|en');

Route::middleware(['checkIp', 'setLocals', 'marketValues','redirectNonWww'])
    ->get('/', 'Home\HomeController@index');
    
Route::prefix('es')
	->middleware(['checkIp', 'setLocals', 'marketValues','redirectNonWww'])
	->group(function () {
   		Route::get('/', 'Home\HomeController@index')
        	->name('HomeEs');
        Route::get('/habitaciones', 'Hoteles\RoomsController@index')
            ->name('HotelRoomsEs');
        Route::get('/restaurantes_y_bares', 'Hoteles\RestaurantsController@getRestaurantsAndBarsByHotel')
            ->name('HotelRestaurantsAndBarsEs');
        Route::get('/entretenimiento', 'Hoteles\EntretenimientoController@getHotelEntertainment')
            ->name('HotelEntertainmentEs');
        Route::get('/galeria', 'Hoteles\GaleriaController@getHotelGallery')
            ->name('HotelGalleryEs');
        Route::get('/servicios', 'Hoteles\ServiciosController@getHotelServicios')
            ->name('HotelServiciosEs');
    });

Route::prefix('en')
	->middleware(['checkIp', 'setLocals', 'marketValues','redirectNonWww'])
	->group(function () {
    	Route::get('/', 'Home\HomeController@index')
        	->name('HomeEn');
        Route::get('/rooms', 'Hoteles\RoomController@index')
            ->name('HotelRoomsEn');
        Route::get('/restaurants_and_bars', 'Hoteles\RestaurantsController@getRestaurantsAndBarsByHotel')
            ->name('HotelRestaurantsAndBarsEn');
        Route::get('/entertainment', 'Hoteles\EntretenimientoController@getHotelEntertainment')
            ->name('HotelEntertainmentEn');
        Route::get('/gallery', 'Hoteles\GaleriaController@getHotelGallery')
            ->name('HotelGalleryEn');
        Route::get('/services', 'Hoteles\ServiciosController@getHotelServicios')
            ->name('HotelServiciosEn');
    });