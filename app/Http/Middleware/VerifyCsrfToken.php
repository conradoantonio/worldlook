<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/cargar/quienes_somos',//Se puso aquí porque daba error al subir archivos de más de 6 mb.
        //Principio de los de conekta prueba
        '/post_send',
        '/cargar/codigo_postal',
        '/crear_cliente',
        '/api/v1/validar_cargo',
        '/api/v1/validar_cargo_oxxo',
        '/procesar_orden',
        '/api/v1/orden_empresa',
/*        '/pedidos/obtener_info_pedido',*/
        //Fin de los de conekta prueba
        '/productos/cargar_subcategorias',
        '/subir_imagenes',
        '/api/v1/registro_usuario',
        '/api/v1/login/cliente',
        '/api/v1/login/estilista',
        '/api/v1/usuario/cargar_imagen',
        '/api/v1/actualizar_usuario',
        '/api/v1/recuperar_contra',
        '/api/v1/actualizar_foto',
        '/api/v1/agregar_direccion',
        '/api/v1/actualizar_direccion',
        '/api/v1/eliminar_direccion',
        '/api/v1/listar_direcciones',
        '/api/v1/quienes_somos',
        '/api/v1/info_empresas',
        '/api/v1/preguntas_frecuentes',
        '/api/v1/verificar_codigo_postal',
        '/api/v1/obtener_pedidos_usuario',
        '/api/v1/info_empresas/costo_envios',
        '/api/v1/generar_cotizacion',
        '/api/v1/obtener_cotizaciones_usuario',
        '/api/v1/enviar_correo_detalle_orden',
        '/api/v1/enviar_correo_detalle_cotizacion',
        '/api/v1/calificar_servicio',
        '/api/v1/actualizar_contra',
        '/api/v1/actualizar_player_id',
    ];
}
