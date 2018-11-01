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
    });

Route::prefix('en')
	->middleware(['checkIp', 'setLocals', 'marketValues','redirectNonWww'])
	->group(function () {
    	Route::get('/', 'Home\HomeController@index')
        	->name('HomeEn');
    });