<?php

namespace App\Http\Controllers\Hoteles;

use App\Models\Hotel;
use App\Models\CentrosConsumo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

class RestaurantsController extends Controller
{
    protected $lang;

    public function __construct()
    {
        $this->lang = Request::segment(1);
        App::setLocale($this->lang);
    }

    public function index(Http $request){
        $slug = config('app.hoteluri');
        $hotel = DB::table('hotel')
            ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
            ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
            ->leftJoin('hotel_descripciones_secciones', 'hotel.id_hotel', '=', 'hotel_descripciones_secciones.id_hotel')
            ->select('hotel.*', 'redes_sociales.*', 'hotel_descripciones_secciones.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
            ->where('hotel.uri', $slug)
            ->where('hotel.activo', 1)
            ->first();
        if(!$hotel) abort(404, 'el hotel no existe');    

        $Fb = Hotel::getByUrl($slug)->first()->foodAndBeverages()->get();
        $baresArray = [];
        $baresArrayDestacado = [];
        $restaurantsArray = [];
        $restaurantsArrayDestacado = [];
        foreach($Fb as $f) {
            if ($f->tipo === 'BAR' && $f->pivot->destacado){
                \array_push($baresArrayDestacado, $f);
            } 
            else if($f->tipo === 'BAR' && !$f->pivot->destacado) {
                \array_push($baresArray, $f);
            }
            elseif ($f->tipo === 'RESTAURANTE' && $f->pivot->destacado){
                \array_push($restaurantsArrayDestacado, $f);
            } else if($f->tipo === 'RESTAURANTE' && !$f->pivot->destacado) {
                \array_push($restaurantsArray, $f);
            }
        }

        $bares = (count($baresArrayDestacado) > 0)
            ? collect(['destacados' => $baresArrayDestacado, 'otros' => $baresArray])
            : collect(['otros' => $baresArray]);
        $restaurants = (count($restaurantsArrayDestacado) > 0)
            ? collect(['destacados' => $restaurantsArrayDestacado, 'otros' => $restaurantsArray])
            : collect(['otros' => $restaurantsArray]);

        return view('hoteles.restaurantes_y_bares')->with(['hotel' => $hotel, 'bares' => $bares, 'restaurants' => $restaurants]);
    }




    // public function getExclusiveRestaurants(Http $request)
    // {
    //     /*-----------Inicia Config SEO --------------*/
    //         //categoria de homes-restaurantes es 12
    //         //pag especifica es 0 para homes
    //         //mercado de habitaciones actualmente estan por general
    //         $seo = Seo::getHomesByHotel($id_seo_categoria = 12, $mercado = 'General', $lang = $this->lang, $hotel = NULL)->first();
    //         if (!empty($seo)) {
    //             SEOMeta::setTitle($seo->titulo);
    //             SEOMeta::setDescription($seo->descripcion);
    //             SEOMeta::setCanonical($this->canonical);
    //             SEOMeta::addAlternateLanguages(HomeController::returnUrlChangeLang($request, $this->lang, Route::currentRouteName()));
    //             OpenGraph::setDescription($seo->descripcion);
    //             OpenGraph::setTitle($seo->titulo.' | Oasis Hotels & Resorts');
    //             OpenGraph::setUrl($this->canonical);
    //             OpenGraph::addImage($seo->img_graph, ['height' => $seo->img_graph_height, 'width' => $seo->img_graph_width]);
    //         }
    //     /*-----------Termina Config SEO --------------*/
    //     $restaurants = DB::table('centros_consumo_detalles')
    //         ->leftJoin('hotel', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //         ->leftJoin('centros_consumo', 'centros_consumo_detalles.centro_consumo_id', '=', 'centros_consumo.id')
    //         ->select('centros_consumo_detalles.id','centros_consumo_detalles.img_portada', 'centros_consumo_detalles.logo_blanco', 'centros_consumo_detalles.url', 'hotel.uri as hotel', 'hotel.locacion', 'centros_consumo.nombre', 'centros_consumo_detalles.concepto_es', 'centros_consumo_detalles.centro_consumo_id')
    //         ->where('centros_consumo_detalles.exclusivo', 1)
    //         ->orderBy('centros_consumo.nombre', 'ASC')->get();
    //     foreach($restaurants as $r) {
    //         $galeria = DB::table('centros_consumo_imagenes')
    //             ->where('centro_consumo_detalle_id', $r->id)
    //             ->first();
    //         $hoteles = DB::table('hotel')
    //             ->leftJoin('centros_consumo_detalles', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //             ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
    //             ->select('hotel.logo', 'hotel.nombre_en', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
    //             ->where('centros_consumo_detalles.centro_consumo_id', $r->centro_consumo_id)
    //             ->get();
    //         $r->hoteles = $hoteles;
    //         $r->img = $galeria->url;
    //         foreach ($r->hoteles as $key => $hot) {
    //             $onehotel = explode(".", $hot->logo);
    //             $newarr = array($onehotel[0] , "_gris.png");
    //             $logogris = implode("", $newarr);
    //             $hot->logo_gris = $logogris;
    //         }
    //     }
    //     return view('restaurantes.general')->with(['restaurants' => $restaurants]);
    // }
    // public function getExclusiveRestaurantByUrl(Http $request, $restaurant)
    // {

    //     /*-----------Inicia Config SEO --------------*/
    //         //categoria de restaurants es 12
    //         //mercado de habitaciones actualmente estan por general
    //         $seo = Seo::getBySpecificPage($id_seo_categoria = 12, $mercado = 'General', $lang = $this->lang)
    //                 ->leftJoin('centros_consumo_detalles', 'centros_consumo_detalles.id', 'seo_datos_por_pagina.id_pagina_especifica')
    //                 ->where('centros_consumo_detalles.url', $restaurant)
    //                 ->first();
    //         if (!empty($seo)) {
    //             SEOMeta::setTitle($seo->titulo, false);
    //             SEOMeta::setDescription($seo->descripcion);
    //             SEOMeta::setCanonical($this->canonical);
    //             SEOMeta::addAlternateLanguages(HomeController::returnUrlChangeLang($request, $this->lang, Route::currentRouteName()));
    //             OpenGraph::setDescription($seo->descripcion);
    //             OpenGraph::setTitle($seo->titulo.' | Oasis Hotels & Resorts');
    //             OpenGraph::setUrl($this->canonical);
    //             OpenGraph::addImage($seo->img_graph, ['height' => $seo->img_graph_height, 'width' => $seo->img_graph_width]);
    //         }
    //     /*-----------Termina Config SEO --------------*/

    //     $url = $restaurant;
    //     $restaurant = DB::table('centros_consumo_detalles')
    //         ->leftJoin('hotel', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //         ->leftJoin('centros_consumo', 'centros_consumo_detalles.centro_consumo_id', '=', 'centros_consumo.id')
    //         ->leftJoin('redes_sociales', 'centros_consumo_detalles.redes_sociales_id', '=', 'redes_sociales.id')
    //         ->select('centros_consumo_detalles.*', 'redes_sociales.twitter', 'redes_sociales.facebook', 'redes_sociales.instagram', 'hotel.uri as hotel', 'hotel.locacion', 'centros_consumo.nombre', 'centros_consumo.video')
    //         ->where('centros_consumo_detalles.exclusivo', 1)
    //         ->where('centros_consumo_detalles.url', $url)
    //         ->first();
    //     if(!$restaurant) abort(404, 'el restaurante no existe');
    //     $restaurants = DB::table('centros_consumo_detalles')
    //         ->leftJoin('hotel', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //         ->leftJoin('centros_consumo', 'centros_consumo_detalles.centro_consumo_id', '=', 'centros_consumo.id')
    //         ->select('centros_consumo_detalles.id','centros_consumo_detalles.img_portada', 'centros_consumo_detalles.logo_blanco', 'centros_consumo_detalles.url', 'hotel.uri as hotel', 'hotel.locacion', 'centros_consumo.nombre', 'centros_consumo_detalles.concepto_es', 'centros_consumo_detalles.centro_consumo_id')
    //         ->where('centros_consumo_detalles.exclusivo', 1)
    //         ->orderBy('centros_consumo.nombre', 'ASC')->get();
    //     $galeria = DB::table('centros_consumo_imagenes')
    //         ->where('centro_consumo_detalle_id', $restaurant->id)
    //         ->get();
    //     $hoteles = DB::table('hotel')
    //         ->leftJoin('centros_consumo_detalles', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //         ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
    //         ->select('hotel.logo', 'hotel.nombre_en', 'hotel.uri', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
    //         ->where('centros_consumo_detalles.centro_consumo_id', $restaurant->centro_consumo_id)
    //         ->get();
    //     //premios
    //     $premios_destacados = DB::table('centros_consumo_premios')
    //         ->leftJoin('centros_consumo_detalles', 'centros_consumo_premios.centro_consumo_detalles_id', '=', 'centros_consumo_detalles.id')
    //         ->where('centros_consumo_premios.destacado', 1)
    //         ->where('centros_consumo_detalles.url', $url)
    //         ->get();
    //     $premios_gallery = DB::table('centros_consumo_premios')
    //         ->leftJoin('centros_consumo_detalles', 'centros_consumo_premios.centro_consumo_detalles_id', '=', 'centros_consumo_detalles.id')
    //         ->where('centros_consumo_premios.destacado', '!=', 1)->orWhereNull('centros_consumo_premios.destacado')
    //         ->where('centros_consumo_detalles.url', $url)
    //         ->orderByRaw('FIELD(nombre, "4 Diamond","Dirona") ASC')// se ponen al final del Array
    //         ->get();
    //     // dd($galeria);
    //         // print_r($premios_gallery->isEmpty());
    //     $parallax = 'make-parallax';
    //     // dd($premios_gallery);
    //     if($premios_gallery->isEmpty()){

    //         return ($request->isMobile) ? view('restaurantes.especifico')->with(['restaurant' => $restaurant, 'destacados' => $restaurants, 'galeria' => $galeria, 'hoteles' => $hoteles, 'premios_destacados' => $premios_destacados]) : view('restaurantes.especifico')->with(['restaurant' => $restaurant, 'destacados' => $restaurants, 'galeria' => $galeria, 'hoteles' => $hoteles, 'premios_destacados' => $premios_destacados, 'parallax' => $parallax]);
    //     }
    //     else{
    //         return ($request->isMobile) ? view('restaurantes.especifico')->with(['restaurant' => $restaurant, 'destacados' => $restaurants, 'galeria' => $galeria, 'hoteles' => $hoteles, 'premios_destacados' => $premios_destacados, 'premios_gallery' => $premios_gallery]) : view('restaurantes.especifico')->with(['restaurant' => $restaurant, 'destacados' => $restaurants, 'galeria' => $galeria, 'hoteles' => $hoteles, 'premios_destacados' => $premios_destacados, 'premios_gallery' => $premios_gallery, 'parallax' => $parallax]);
    //     }
    // }
    
    // public function getBarByHotelAndUrl(Http $request, $slug, $urlBar)
    // {
        
    //     $hotel = DB::table('hotel')
    //         ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
    //         ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
    //         ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
    //         ->where('hotel.uri', $slug)
    //         ->where('hotel.activo', 1)
    //         ->first();

    //     if(!$hotel) abort(404, 'el hotel no existe');

    //     $claveStay=[];
    //     if(config('app.market')=='USA'||config('app.market')=='México') {
    //         $claveStay=$this->stayWanderful[$slug];
    //      }
    //     /*-----------Inicia Config SEO --------------*/
    //         //categoria de bares es 13
    //         //mercado de habitaciones actualmente estan por general
    //         $seo = Seo::getBySpecificPage($id_seo_categoria = 13, $mercado = 'General', $lang = $this->lang)
    //                 ->leftJoin('centros_consumo_detalles', 'centros_consumo_detalles.id', 'seo_datos_por_pagina.id_pagina_especifica')
    //                 ->leftJoin('hotel', 'hotel.id_hotel', 'centros_consumo_detalles.hotel_id')
    //                 ->where('centros_consumo_detalles.url', $urlBar)
    //                 ->where('hotel.uri', $slug)
    //                 ->first();
    //         if (!empty($seo)) {
    //             SEOMeta::setTitle($seo->titulo, false);
    //             SEOMeta::setDescription($seo->descripcion);
    //             SEOMeta::setCanonical($this->canonical);
    //             SEOMeta::addAlternateLanguages(HomeController::returnUrlChangeLang($request, $this->lang, Route::currentRouteName()));
    //             OpenGraph::setDescription($seo->descripcion);
    //             OpenGraph::setTitle($seo->titulo.' | Oasis Hotels & Resorts');
    //             OpenGraph::setUrl($this->canonical);
    //             OpenGraph::addImage($seo->img_graph, ['height' => $seo->img_graph_height, 'width' => $seo->img_graph_width]);
    //         }
    //     /*-----------Termina Config SEO --------------*/
    //     $Fb = Hotel::getByUrl($slug)->first()->foodAndBeverages()->get();
    //     /*---------Inicia Llamado a Firma de URL para Maps -----------*/
    //         $inputUrl = 'https://maps.googleapis.com/maps/api/staticmap?scale=2&zoom=14&size=640x300&maptype=roadmap&key='.$this->apikeyMaps.'&format=png&visual_refresh=true&markers=scale:2%7Cicon:http://oasishoteles.com/img/logos/pines/'.head(explode('.', $hotel->puntero)).'.png%7Cshadow:false%7C'.$hotel->corx.',+'.$hotel->cory;
    //         $mapUrlSigned = (new SignUrlGoogleController)->signUrl($inputUrl, $this->secretMaps);
     
    //     /*-----------Termina Llamado a Firma de URL para Maps----------*/
    //     $restaurant = null;
    //     $restaurantsArrayDestacado = [];
    //     foreach($Fb as $rest) {
    //         if($rest->pivot->url === $urlBar && $rest->tipo === 'BAR') {
    //             $restaurant = $rest->pivot;
    //             $restaurant->detail = $rest;
    //         }
    //         if ($rest->tipo === 'BAR' && $rest->pivot->destacado && $rest->pivot->url !== $urlBar){
    //             \array_push($restaurantsArrayDestacado, $rest);
    //         }
    //     }
    //     if(!$restaurant) abort(404, 'el bar no existe');
    //     $hoteles = DB::table('hotel')
    //         ->leftJoin('centros_consumo_detalles', 'hotel.id_hotel', '=', 'centros_consumo_detalles.hotel_id')
    //         ->select('hotel.logo', 'hotel.nombre_en','hotel.uri')
    //         ->where('centros_consumo_detalles.centro_consumo_id', $restaurant->centro_consumo_id)
    //         ->get();
    //     $galeria = DB::table('centros_consumo_imagenes')
    //         ->where('centro_consumo_detalle_id', $restaurant->id)
    //         ->get();
    //     $parallax = 'make-parallax';
    //     return ($request->isMobile) ? view('hoteles.bar')->with(['hotel' => $hotel, 
    //         'hoteles' => $hoteles,
    //         'restaurant' => $restaurant,
    //         'galeria' => $galeria, 'destacados' => $restaurantsArrayDestacado,
    //         'tipo' => 'bares','mapUrl'=>$mapUrlSigned]) : view('hoteles.bar')->with(['hotel' => $hotel, 
    //         'hoteles' => $hoteles,
    //         'restaurant' => $restaurant,
    //         'galeria' => $galeria, 'destacados' => $restaurantsArrayDestacado,
    //         'tipo' => 'bares', 'parallax' => $parallax,'claveStay'=>$claveStay,'mapUrl'=>$mapUrlSigned]);
    // }
    
}
