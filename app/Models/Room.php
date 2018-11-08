<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'hotel_habitacion_cat';
    protected $primaryKey = 'id_hotel_habitacion_cat';
    public $timestamps = false;

    public function hotels()
    {
        return $this->belongsToMany('App\Models\Hotel', 'hotel_habitaciones_por_hotel', 'id_hotel', 'id_hotel_habitacion_cat')->withPivot('estado');
    }
}
