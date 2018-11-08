<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CentrosConsumoDetalles extends Pivot
{
    protected $table = 'centros_consumo_detalles';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
