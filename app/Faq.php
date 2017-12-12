<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Faq extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'preguntas_frecuentes';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['ayuda_menu_id', 'pregunta', 'respuesta', 'imagen'];

    /**
     * Retorna la lista de preguntas junto con su categoría.
     *
     * @var array
     */
    public static function preguntas_detalles()
    {
        return Faq::select(DB::raw('preguntas_frecuentes.*, ayuda_menu.titulo'))
        ->leftJoin('ayuda_menu', 'preguntas_frecuentes.ayuda_menu_id','=', 'ayuda_menu.id')
        ->get();
    }

    /**
     * Retorna la lista de categorías de preguntas, junto con su respectivo arreglo de preguntas pertenecientes.
     *
     * @var array
     */
    public static function faqs_detalles()
    {
        $preguntas_categoria = Ayuda::all();
        foreach ($preguntas_categoria as $faq) {
            $faq->faqs = Faq::where('ayuda_menu_id', $faq->id)->get();
        }
        return $preguntas_categoria;
    }
}
