<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Usuario extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'usuario';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['password', 'nombre', 'apellido', 'correo', 'foto_perfil', 'celular', 'customer_id_conekta', 'status'];

    /**
     * Busca usuarios que coincidan con un correo.
     */
    public static function buscar_usuario_por_correo($correo)
    {
    	return DB::table('usuario')
        ->where('correo', '=', $correo)
        ->get();
    }

    public static function buscar_id_conekta_usuario_app($correo)
    {
    	return DB::table('usuario')
        ->where('correo', '=', $correo)
        ->pluck('customer_id_conekta');
    }

    public static function buscar_id_conekta_usuario_app_por_id($id)
    {
        return Usuario::where('id', '=', $id)
        ->pluck('customer_id_conekta');
    }

    public static function actualizar_id_conekta_usuario_app($correo, $customer_id_conekta)
    {
    	return DB::table('usuario')
        ->where('correo', '=', $correo)
        ->update(['customer_id_conekta' => $customer_id_conekta]);
    }

    /**
     *
     * @return Regresa el total de usuarios registrados y activos en la aplicación filtrados por empresa
     */
    public static function total_usuarios_app()
    {
        return Usuario::where('status', '!=', 2)->count();
    }

    /**
     *
     * @return Regresa el total de usuarios registrados y bloqueados en la aplicación filtrados por empresa
     */
    public static function usuarios_bloqueados_app()
    {
        return Usuario::where('status', 0)->count();
    }

    /**
     *
     * @return Regresa los datos de una de las direcciones del usuario
     */
    public static function direccion_usuario($id)
    {
        DB::setFetchMode(PDO::FETCH_ASSOC);

        return DB::table('usuario_direcciones')->where('id', $id)->first();
    }

    /**
     * Filtra los servicios con sus detalles correspondientes dependiendo de si el servicio está finalizado y del estilista solicitado.
     *
     * @param bool $is_finished, Int $estilista_id
     * @return App\Servicio
     */
    public static function listar_servicios($is_finished, $customer_id_conekta)
    {
        $servicios = Servicio::where('is_finished', $is_finished)
        ->where('customer_id_conekta', $customer_id_conekta)
        ->orderBy('created_at', 'DESC')
        ->get();

        foreach ($servicios as $servicio) {
            $servicio->cantidad_productos = ServicioDetalle::where('servicio_id', $servicio->id)->where('tipo', 'producto')->count();
            $servicio->cantidad_servicios = ServicioDetalle::where('servicio_id', $servicio->id)->where('tipo', 'servicio')->count();
            $servicio->detalles = ServicioDetalle::where('servicio_id', $servicio->id)->get();
        }

        return $servicios;
    }
}
