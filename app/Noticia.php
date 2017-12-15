<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Noticia extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'noticias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'mensaje', 'foto'];
}
