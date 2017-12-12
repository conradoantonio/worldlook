<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Servicio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_cliente', 'correo_cliente', 'conekta_order_id', 'customer_id_conekta', 'costo_total', 'telefono', 'recibidor', 'calle', 'num_ext', 'num_int', 
        'ciudad', 'estado', 'pais', 'codigo_postal', 'comentarios', 'datetime_formated', 'start_datetime', 'end_datetime', 'estilista_id', 'status', 'is_finished', 
        'puntuacion_estilista', 'puntuacion_usuario', 'comentario_estilista', 'comentario_usuario', 'last_digits', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Obtiene todos los pedidos realizados
     *
     * @return $pedidos
     */
    public static function obtener_pedidos()
    {
        $servicios = Servicio::select(DB::raw('servicios.*, estilistas.nombre AS nombre_estilista, estilistas.apellido AS apellido_estilista'))
        ->leftJoin('estilistas', 'servicios.estilista_id', '=', 'estilistas.id')
        ->get();

        foreach ($servicios as $servicio) {
            $servicio->cantidad_productos = ServicioDetalle::where('servicio_id', $servicio->id)->where('tipo', 'producto')->count();
            $servicio->cantidad_servicios = ServicioDetalle::where('servicio_id', $servicio->id)->where('tipo', 'servicio')->count();
        }

        return $servicios;
    }
    
    /**
     *
     * @return Regresa el total de serviciosa
     */
    public static function total_servicios()
    {
        return Servicio::count();
    }

    /**
     *
     * @return Regresa el total de ventas filtrados por empresa
     */
    public static function total_vendido()
    {
        return Servicio::where('status', 'paid')
        ->sum(DB::raw('costo_total'));
    }

    /**
     *
     * @return Regresa el total de ventas semanales
     */
    public static function ventas_semanales()
    {
        return DB::table('servicios')
        ->select(DB::raw('SUBSTRING_INDEX(created_at, " ", 1) as created_at, SUM(costo_total)/100 AS "Costo_total", 
            MONTH(`created_at`) AS Mes, DAY(`created_at`) AS Dia, COUNT(*) AS Total_Ventas'))
        ->where('created_at', '>=', DB::raw('SUBDATE(CURDATE(),INTERVAL 7 DAY)'))
        ->where('created_at', '<', DB::raw('CURDATE()'))
        ->where('status', 'paid')
        ->groupBy(DB::raw('DAY(created_at)'))
        ->get();
    }

    /**
     *
     * @return Regresa el customer_id_conekta de un usuario
     */
    public static function obtener_id_conekta_usuario($usuario_id)
    {
        return DB::table('usuario')->where('id', $usuario_id)->pluck('customer_id_conekta');
    }

    /**
     *
     * @return Regresa los números de guía de los pedidos de un usuario
     */
    public static function obtener_num_guia_pedido($id_conekta)
    {
        return Servicio::where('customer_id_conekta', $id_conekta)->get();
    }

    /**
     *
     * @return Regresa los números de guía de los pedidos de un usuario
     */
    public static function obtener_pedidos_usuario($customer_id_conekta)
    {
        return Servicio::where('customer_id_conekta', $customer_id_conekta)->get();
    }
}
