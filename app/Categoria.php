<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria', 'precio_cortes', 'precio_peinados', 'precio_piojos', 'tiempo_a', 
        'tiempo_minimo_cortes', 'tiempo_maximo_cortes', 'tiempo_minimo_peinados', 'tiempo_maximo_peinados', 
        'tiempo_minimo_piojos', 'tiempo_maximo_piojos', 'created_at'];
}
