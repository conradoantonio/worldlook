<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenusCategorias extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'menus_categorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'categoria_id', 'created_at'];

    static function menu_categoria() 
    {
    	return MenusCategorias::select(DB::raw('menus_categorias.menu_id, menus.menu, menus_categorias.categoria_id, categorias.categoria'))
    	->leftJoin('menus', 'menus_categorias.menu_id', '=', 'menus.id')
    	->leftJoin('categorias', 'menus_categorias.categoria_id', '=', 'categorias.id')
		->get();
    }
}
