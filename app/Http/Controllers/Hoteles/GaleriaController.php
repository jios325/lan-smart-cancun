<?php

namespace App\Http\Controllers\Hoteles;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

class GaleriaController extends Controller
{
    protected $lang;

    public function __construct()
    {
        $this->lang = Request::segment(1);
        App::setLocale($this->lang);
    }

    public function index(Http $request, $slug){
    	 $hotel = DB::table('hotel')
            ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
            ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
            ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
            ->where('hotel.uri', $slug)
            ->where('hotel.activo', 1)
            ->first();
        $galeria = DB::table('hotel_galeria')
            ->leftJoin('hotel_galeria_categoria', 'hotel_galeria_categoria.id_hotel_galeria_categoria', '=', 'hotel_galeria.id_hotel_galeria_categoria')
            ->where('hotel_galeria.id_hotel', $hotel->id_hotel)
            ->inRandomOrder()
            ->limit(13)
            ->get();
        $agrupado = array(
            $galeria->splice(0,5),
            $galeria->splice(0,3),
            $galeria->splice(0,5)
        );
        // $agrupado = $galeria->groupBy('nombre_cat_'.App::getLocale())->toArray();
        return view('hoteles.galeria')->with(['galeria' => $agrupado, 'hotel' => $hotel]);
    }
}