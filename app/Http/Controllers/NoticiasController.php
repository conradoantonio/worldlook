<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Image;
use App\Noticia;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoticiasController extends Controller
{
    /**
     * Carga la vista para poder cargar las noticias en la aplicación.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            $noticias = Noticia::all();
            $title = $menu = 'Noticias';
            return view('noticias.noticias', ['noticias' => $noticias, 'title' => $title, 'menu' => $menu]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda una noticia.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $req)
    {
        $noticia = New Noticia;

        $noticia->titulo = $req->titulo;
        $noticia->mensaje = $req->mensaje;

        $name = "img/noticias/default.jpg";
        if ($req->file('foto')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension = $req->file('foto')->getClientOriginalExtension();
            if (array_search($extension, $extensiones_permitidas)) {
                $name = 'img/noticias/'.time().'.'.$extension;
                Image::make($req->file('foto'))
                ->resize(748, 337)
                ->save($name);
                $noticia->foto = $name;
            }
        }

        $noticia->save();

        return back();
    }

    /**
     * Edita una noticia.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $req)
    {
        $noticia = Noticia::find($req->id);

        if ($noticia) {
            $noticia->titulo = $req->titulo;
            $noticia->mensaje = $req->mensaje;

            $name = "img/noticias/default.jpg";
            if ($req->file('foto')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
                $extension = $req->file('foto')->getClientOriginalExtension();
                if (array_search($extension, $extensiones_permitidas)) {
                    $name = 'img/noticias/'.time().'.'.$extension;
                    Image::make($req->file('foto'))
                    ->resize(748, 337)
                    ->save($name);
                    $noticia->foto = $name;
                }
            }

            $noticia->save();
        }

        return back();
    }

    /**
     * Elimina una noticia.
     *
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $req)
    {
        $noticia = Noticia::find($req->id);

        if ($noticia) {
            $noticia->delete();
        }

        return back();
    }
}
