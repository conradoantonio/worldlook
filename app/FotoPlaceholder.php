<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoPlaceholder extends Model
{
	/**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'foto_placeholder';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['titulo', 'descripcion', 'img'];
}
