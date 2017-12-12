<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaSubcategoria extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'categorias_subcategorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria_id', 'subcategoria_id', 'created_at'];
}
