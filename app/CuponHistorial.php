<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CuponHistorial extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'cupones_historial';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['cupon_id', 'user_id', 'created_at'];

    /**
     * Regresa una colección de cupones dependiendo de su tipo.
     *
     * @var array
     */
    public static function cupones_usados_usuario($usuario_id)
    {
        return CuponHistorial::where('user_id', $usuario_id)->lists('cupon_id');
    }
}
