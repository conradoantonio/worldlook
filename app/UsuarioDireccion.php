<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioDireccion extends Model
{
	/**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'usuario_direcciones';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['usuario_id', 'recibidor', 'calle', 'entre', 'num_ext', 'num_int', 'estado', 'ciudad', 'pais', 'codigo_postal'];
}
