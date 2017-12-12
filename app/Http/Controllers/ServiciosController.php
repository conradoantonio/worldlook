<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\Estilista;
use App\ServicioDetalle;
use DB;
use Auth;
use PDO;
use Redirect;
use Mail;

require_once("conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_wsnGdPKAe4pyTFhCs84qVw");
\Conekta\Conekta::setApiVersion("2.0.0");

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $title = "Servicios";
            $menu = "Servicios";
            $pedidos = Servicio::obtener_pedidos();
            return view('pedidos.pedidos', ['pedidos' => $pedidos, 'menu' => $menu, 'title' => $title]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Obtiene la información de un pedido en específico y su número de guía en caso de que tenga uno.
     *
     * @return $pedidos
     */
    public function obtener_pedido_por_id(Request $request)
    {
        $pedido = Servicio::select(DB::raw('servicios.*, estilistas.nombre AS estilista_nombre, estilistas.apellido AS estilista_apellido, estilistas.imagen as estilista_foto'))
        ->where('conekta_order_id', $request->orden_id)
        ->leftJoin('estilistas', 'servicios.estilista_id', '=', 'estilistas.id')
        ->first();
        $pedido->detalles = ServicioDetalle::where('servicio_id', $pedido->id)->get();
        $pedido->cantidad_productos = ServicioDetalle::where('servicio_id', $pedido->id)->where('tipo', 'producto')->count();
        $pedido->cantidad_servicios = ServicioDetalle::where('servicio_id', $pedido->id)->where('tipo', 'servicio')->count();
        return $pedido;
    }

    /**
     * Carga los estilistas disponibles dentro de un rango de fechas y horas que no.
     *
     * @return $pedidos
     */
    public function cargar_estilistas_disponibles(Request $request)
    {
        $start_datetime = $request->start_datetime;
        $end_datetime = $request->end_datetime;
        $estilista_id = $request->estilista_id ? $request->estilista_id : false;
        $ids = Estilista::cargar_estilistas_disponibles($start_datetime, $end_datetime);
        return Estilista::filtrar_estilistas(1, $ids, $estilista_id);
    }

    /**
     * Asigna un estilista a un servicio.
     *
     * @return $estilistas
     */
    public function asignar_estilista(Request $request)
    {
        Servicio::where('conekta_order_id', $request->servicio_id)
        ->update(['estilista_id' => $request->estilista_id]);

        return Estilista::where('id', $request->estilista_id)
        ->first();
    }
}
