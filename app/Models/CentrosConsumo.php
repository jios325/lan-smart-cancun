<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentrosConsumo extends Model
{
    protected $table = 'centros_consumo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeBars($query) {
        return $query->where('tipo', 'BAR');
    }
    public function scopeRestaurants($query) {
        return $query->where('tipo', 'RESTAURANTE');
    }
    public function hotels()
    {
        return $this->belongsToMany('App\Models\Hotel', 'centros_consumo_detalles', 'hotel_id', 'centro_consumo_id')
        ->withPivot('id', 'url', 'concepto_es', 'concepto_en', 'logo', 'logo_blanco', 'img_portada', 'destacado', 'costo');
    }
}
