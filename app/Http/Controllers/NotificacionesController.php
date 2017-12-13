<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use Auth;
use Redirect;

class NotificacionesController  extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->summer = date('I');
        $this->app_customer_id = "fd0924a2-30e5-4498-9e0f-76b93a4e6487";
        $this->app_delivery_id = "4aa0dfbf-a53d-4ed8-ac09-94ef906aed6b";
        $this->app_customer_key = "ODAwMjZlM2QtNDNhYy00YTRhLWI1YWUtMGQyOWFkMjcwNDY4";
        $this->app_delivery_key = "NTJjN2RiOTMtYjBjMy00OGY2LWJmMjEtMzk4OTYyMzdjMmVh";
        $this->app_customer_icon = "http://cocoinbox.bsmx.tech/public/img/icono_cliente.png";
        $this->app_delivery_icon = "http://cocoinbox.bsmx.tech/public/img/icono_repartidor.png";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Notificaciones App';
        $menu = 'Ionic';
        $actual_date = date('Y-m-d');
        $clientes = Usuario::where('tipo', 1)->where('status', 1)->get();
        $repartidores = Usuario::where('tipo', 2)->where('status', 1)->get();
        return view('notificaciones.index', ['menu' => $menu, 'title' => $title, 'clientes' => $clientes, 'repartidores' => $repartidores, 'start_date' => $actual_date]);
    }

    /**
    * Envía una notificación a todos los usuarios de la aplicación
    * @return $response
    */
    public function enviar_notificacion_general(Request $req) 
    {
        $mensaje = $req->mensaje;
        $titulo = $req->titulo;
        $dia = $req->fecha;
        $hora = $req->hora;
        $app_id = $req->aplicacion == 1 ? $this->app_customer_id : $this->app_delivery_id;
        $app_key = $req->aplicacion == 1 ? $this->app_customer_key : $this->app_delivery_key;
        $icon = $req->aplicacion == 1 ? $this->app_customer_icon : $this->app_delivery_icon;
        $content = array(
            "en" => $mensaje
        );

        $header = array(
            "en" => $titulo
        );
        
        $fields = array(
            'app_id' => $app_id,
            'included_segments' => array('All'),
            'data' => array("type" => "general"),
            'headings' => $header,
            'contents' => $content,
            'large_icon' => $icon
        );

        if ($dia && $hora) {
            $time_zone = $dia.' '.$hora;
            $time_zone = $this->summer ? $time_zone.' '.'UTC-0500' : $time_zone.' '.'UTC-0600';
            $fields['send_after'] = $time_zone;
        }
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }

    /**
    * Envía una notificación a todos los usuarios de la aplicación
    * @return $response
    */
    public function enviar_notificacion_individual(Request $req) 
    {
        $player_ids = array();
        foreach($req->usuarios_id as $id) {
            $row = Usuario::where('id', $id)->first();
            $player_ids [] = $row->player_id;
        }

        $mensaje = $req->mensaje;
        $titulo = $req->titulo;
        $dia = $req->fecha;
        $hora = $req->hora;
        $app_id = $req->aplicacion == 1 ? $this->app_customer_id : $this->app_delivery_id;
        $app_key = $req->aplicacion == 1 ? $this->app_customer_key : $this->app_delivery_key;
        $icon = $req->aplicacion == 1 ? $this->app_customer_icon : $this->app_delivery_icon;

        $content = array(
            "en" => $mensaje
        );

        $header = array(
            "en" => $titulo
        );
        
        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => $player_ids,
            'data' => array('type' => 'individual'),
            'headings' => $header,
            'contents' => $content,
            'large_icon' => $icon
        );

        if ($dia && $hora) {
            $time_zone = $dia.' '.$hora;
            $time_zone = $this->summer ? $time_zone.' '.'UTC-0500' : $time_zone.' '.'UTC-0600';
            $fields['send_after'] = $time_zone;
        }

        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}
