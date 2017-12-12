<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MenusCategorias;
use App\Http\Requests;
use App\Subcategoria;
use App\Categoria;
use App\Menu;
use Image;
use Input;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Muestra una vista con el menú de la aplicación.
     *
     */
    public function index()
    {
        if (auth()->check()) {
            $title = "Menu app";
            $menu = "Menu app";
            $menus = Menu::all();
            foreach ($menus as $m) {
                $m->array_categorias = MenusCategorias::where('menu_id', $m->id)->lists('categoria_id');
            }
            $categorias = Categoria::all();
            return view('categorias.categorias', ['menus' => $menus, 'categorias' => $categorias, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda las categorías permitidas del menú
     *
     */
    public function menus_categorias(Request $req)
    {
        $menu_id = $req->menu_id;

        MenusCategorias::where('menu_id', $menu_id)->delete();
        foreach ($req->array_categorias as $categoria) {
            $menu_categorias = New MenusCategorias;
            $menu_categorias->menu_id = $menu_id;
            $menu_categorias->categoria_id = $categoria;
            $menu_categorias->save();
        }
        return MenusCategorias::where('menu_id', $menu_id)->lists('categoria_id');
    }


    /**
     *====================================================================================================================================================================
     *=                                                  Empiezan las funciones relacionadas al módulo de subcategorías                                                  =
     *====================================================================================================================================================================
     */

    /**
     * Muestra una vista con las subcategorias de la aplicación.
     *
     */
    public function subcategorias()
    {
        if (auth()->check()) {
            $title = "Subcategorías app";
            $menu = "Subcategorías app";
            $menus = Menu::where('menu', '!=', 'Productos')->get();
            $categorias = Categoria::all();
            $subcategorias = Subcategoria::subcategoria_detalles();
            return view('categorias.subcategorias', ['menus' => $menus, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda una subcategoría.
     *
     */
    public function subcategorias_guardar(Request $req)
    {
        date_default_timezone_set('America/Mexico_City');
        
        $subcategoria = new Subcategoria;

        $subcategoria->menu_id = $req->menu_id;
        $subcategoria->categoria_id = $req->categoria_id;
        $subcategoria->subcategoria = $req->nombre_subcategoria;
        $subcategoria->descripcion = $req->descripcion;
        $subcategoria->created_at = date("Y-m-d H:i:s");

        $name = "img/default.jpg";
        if ($req->file('foto_subcategoria')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
            $file = Input::file('foto_subcategoria');
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/subcategorias/'.time().'.'.$extension_archivo;
                $imagen_producto = Image::make($file)
                ->resize(500, 496)
                ->save($name);
                $subcategoria->foto = $name;
            }
        }
   
        $subcategoria->save();

        return redirect()->to('/subcategorias_app');
    }

    /**
     * Edita una subcategoría.
     *
     */
    public function subcategorias_editar(Request $req)
    {
        date_default_timezone_set('America/Mexico_City');
        
        $subcategoria = Subcategoria::find($req->id);

        if ($subcategoria) {
            $subcategoria->menu_id = $req->menu_id;
            $subcategoria->categoria_id = $req->categoria_id;
            $subcategoria->subcategoria = $req->nombre_subcategoria;
            $subcategoria->descripcion = $req->descripcion;

            $name = "img/default.jpg";
            if ($req->file('foto_subcategoria')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
                $file = Input::file('foto_subcategoria');
                $extension_archivo = $file->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/subcategorias/'.time().'.'.$extension_archivo;
                    $imagen_producto = Image::make($file)
                    ->resize(500, 496)
                    ->save($name);
                    $subcategoria->foto = $name;
                }
            }
        }
   
        $subcategoria->save();

        return redirect()->to('/subcategorias_app');
    }

    /**
     * Elimina una subcategoría.
     *
     */
    public function subcategorias_eliminar(Request $req)
    {
        try {
            $producto = Subcategoria::find($req->id);
            $producto->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Elimina múltiples productos a la vez.
     *
     */
    public function subcategorias_eliminar_multiples(Request $req)
    {
        try {
            Subcategoria::whereIn('id', $req->checking)
            ->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }    

    /**
     * Carga las categorías del menú seleccionado por el usuario (select del formulario subcategorías).
     *
     */
    public function cargar_subcategorias(Request $req)
    {
        if (auth()->check()) {
            return Subcategoria::select_categorias($req->menu_id);
        } else {
            return ['msg' => 'You do not have privileges to make this request!'];
        }
    }

    /**
     *====================================================================================================================================================================
     *=                                Empiezan las funciones relacionadas a la edición del precio y tiempos estimados de las categorías.                                =
     *====================================================================================================================================================================
     */

    /**
     * Muestra los detalles de las categorias (precio y tiempos estimados) de la aplicación.
     *
     */
    public function configurar_servicios(Request $req)
    {
        if (auth()->check()) {
            $menu = $title = "Modificar categorías";
            $categorias = Categoria::all();

            if($req->ajax()) {
                return view('categorias.configurar_categorias_tabla', ['categorias' => $categorias]);
            }

            return view('categorias.configurar_categorias', ['categorias' => $categorias, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Edita una categoría el precio y tiempos estimados de una categoría.
     *
     */
    public function editar_config(Request $req)
    {
        $categoria = Categoria::find($req->tipo_producto_id);

        if ($categoria) {
            if ($req->categoria_tipo == 'cortes') {
                $categoria->precio_cortes = $req->precio;
                $categoria->tiempo_minimo_cortes = $req->tiempo_minimo;
                $categoria->tiempo_maximo_cortes = $req->tiempo_maximo;
            } else if ($req->categoria_tipo == 'peinados') {
                $categoria->precio_peinados = $req->precio;
                $categoria->tiempo_minimo_peinados = $req->tiempo_minimo;
                $categoria->tiempo_maximo_peinados = $req->tiempo_maximo;
            } else if ($req->categoria_tipo == 'piojos') {
                $categoria->precio_piojos = $req->precio;
                $categoria->tiempo_minimo_piojos = $req->tiempo_minimo;
                $categoria->tiempo_maximo_piojos = $req->tiempo_maximo;
            }

            $categoria->save();

            return ['msg' => 'success'];
        }
    }
}
