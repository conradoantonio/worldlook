<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Image;
use Input;
use App\Usuario;
use App\Estilista;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstilistasController extends Controller
{
    /**
     * Muestra la tabla de los estilistas en la aplicación.
     *
     */
    public function index()
    {
        if (auth()->check()) {
            $title = "Estilistas";
            $menu = "Estilistas";
            $estilistas = Estilista::estilistas_usuarios();
            return view('estilistas.estilistas', ['estilistas' => $estilistas, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda un nuevo estilista
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Nada
     */
    public function guardar_estilista(Request $request)
    {
        if(count(Usuario::buscar_usuario_por_correo($request->correo))) {
            return redirect()->action('EstilistasController@index', ['valido' => md5('false')]);
        }

        date_default_timezone_set('America/Mexico_City');//Esto fue puesto para obtener corectamente la hora en local.
        $date = date("Y-m-d H:i:s");

        /*Se crea el usuario del estilista*/
        $usuario = new Usuario;

        $usuario->password = md5($request->password);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo = $request->correo;
        $usuario->foto_perfil = 'img/default.jpg';
        $usuario->tipo = 2;//Tipo estilista
        $usuario->created_at = $date;

        $usuario->save();
        
        /* Se crea el perfil del estilista */
        $estilista = new Estilista;
        $estilista->usuario_id = $usuario->id;
        $estilista->nombre = $request->nombre;
        $estilista->apellido = $request->apellido;
        $estilista->descripcion = $request->descripcion;
        $estilista->status = 1;
        $estilista->created_at = $date;

        $name = "img/estilistas/default.jpg";
        if ($request->file('foto_estilista')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
            $file = Input::file('foto_estilista');
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/estilistas/'.time().'.'.$extension_archivo;
                $imagen_producto = Image::make($request->file('foto_estilista'))
                ->resize(460, 460)
                ->save($name);
                $estilista->imagen = $name;
            }
        }
   
        $estilista->save();

        return redirect()->to('/estilistas');
    }

    /**
     * Edita los valores de un estilista
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Nada
     */
    public function editar_estilista(Request $request)
    {
        $usuario = Usuario::find($request->usuario_id);

        $request->password ? $usuario->password = md5($request->password) : '';
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo = $request->correo;

        $usuario->save();

        $estilista = Estilista::find($request->id);
        if ($estilista) {
            $estilista->nombre = $request->nombre;
            $estilista->apellido = $request->apellido;
            $estilista->descripcion = $request->descripcion;

            $name = "img/estilistas/default.jpg";
            if ($request->file('foto_estilista')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
                $file = Input::file('foto_estilista');
                $extension_archivo = $file->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/estilistas/'.time().'.'.$extension_archivo;
                    $imagen_producto = Image::make($request->file('foto_estilista'))
                    ->resize(460, 460)
                    ->save($name);
                    $estilista->imagen = $name;
                }
            }

            $estilista->save();
        }
        return redirect()->to('/estilistas');
    }

    /**
     * Cambia el status de un estilista.
     *
     * @param  Request $request
     * @return Nada
     */
    public function cambiar_status(Request $request)
    {
        if ($request->status == 0) {//Significa que el usuario se va a borrar
            Estilista::where('id', $request->id)
            ->delete();
        } else {
            Estilista::where('id', $request->id)
            ->update(['status' => $request->status]);
        }
    }

    /**
     * Cargar estilistas disponibles select.
     *
     * @param  Request $request
     * @return $estilistas
     */
    public function cargar_estilistas_disponibles_select(Request $request)
    {
        if ($request->status == 0) {//Significa que el usuario se va a borrar
            Estilista::where('id', $request->id)
            ->delete();
        } else {
            Estilista::where('id', $request->id)
            ->update(['status' => $request->status]);
        }
    }
}
