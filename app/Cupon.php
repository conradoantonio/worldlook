<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cupon extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'cupones';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['codigo', 'tipo_cupon', 'cantidad_servicios', 'cantidad_productos', 
    	'porcentaje_descuento', 'usuario_id', 'fecha_inicio', 'fecha_fin', 'descripcion'
    ];

    /**
     * Regresa una colección de cupones dependiendo de su tipo.
     *
     * @var array
     */
    public static function cargar_cupon_tipo($tipo)
    {
        //$fecha = date('Y-m-d');
        $cupones = Cupon::select(DB::raw('cupones.*, IF(fecha_fin >= CURDATE(), IF(fecha_inicio > CURDATE(), "Inactivo", "Activo"), "Expirado") AS status_cupon, usuario.nombre, usuario.apellido'))
        ->leftJoin('usuario', 'cupones.usuario_id', '=', 'usuario.id')
        //->whereRaw('? BETWEEN fecha_inicio AND fecha_fin', [$fecha])
        ->where('tipo_cupon', '=', $tipo)
        ->get();

        return $cupones;
    }

    /**
     * Regresa una colección de cupones dependiendo de su tipo.
     *
     * @var array
     */
    public static function cupones_validos_usuario($usuario_id)
    {
        $ids_cupones_usados = CuponHistorial::cupones_usados_usuario($usuario_id);

        #return $ids_cupones_usados;

        $cupones = Cupon::select(DB::raw('cupones.*, IF(fecha_fin >= CURDATE(), IF(fecha_inicio > CURDATE(), "Inactivo", "Activo"), "Expirado") AS status_cupon'))
        ->leftJoin('usuario', 'cupones.usuario_id', '=', 'usuario.id')
        ->whereRaw('CURDATE() BETWEEN fecha_inicio AND fecha_fin AND (usuario_id = ? OR ISNULL(usuario_id))', [$usuario_id])
        ->whereNotIn('cupones.id', $ids_cupones_usados)
        ->get();

        return $cupones;
    }

    /**
     * Regresa una colección de cupones dependiendo de su tipo.
     *
     * @var array
     */
    public static function validar_cupon($cupon_id, $usuario_id)
    {
        $ids_cupones_usados = CuponHistorial::cupones_usados_usuario($usuario_id);

        #return $ids_cupones_usados;

        $cupon = Cupon::select(DB::raw('cupones.*, IF(fecha_fin >= CURDATE(), IF(fecha_inicio > CURDATE(), "Inactivo", "Activo"), "Expirado") AS status_cupon'))
        ->leftJoin('usuario', 'cupones.usuario_id', '=', 'usuario.id')
        ->whereRaw('CURDATE() BETWEEN fecha_inicio AND fecha_fin AND (usuario_id = ? OR ISNULL(usuario_id))', [$usuario_id])
        ->whereNotIn('cupones.id', $ids_cupones_usados)
        ->where('cupones.id', $cupon_id)
        ->first();

        return $cupon;
    }
}
