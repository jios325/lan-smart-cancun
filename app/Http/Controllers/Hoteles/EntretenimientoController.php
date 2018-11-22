<?php

namespace App\Http\Controllers\Hoteles;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

class EntretenimientoController extends Controller
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
        //Locaciones-------------------------------------------------------
            $entre = DB::table('entretenimiento_detalle')
                ->leftJoin('hotel', 'hotel.id_hotel', '=', 'entretenimiento_detalle.id_hotel')
                ->leftJoin('entretenimiento', 'entretenimiento.id', '=', 'entretenimiento_detalle.id_entretenimiento')
                ->select('entretenimiento.uri', 'entretenimiento.nombre', 'entretenimiento.logo', 'entretenimiento.descripcion_short_'.$this->lang.' as descripcion', 'entretenimiento_detalle.*')
                ->where('entretenimiento_detalle.id_hotel', $hotel->id_hotel)
                ->where('entretenimiento.estado', 1)
                ->orderByRaw('FIELD(nombre, "Oasis Beach Club","Red Circus","Red Casino") DESC')
                ->get();
            foreach($entre as $e) {
                $galeria = DB::table('entretenimiento_galeria')
                    ->where('entretenimiento_detalle_id', $e->id)
                    ->get();
                $e->galeria = $galeria;
            }
        return view('hoteles.entretenimiento')->with(['entretenimientos' => $entre, 'hotel' => $hotel]);
    }
}