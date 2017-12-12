<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cupon;
use App\Usuario;

class CuponesController extends Controller
{
    /**
     *=================================================================================================================================
     *=                                  Empiezan las funciones relacionadas a los cupones generales                                  =
     *=================================================================================================================================
     */
    /**
     * Muestra la lista de los cupones generales
     *
     * @return \Illuminate\Http\Response
     */
    public function cupones_generales()
    {
        if (auth()->check()) {
            $title = "Cupones Generales";
            $menu = "Cupones";
            $cupones = Cupon::cargar_cupon_tipo('general');
            return view('cupones.generales', ['cupones' => $cupones, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda un nuevo cupón general validando que el código no se haya generado anteriormente.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_cupon_general(Request $req)
    {
        $codigo = strtoupper(str_random(8));
        $existe_codigo = Cupon::where('codigo', $codigo)->get();
        while (count($existe_codigo)) {
            $codigo = strtoupper(str_random(8));
            $existe_codigo = Cupon::where('codigo', $codigo)->get();
        }

        $cupon = New Cupon;
        $cupon->codigo = $codigo;
        $cupon->tipo_cupon = 'general';
        $cupon->porcentaje_descuento = $req->porcentaje;
        $cupon->fecha_inicio = $req->fecha_inicio;
        $cupon->fecha_fin = $req->fecha_final;
        $cupon->descripcion = $req->descripcion;
        $cupon->save();

        return back();
    }

    /**
     * Edita un cupón general existente.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_cupon_general(Request $req)
    {
        $cupon = Cupon::find($req->id);

        if ($cupon) {
            $cupon->porcentaje_descuento = $req->porcentaje;
            $cupon->fecha_inicio = $req->fecha_inicio;
            $cupon->fecha_fin = $req->fecha_final;
            $cupon->descripcion = $req->descripcion;
            $cupon->save();
        }
        return back();
    }

    /**
     * Elimina un cupón general.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_cupon(Request $request)
    {
        try {
            $producto = Cupon::find($request->id);
            $producto->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Elimina múltiples cupones generales a la vez.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_multiples_cupones(Request $request)
    {
        try {
            Cupon::whereIn('id', $request->checking)
            ->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     *================================================================================================================================
     *=                                Empiezan las funciones relacionadas a los cupones individuales                                =
     *================================================================================================================================
     */
    /**
     * Muestra la lista de los cupones individuales
     *
     * @return \Illuminate\Http\Response
     */
    public function cupones_individuales()
    {
        if (auth()->check()) {
            $title = "Cupones Individuales";
            $menu = "Cupones";
            $usuarios = Usuario::where('status', 1)->where('tipo', 1)->get();
            $cupones = Cupon::cargar_cupon_tipo('individual');
            return view('cupones.individuales', ['cupones' => $cupones, 'usuarios' => $usuarios, 'menu' => $menu , 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda un nuevo cupón individual validando que el código no se haya generado anteriormente.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_cupon_individual(Request $req)
    {
        $codigo = strtoupper(str_random(8));
        $existe_codigo = Cupon::where('codigo', $codigo)->get();
        while (count($existe_codigo)) {
            $codigo = strtoupper(str_random(8));
            $existe_codigo = Cupon::where('codigo', $codigo)->get();
        }

        $cupon = New Cupon;
        $cupon->codigo = $codigo;
        $cupon->tipo_cupon = 'individual';
        $req->cantidad_servicios ? $cupon->cantidad_servicios = $req->cantidad_servicios : '';
        $req->cantidad_productos ? $cupon->cantidad_productos = $req->cantidad_productos : '';
        $cupon->porcentaje_descuento = $req->porcentaje;
        $cupon->usuario_id = $req->usuario_id;
        $cupon->fecha_inicio = $req->fecha_inicio;
        $cupon->fecha_fin = $req->fecha_final;
        $cupon->descripcion = $req->descripcion;
        $cupon->save();

        return back();
    }

    /**
     * Edita un cupón general existente.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_cupon_individual(Request $req)
    {
        $cupon = Cupon::find($req->id);

        if ($cupon) {
            if ($req->cantidad_servicios) {
                $cupon->cantidad_servicios = $req->cantidad_servicios; 
                $cupon->cantidad_productos = 0;
            } 
            else if ($req->cantidad_productos) {
                $cupon->cantidad_productos = $req->cantidad_productos; 
                $cupon->cantidad_servicios = 0;
            }
            $cupon->porcentaje_descuento = $req->porcentaje;
            $cupon->usuario_id = $req->usuario_id;
            $cupon->fecha_fin = $req->fecha_final;
            $cupon->descripcion = $req->descripcion;
            $cupon->save();
        }
        return back();
    }
}
