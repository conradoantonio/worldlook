<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Redirect;
use App\Producto;
use App\TipoProducto;
use App\ProductoMedidas;
use Image;
use Input;

class ProductosController extends Controller
{
    /**
     * Carga la tabla de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $title = "Productos";
            $menu = "Productos";
            $tipos = TipoProducto::all();
            $productos = Producto::where('status', 1)->get();
            return view('productos.productos', ['productos' => $productos, 'tipos' => $tipos, 'menu' => $menu, 'title' => $title]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Guarda un producto nuevo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect /productos
     */    
    public function guardar_producto(Request $request)
    {
        $producto = new Producto;
        
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->tipo_producto_id = $request->tipo_producto_id;
        $producto->status = 1;

        $name = "img/productos/default.jpg";
        if ($request->file('foto_producto')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
            $file = Input::file('foto_producto');
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/productos/'.$file->getClientOriginalName();
                $imagen_producto = Image::make($request->file('foto_producto'))
                ->resize(340, 355)
                ->save($name);
                $producto->foto_producto = $name;
            }
        }

        $producto->save();

        return back();
    }

    /**
     * Edita un producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect /productos
     */
    public function editar_producto(Request $request)
    {
        $producto = Producto::find($request->id);
        
        if($producto) {
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->tipo_producto_id = $request->tipo_producto_id;

            $name = "img/productos/default.jpg";
            if ($request->file('foto_producto')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
                $file = Input::file('foto_producto');
                $extension_archivo = $file->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/productos/'.$file->getClientOriginalName();
                    $imagen_producto = Image::make($request->file('foto_producto'))
                    ->resize(340, 355)
                    ->save($name);
                    $producto->foto_producto = $name;
                }
            }   

            $producto->save();
        }
        return back();
    }

    /**
     * Elimina un producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_producto(Request $request)
    {
        try {
            $producto = Producto::find($request->id);
            $producto->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Elimina múltiples productos a la vez.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_multiples_productos(Request $request)
    {
        try {
            DB::table('productos')
            ->whereIn('id', $request->checking)
            ->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Guarda un nuevo tipo de producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\TipoProducto
     */    
    public function guardar_tipo_producto(Request $request)
    {
        $tipo = new TipoProducto;
        
        $tipo->tipo = $request->tipo_producto;

        $name = "img/default.jpg";
        if ($request->file('foto_tipo_producto')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
            $file = Input::file('foto_tipo_producto');
            $extension = $file->getClientOriginalExtension();
            if (array_search($extension, $extensiones_permitidas)) {
                $name = 'img/tipo_productos/'.time().'.'.$extension;
                $imagen = Image::make($request->file('foto_tipo_producto'))
                ->resize(460, 460)
                ->save($name);
                $tipo->foto = $name;
            }
        }

        $tipo->save();

        return TipoProducto::all();
    }

    /**
     * Edita un tipo de producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return App\TipoProducto
     */    
    public function editar_tipo_producto(Request $request)
    {
        $tipo = TipoProducto::find($request->tipo_producto_id);

        if ($tipo) {
            $tipo->tipo = $request->tipo_producto;

            $name = "img/default.jpg";
            if ($request->file('foto_tipo_producto')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
                $file = Input::file('foto_tipo_producto');
                $extension = $file->getClientOriginalExtension();
                if (array_search($extension, $extensiones_permitidas)) {
                    $name = 'img/tipo_productos/'.time().'.'.$extension;
                    $imagen = Image::make($request->file('foto_tipo_producto'))
                    ->resize(460, 460)
                    ->save($name);
                    $tipo->foto = $name;
                }
            }

            $tipo->save();

        }
        return TipoProducto::all();
    }

    /**
     * Elimina un tipo de producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return App\TipoProducto
     */    
    public function eliminar_tipo_producto(Request $request)
    {
        $tipo = TipoProducto::find($request->tipo_producto_id);

        if ($tipo) {
            $tipo->delete();
        }
        return TipoProducto::all();
    }
}
