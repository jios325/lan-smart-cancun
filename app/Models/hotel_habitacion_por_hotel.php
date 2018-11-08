<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model\Pivot;

class hotel_habitacion_por_hotel extends Pivot
{
    protected $table = 'hotel_habitacion_por_hotel';
    protected $primaryKey = 'id_hotel_habitacion_por_hotel';
    public $timestamps = false;
}
