<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'tipo_producto';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['tipo', 'foto', 'created_at'];
}
