<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CodigoPostal extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'codigo_postal_colonia';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['codigo', 'tipo_cupon', 'cantidad_servicios', 'cantidad_productos', 
    	'porcentaje_descuento', 'usuario_id', 'fecha_inicio', 'fecha_fin', 'descripcion'
    ];

    /**
     * Regresa 1 si el código postal se encuentra o 0 en caso contrario.
     *
     * @var array
     */
    public static function verificar_cp($cp)
    {
        $codigo_postal = CodigoPostal::where('codigo_postal', $cp)->where('status', 1)->get();
        return count($codigo_postal) ? 1 : 0; 
    }
}
