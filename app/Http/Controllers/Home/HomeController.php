<?php

namespace App\Http\Controllers\Home;

use App\Models\Hotel;
use App\Models\CentrosConsumo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request as Http;

//necesario para MAPS
use App\Http\Controllers\SignUrlGoogleController;

class HomeController extends Controller
{
    protected $lang;

    public function __construct()
    {
        $this->lang = Request::segment(1);
        App::setLocale($this->lang);
    }

    public function index(Http $request)
    {
        
        return view('home.home');
    }
}
