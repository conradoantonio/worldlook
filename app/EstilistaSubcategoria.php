<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstilistaSubcategoria extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'estilistas_subcategorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['estilista_id', 'subcategoria_id'];

    /**
     * Indica si el modelo usará campos de timestamp.
     *
     * @var bool
     */
    public $timestamps = false;
}
