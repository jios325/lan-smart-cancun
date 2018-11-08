<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCategoria extends Model
{
    protected $table = 'eventos_categoria';
    protected $primaryKey = 'ideventos_categoria';
    public $timestamps = false;

    public function eventos()
    {
        return $this->hasMany('App\Models\Evento', 'idcategoria');
    }

}
