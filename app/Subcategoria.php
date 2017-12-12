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
    protected $fillable = ['menu_id', 'categoria_id', 'subcategoria', 'foto', 'descripcion', 'created_at'];

    /**
     *
     * @return Carga una lista de las subcategorías con los detalles de esta, como el menu y la categoría a la que corresponde.
     */
    public static function subcategoria_detalles()
    {
        $subcategorias = Subcategoria::select(DB::raw('subcategorias.id AS subcategoria_id, subcategorias.foto AS foto_subcategoria, 
            menus.id AS menu_id, menus.menu, subcategorias.subcategoria, subcategorias.descripcion, categorias.id AS categoria_id, 
            categorias.categoria'))
        ->leftJoin('categorias', 'subcategorias.categoria_id', '=', 'categorias.id')
        ->leftJoin('menus', 'subcategorias.menu_id', '=', 'menus.id')
        ->groupBy('subcategorias.id')
        ->get();

        return $subcategorias;
    }

    /**
     *
     * @return Carga una lista de las subcategorías con los detalles de esta, como el menu y la categoría a la que corresponde.
     */
    public static function select_categorias($menu_id)
    {
        $subcategorias = MenusCategorias::select(DB::raw('categorias.id, menus_categorias.menu_id, categorias.categoria'))
        ->leftJoin('categorias', 'menus_categorias.categoria_id', '=', 'categorias.id')
        ->where('menus_categorias.menu_id', $menu_id)
        ->get();

        return $subcategorias;
    }

    /*
    SELECT subcategorias.id AS subcategoria_id, menus.id AS menu_id, menus.menu, subcategorias.subcategoria, subcategorias.descripcion, categorias.id AS categorias_id, categorias.categoria 
    FROM subcategorias
    LEFT JOIN categorias
    ON subcategorias.categoria_id = categorias.id
    LEFT JOIN menus
    ON subcategorias.menu_id = menus.id
    GROUP BY subcategorias.id*/

}
