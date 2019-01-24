<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = false;

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room', 'hotel_habitaciones_por_hotel', 'id_hotel', 'id_hotel_habitacion_cat')->withPivot('estado', 'id_hotel_habitaciones_por_hotel', 'descripcion_es', 'descripcion_en', 'orden')->where('estado','1');
    }
    public function foodAndBeverages()
    {
        return $this->belongsToMany('App\Models\CentrosConsumo', 'centros_consumo_detalles', 'hotel_id', 'centro_consumo_id')
            ->withPivot('id', 'url', 'concepto_es', 'concepto_en', 'descripcion_es', 'descripcion_en', 'logo', 'logo_blanco', 'img_portada', 'img_portada_destacado', 'destacado', 'linkto_exclusivo', 'costo')->orderBy('orden', 'ASC');
            // ->using('App\Models\CentrosConsumoDetales');
    }
    public function scopeActiveAndLocation($query, $location)
    {
        return $query->where('activo', 1)->where('locacion', $location);
    }
    public function scopeUrlAndLocation($query, $uri, $location)
    {
        return $query->where('uri', $uri)->where('locacion', $location);
    }
    public function scopeGetByUrl($query, $url)
    {
        return $query->where('uri', $url)->where('activo', 1);
    }
    public function salones()
    {
        return $this->hasMany('App\Models\Salones','hotel_id_hotel','id_hotel');
    }
}
