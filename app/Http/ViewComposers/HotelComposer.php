<?php

namespace App\Http\ViewComposers;

// use App\Models\Hotel;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HotelMenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
       
      $hotel = DB::table('hotel')
        ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
        ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
        ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
        ->where('hotel.uri', 'grand-oasis-cancun')
        ->where('hotel.activo', 1)
        ->first();

        if(!$hotel) abort(404, 'el hotel no existe');
        $view->with(['hotel' => $hotel]);
        
    }
}
