<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Subcategoria extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'subcategorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria_id', 'subcategoria', 'foto', 'descripcion', 'created_at'];

    /**
     *
     * @return Carga una lista de las subcategorías con los detalles de esta, como el menu y la categoría a la que corresponde.
     */
    public static function subcategoria_detalles()
    {
        $subcategorias = Subcategoria::select(DB::raw('subcategorias.id AS subcategoria_id, subcategorias.foto AS foto_subcategoria, 
            subcategorias.subcategoria, subcategorias.descripcion, categorias.id AS categoria_id, 
            categorias.categoria'))
        ->leftJoin('categorias', 'subcategorias.categoria_id', '=', 'categorias.id')
        ->groupBy('subcategorias.id')
        ->get();

        return $subcategorias;
    }
}
