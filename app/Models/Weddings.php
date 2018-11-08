<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weddings extends Model
{
	protected $table = 'weddings_paquetes_por_mercado';
    protected $primaryKey = 'idweddings_planes';
    public $timestamps = false;

}