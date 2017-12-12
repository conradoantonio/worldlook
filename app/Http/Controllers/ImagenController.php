<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use Auth;
use Redirect;
use Input;
use Image;

class ImagenController extends Controller
{
    /**
     * Carga la vista para subir imágenes con dropzone al servidor.
     *
     * @return view imagenes.cargarImagenes
     */
    public function index()
    {
        if (Auth::check()) {
            $title = 'Cargar imágenes';
            $menu = 'Imágenes';
            return view('imagenes.cargarImagenes', ['menu' => $menu, 'title' => $title]);
        } else {
            return redirect::to('/');
        }
    }

    /**
     * Sube las imagenes al servidor.
     *
     * @return ['uploaded'=>true]
     */
    public function subir_imagenes()
    {
        $path = "img/productos/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
        $file = Input::file('file');
        $extension_archivo = $file->getClientOriginalExtension();

        if (array_search($extension_archivo, $extensiones_permitidas)) {
            $name = 'img/productos/'.$file->getClientOriginalName();
            $imagen_producto = Image::make($file)
            ->resize(460, 460)
            ->save($name);
            return ['uploaded'=>true];
        }
        return ['uploaded' => false];
    }

    /**
     * Carga la vista para subir imágenes con dropzone al servidor.
     *
     * @return view imagenes.galeria
     */
    public function cargar_galeria()
    {
        if (Auth::check()) {
            $title = 'Galería';
            $menu = 'Galería';
            $galeria = $this->get_files_directory('./img/productos');
            //dd($galeria);
            return view('imagenes.galeria', ['menu' => $menu, 'title' => $title, 'galeria' => $galeria]);
        } else {
            return redirect::to('/');
        }
    }

    /**
     * Elimina una imagen de un producto.
     *
     * @return view imagenes.galeria
     */
    public function eliminar_galeria(Request $request)
    {
        if ($request->has('foto')) {//Verificamos si existe una imagen que eliminar
            $directorio = public_path().$request->subdirectorio.'/'.$request->foto;
            if (file_exists($directorio)) {//Se revisa si el archivo existe
                if (unlink($directorio)) {//Se verifica que se pueda eliminar el archivo
                    return ['msg'=>'Eliminado'];
                } else {
                    return ['msg'=>'Error eliminando archivo'];
                }
            } else {
                return['msg'=>'No existe el archivo'];
            }
        }
        return ['msg'=>'Sin parámetros'];
    }

    /**
     * Obtiene los archivos de un directorio.
     *
     * @param  string $path
     * @return $galeria
     */
    public function get_files_directory($path)
    {
        $galeria = array();
        $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
        $directorio = opendir($path); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (!is_dir($archivo))//verificamos si es o no un directorio
            {
                $extension = explode(".", $archivo);
                if (array_search(strtolower($extension[1]), $extensiones_permitidas) && $extension[0] != 'default') {
                    $galeria[] = $archivo;
                }
            }
        }
        closedir($directorio);
        return $galeria;
    }
}
