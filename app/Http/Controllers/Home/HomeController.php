<?php

namespace App\Http\Controllers\Home;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

class HomeController extends Controller
{
    protected $lang;

    public function __construct()
    {
        $this->lang = Request::segment(1);
        App::setLocale($this->lang);
    }
    public function index(Http $request){
        return redirect()->action('Home\HomeController@home', ['slug' => 'grand-oasis-cancun']);
    }
    public function home(Http $request, $slug){   

        $hotel = DB::table('hotel')
            ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
            ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
            ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
            ->where('hotel.uri', $slug)
            ->where('hotel.activo', 1)
            ->first();

        if(!$hotel) abort(404, 'el hotel no existe');
        
        $habitaciones = Hotel::getByUrl($slug)->first()->rooms;
        foreach($habitaciones as $habitacion) {
            $habitacion->orden = $habitacion->pivot->orden;
            $img = DB::table('hotel_habitacion_galeria')
            ->where('id_hotel_habitaciones_por_hotel', $habitacion->pivot->id_hotel_habitaciones_por_hotel)
            ->where('hotel_habitacion_galeria.destacado', 1)
            ->first();
            $habitacion->img = $img->url;
            $amenidades = DB::table('hotel_habitaciones_por_amenidades')
                ->leftJoin('hotel_amenidades_cat', 'hotel_habitaciones_por_amenidades.id_amenidades', '=', 'hotel_amenidades_cat.id_hotel_amenidades_cat')
                ->select('*')
                ->where('hotel_habitaciones_por_amenidades.id_hotel_habitaciones_por_hotel', $habitacion->pivot->id_hotel_habitaciones_por_hotel)
                ->get();
            $facilidades = DB::table('hotel_facilidades_por_hotel')
                ->leftJoin('hotel_facilidades', 'hotel_facilidades.id_hotel_facilidades', '=', 'hotel_facilidades_por_hotel.id_hotel_facilidades')
                ->select('hotel_facilidades_por_hotel.*', 'hotel_facilidades.nombre_en', 'hotel_facilidades.nombre_es', 'hotel_facilidades.nombre_br', 'hotel_facilidades.icono')
                ->where('hotel_facilidades_por_hotel.id_hotel', $hotel->id_hotel)
                ->get();
            $highlights = DB::table('hotel_highlights_habitaciones_por_hotel')
                ->leftJoin('hotel_highlights', 'hotel_highlights_habitaciones_por_hotel.id_hotel_highlights', '=', 'hotel_highlights.id_hotel_highlights')
                ->select('*')
                ->where('hotel_highlights_habitaciones_por_hotel.id_hotel_habitaciones_por_hotel', $habitacion->pivot->id_hotel_habitaciones_por_hotel)
                ->get();
            $galeria = DB::table('hotel_habitacion_galeria')
                ->where('id_hotel_habitaciones_por_hotel', $habitacion->pivot->id_hotel_habitaciones_por_hotel)
                ->get();
            $habitacion->galeria = $galeria;
            $habitacion->amenidades = $amenidades;
            $habitacion->facilidades = $facilidades;
            $habitacion->highlights = $highlights;

        }
        $galeriaDestacado = DB::table('hotel_galeria')
            ->leftJoin('hotel_galeria_categoria', 'hotel_galeria_categoria.id_hotel_galeria_categoria', '=', 'hotel_galeria.id_hotel_galeria_categoria')
            ->where('hotel_galeria.id_hotel', $hotel->id_hotel)
            ->where('hotel_galeria_categoria.uri_categoria_hotel', 'destacados')
            ->get();
        // dd($hotel);
        return view('home.home')->with(['hotel' => $hotel, 'habitaciones' => $habitaciones->sortBy('orden'), 'galeria_destacados' => $galeriaDestacado]);
    }
}
