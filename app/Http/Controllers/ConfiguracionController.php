<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use DB;
use App\Faq;
use App\Ayuda;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;

class ConfiguracionController extends Controller
{
    /**
     * Carga la vista para poder cargar un pdf con el aviso de privacidad y/o poder descargar uno existente.
     *
     * @return \Illuminate\Http\Response
     */
    public function preguntas_frecuentes()
    {
        if (Auth::check()) {
            $preguntas = Faq::preguntas_detalles();
            $categorias = Ayuda::all();
            $title = 'Preguntas frecuentes';
            $menu = 'Configuraciones';
            return view('configuracion.preguntas_frecuentes', ['preguntas' => $preguntas, 'categorias' => $categorias, 'title' => $title, 'menu' => $menu]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Guarda una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_pregunta(Request $request)
    {
        $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('imagen_pregunta')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                ->resize(460, 384)
                ->save($name);
            }
        }

        DB::table('preguntas_frecuentes')->insert(
            ['pregunta' => $request->pregunta, 
             'respuesta' => $request->respuesta,
             'imagen' => $name,
             'ayuda_menu_id' => $request->ayuda_menu_id
            ]
        );
        return back();
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_pregunta(Request $request)
    {
        $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('imagen_pregunta')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                ->resize(460, 384)
                ->save($name);
            }
        }
             
        $actualizar = ['pregunta' => $request->pregunta, 'respuesta' => $request->respuesta, 'ayuda_menu_id' => $request->ayuda_menu_id];
        $name != "img/preguntas/default.jpg" ? $actualizar = ['imagen' => $name] : '';
        DB::table('preguntas_frecuentes')
        ->where('id', $request->id)
        ->update($actualizar);
        return back();
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function eliminar_pregunta(Request $request)
    {
        DB::table('preguntas_frecuentes')
        ->where('id', $request->id)
        ->delete();
        return back();
    }
}
