<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Image;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Valida que los archivos sean imagenes.
     *
     * @return json($msg)
     */
    public function validar_archivo($file, $path, $resize = false)
    {
        $extensiones = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");

        if ($file) {
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones)) {
            	$name = $path.'/'.time().'.'.$extension_archivo;
                $archivo = Image::make($file);

                $resize ? $archivo = $archivo->resize($resize['width'], $resize['height']) : '';
                
                $archivo->save($name);

                return $name;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
