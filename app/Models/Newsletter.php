<?php

namespace App\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    //
    protected $table = 'newsletter';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
