<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
    protected $primaryKey = 'ideventos';
    public $timestamps = false;

    public function scopeActivos($query)
    {
        return $query->where('fechacompleja', '>', Carbon::now()->toDateString())->where('id_estado', 1);
    }
    public function scopeGetByUrl($query, $url)
    {
        return $query->where('evento_url', $url);
    }
    public function categoria ()
    {
        return $this->belongsTo('App\Models\EventoCategoria', 'idcategoria');
    }
}
