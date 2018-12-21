<?php

namespace App\Http\Controllers\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MailValidator;
use App\Models\Hotel;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request as Http;
use Illuminate\Support\Facades\Redirect;

class MailController extends Controller
{
    protected $lang;
    public function __construct()
    {
        $this->lang = Request::segment(1);
        App::setLocale($this->lang);
    }
    public function index(Http $request)
    {
        //
    }
    public function subscribe(Http $request, $slug){
        $this->validate($request,[
            'email' => 'required|email|unique:newsletter|max:255',
        ]);
        $local = DB::table('vista_mercados')->where('ip_from', '<=', $request->ip)->where('ip_to', '>=', $request->ip)->first();
        $data=[
            'email'=> $request->input('email'),
            'user_ip'=>$request->ip(),
            'pais'=>$local->country_name,
            'ciudad'=>$local->city_name
        ];
        $id=DB::table('newsletter')->insertGetId($data);
        $mail=[
            'url'=>url(Request::segment(1).'/subscribe'.'/'. $slug .'/'.'activate/' . $id)
        ];
        Mail::to($request->input('email'), 'Oasis Hoteles Newsletter')->send(new NewsletterMail($mail));
        if( count(Mail::failures()) > 0 ) {
            echo 'Error al Enviar el Correo!';
         } else {
            echo __('newsletter.subscrito');
         }
    }
    public function activateView(Http $request, $slug, $idSlug){
        $hotel = DB::table('hotel')
        ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
        ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
        ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
        ->where('hotel.uri', $slug)
        ->where('hotel.activo', 1)
        ->first();
        $user=DB::table('newsletter')
            // ->where('activado',0)
            ->where('id',$idSlug)
            ->first();
        if(!$user) abort(404, 'el Usuario no existe o ya ha sido activado');
        return view('forms.newsletter-confirmation',compact('hotel','user'));
    }
    public function activateProcess(Http $request){
        $this->validate($request,[
            'nombre' => 'required',
            'apellido' => 'required',
            'tel' => 'required',
            'direccion' => 'required',
        ]);
        $data = [
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'tel' => $request->input('tel'),
            'direccion' => $request->input('direccion'),
            'activado' => 1
        ];
        $id = $request->input('id');

        $update = DB::table('newsletter')
                    ->where('id', $id)
                    ->update($data);
        if(!$update){
            echo 'error al Actualizar los datos';
        }
        else{
            //mensaje de suscripcion---------
            if($this->lang == 'es'){
                $mensaje = 'Muchas gracias por suscribirte a nuestro Newsletter, ahora podrás estar al tanto de nuestras actualizaciones.'; 
            }
            else{
                $mensaje = 'Thank you very much for subscribing to our Newsletter, now you can be aware of our updates.';
            }
            $swal = [
                'className' => "oasis-msj",
                'text' => $mensaje,
                'button' => 'OK'
            ];
            return $swal;
        }
        
        // return __('newsletter.bienvenido_newsletter');
    }
    //renderiza la vista del formulario --- descomentar solo para edicion
    // public function viewSubscribe(Http $request, $slug){

    //     $hotel = DB::table('hotel')
    //         ->leftJoin('redes_sociales', 'hotel.redes_sociales_id', '=', 'redes_sociales.id')
    //         ->leftJoin('hotel_ubicacion', 'hotel_ubicacion.id_hotel','hotel.id_hotel')
    //         ->select('hotel.*', 'redes_sociales.*', 'hotel_ubicacion.calle', 'hotel_ubicacion.localidad', 'hotel_ubicacion.cp', 'hotel_ubicacion.direccion_es', 'hotel_ubicacion.corx', 'hotel_ubicacion.cory', 'hotel_ubicacion.puntero', 'hotel_ubicacion.id_location_map')
    //         ->where('hotel.uri', $slug)
    //         ->where('hotel.activo', 1)
    //         ->first();

    //     $user = '1';
    //     return view('forms.newsletter-confirmation',compact('hotel', 'user'));
    // }
}
