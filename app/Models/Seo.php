<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
	protected $table = 'seo_datos_por_pagina';
	protected $primaryKey = 'id_seo_datos_por_pagina';
    public $timestamps = false;


    public function scopeGetHomes($query, $categoria, $mercado, $lang){

    	return $query
    			->leftJoin('hotel_mercados', 'hotel_mercados.id_hotel_mercados', 'seo_datos_por_pagina.id_hotel_mercados')
    			->select('seo_datos_por_pagina.titulo_'.$lang.' as titulo', 'seo_datos_por_pagina.descripcion_'.$lang.' as descripcion', 'seo_datos_por_pagina.keywords_'.$lang.' as keywords', 'seo_datos_por_pagina.img_graph', 'seo_datos_por_pagina.img_graph_width', 'seo_datos_por_pagina.img_graph_height')
    			->where('seo_datos_por_pagina.id_seo_categoria', $categoria)
    			->where('seo_datos_por_pagina.id_pagina_especifica', 0)
    			->where('hotel_mercados.nombre_mercado',$mercado);
    }
    public function scopeGetHomesByHotel($query, $categoria, $mercado, $lang, $hotel){

    	return $query
    			->leftJoin('hotel_mercados', 'hotel_mercados.id_hotel_mercados', 'seo_datos_por_pagina.id_hotel_mercados')
    			->leftJoin('hotel', 'hotel.id_hotel', 'seo_datos_por_pagina.id_hotel')
    			->select('seo_datos_por_pagina.titulo_'.$lang.' as titulo', 'seo_datos_por_pagina.descripcion_'.$lang.' as descripcion', 'seo_datos_por_pagina.keywords_'.$lang.' as keywords', 'seo_datos_por_pagina.img_graph', 'seo_datos_por_pagina.img_graph_width', 'seo_datos_por_pagina.img_graph_height')
    			->where('seo_datos_por_pagina.id_seo_categoria', $categoria)
    			->where('seo_datos_por_pagina.id_pagina_especifica', 0)
    			->where('hotel_mercados.nombre_mercado',$mercado)
    			->where('hotel.uri', $hotel);
    }
    public function scopeGetBySpecificPage($query, $categoria, $mercado, $lang){
    	return $query
    			->leftJoin('hotel_mercados', 'hotel_mercados.id_hotel_mercados', 'seo_datos_por_pagina.id_hotel_mercados')
    			->select('seo_datos_por_pagina.titulo_'.$lang.' as titulo', 'seo_datos_por_pagina.descripcion_'.$lang.' as descripcion', 'seo_datos_por_pagina.keywords_'.$lang.' as keywords', 'seo_datos_por_pagina.img_graph', 'seo_datos_por_pagina.img_graph_width', 'seo_datos_por_pagina.img_graph_height')
    			->where('hotel_mercados.nombre_mercado', $mercado)
    			->where('seo_datos_por_pagina.id_seo_categoria', $categoria);
    }
}
