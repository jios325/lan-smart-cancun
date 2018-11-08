<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpLocation extends Model
{
    protected $table = 'ip2location_db3';
    protected $primaryKey = 'ip_from';
    public $timestamps = false;
}
