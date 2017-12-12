<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel, Input, File;
use DB;
use App\Producto;
use App\Usuario;
use App\TipoProducto;

class ExcelController extends Controller
{   
    /**
     * Importa productos a través de un archivo de excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function importar_productos()
    {
        if (Input::hasFile('archivo-excel')) {

            //DB::setFetchMode(PDO::FETCH_ASSOC);
            $nombres = DB::table('productos')->lists('nombre');//Arreglo que contiene los nombres de los productos existentes      
            $nombre_array = array();//Arreglo que contendrá los códigos de los productos del EXCEL
            $path = Input::file('archivo-excel')->getRealPath();
            $extension = Input::file('archivo-excel')->getClientOriginalExtension();

            if ($extension == 'xlsx' || $extension == 'xls') {
                $data = Excel::load($path, function($reader) {
                    $reader->setDateFormat('Y-m-d');
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        //dd($data);
                        if (in_array($value->nombre, $nombres))
                            continue;

                        if (in_array($value->nombre, $nombre_array))
                            continue;

                        if ($value->nombre == null || $value->nombre == "")
                            continue;

                        $tipo_producto_id = TipoProducto::where('tipo', $value->categoria)->first();

                        $insert[] = [
                            'nombre' => $value->nombre,
                            'precio' => $value->precio,
                            'stock' => $value->stock,
                            'descripcion' => $value->descripcion,
                            'tipo_producto_id' => $tipo_producto_id ? $tipo_producto_id->id : 0,
                            'foto_producto' => 'img/productos/'.$value->foto
                        ];

                        /*Producto::firstOrCreate([
                            'empresa_id' => auth()->user()->empresa_id,
                            'codigo' => $insert['codigo']
                        ], $insert);*/

                        array_push($nombre_array , $value->nombre);
                    }
                    if (!empty($insert)) {
                        DB::table('productos')->insert($insert);
                    }//End insert if
                }//End data count if
            }//End of extension if
        }//End first if
        return back();   
    }

    /**
     * Exporta productos a un archivo de excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportar_productos($fecha_inicio,$fecha_fin)
    {
        $matchThese = array();
        $fecha_inicio != "" && $fecha_inicio != 'false' ? $matchThese['productos.created_at'] = $fecha_inicio : '';
        $fecha_fin != "" && $fecha_fin != 'false' ? $matchThese['created_at'] = $fecha_fin : '';

        $productos = Producto::query()
        ->select(DB::raw("productos.nombre, productos.precio, productos.stock, productos.descripcion, tipo_producto.tipo AS categoria, SUBSTRING_INDEX(foto_producto, '/', -1) AS foto"))
        ->leftJoin('tipo_producto', 'productos.tipo_producto_id', '=', 'tipo_producto.id')
        ->orderBy("nombre")
        ->where(function($q) use ($matchThese) {
            foreach($matchThese as $key => $value) {
                if ($key == "productos.created_at") { $q->where($key, '>=', $value); }
                elseif ($key == "created_at") { $q->where($key, '<=', $value); }
                else { $q->where($key, '=', $value); }
            }
        })
        ->get();

        Excel::create('Productos', function($excel) use($productos) {
            $excel->sheet('Hoja 1', function($sheet) use($productos) {
                $sheet->cells('A:F', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:F1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($productos);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    public function exportar_usuarios_app()
    {
        $productos = Usuario::query()
        ->select(DB::raw("usuario.id, usuario.nombre, usuario.apellido, usuario.correo, usuario.created_at AS fechaRegistro, IF(usuario.status = 0, 'bloqueado', IF(usuario.status = 1, 'activo', IF(usuario.status = 2, 'pendiente', 'Unkonwn status'))) as status"))
        ->where('tipo', 1)
        ->get();

        Excel::create('Usuarios aplicación', function($excel) use($productos) {
            $excel->sheet('Hoja 1', function($sheet) use($productos) {
                $sheet->cells('A:F', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:F1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($productos);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    /**
     * Guarda los registros de códigos postales de un excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function cargar_excel_cp()
    {
        if (Input::hasFile('archivo-excel')) {
            $path = Input::file('archivo-excel')->getRealPath();
            $extension = Input::file('archivo-excel')->getClientOriginalExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                $data = Excel::load($path, function($reader) {
                    $reader->setDateFormat('Y-m-d');
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        if ($value->codigo_postal == null || $value->codigo_postal == "")
                            continue;

                        $insert[] = [
                            'codigo_postal' => $value->codigo_postal,
                            'colonia' => $value->colonia
                        ];
                    }
                    if (!empty($insert)) {
                        DB::table('codigo_postal_colonia')->insert($insert);
                        return ['msg' => 'Upload successful'];
                    }//End insert if
                }//End data count if
            }//End of extension if
        }//End first if
        return ['msg' => 'There is not file to upload'];
    }
}
