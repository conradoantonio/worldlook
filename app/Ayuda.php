<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'ayuda_menu';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['titulo'];
}
