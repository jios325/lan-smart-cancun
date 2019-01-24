<?php

namespace App\Http\Controllers\Hoteles;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

class ServiciosController extends Controller
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
            ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
            ->where('hotel.uri', $slug)
            ->where('hotel.activo', 1)
            ->first();
        return view('hoteles.servicios')->with(['hotel' => $hotel]);
    }
}