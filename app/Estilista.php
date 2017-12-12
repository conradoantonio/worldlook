<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Estilista extends Model
{
	/**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'estilistas';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['estilista_id', 'nombre', 'apellido', 'descripcion', 'imagen', 'status'];

    /**
     * Obtiene la los estilistas con su respectivo usuario del sistema.
     */
    public static function estilistas_usuarios()
    {
        return Estilista::select(DB::raw('estilistas.*, usuario.correo'))
        ->leftJoin('usuario', 'estilistas.usuario_id', '=', 'usuario.id')
        ->get();
    }

    /**
     * Obtiene la categoría a la que pertenece una denuncia.
     *
     * @param timestamp $start_datetime, $end_datetime
     */
    public static function cargar_estilistas_disponibles($start_datetime, $end_datetime)
    {
        $servicios = Servicio::where('start_datetime', '>=',DB::raw('DATE_SUB( "'.$start_datetime.'", INTERVAL 1 HOUR )'))
        ->where('end_datetime', '<=',DB::raw('DATE_ADD( "'.$end_datetime.'", INTERVAL 1 HOUR )'))
        ->where('status', 'paid');

        /*if ($estilista_id) {
            $servicios = $servicios->where('estilista_id', '!=', $estilista_id);
        }
        */
        $servicios = $servicios->lists('estilista_id');

        return $servicios;
    }

    /**
     * Filtra los estilistas que no están disponibles en el horario pedido del método cargar_estilistas_disponibles.
     *
     * @return App\Estilista
     */
    public static function filtrar_estilistas($status, $ids, $estilista_id = false)
    {
        $estilistas = Estilista::where('status', $status)
        ->whereNotIn('id', $ids);

        if ($estilista_id) {
            $estilistas = $estilistas->where('id', '!=', $estilista_id);
        }
        
        return $estilistas->get();
    }

    /**
     * Filtra los servicios con sus detalles correspondientes dependiendo de si el servicio está finalizado y del estilista solicitado.
     *
     * @param bool $is_finished, Int $estilista_id
     * @return App\Servicio
     */
    public static function listar_servicios($is_finished, $estilista_id)
    {
        $servicios = Servicio::where('is_finished', $is_finished)
        ->where('estilista_id', $estilista_id)
        ->orderBy('created_at', 'DESC')
        ->get();

        foreach ($servicios as $servicio) {
            $servicio->detalles = ServicioDetalle::where('servicio_id', $servicio->id)->get();
        }

        return $servicios;
    }
}
