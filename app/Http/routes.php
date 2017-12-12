<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if (Auth::check()) {
		return redirect()->action('LogController@index');
	} else {
    	return view('welcome');//login
    }
});

/*-- Rutas para el login --*/
Route::resource('log', 'LogController');
Route::post('login', 'LogController@store');
Route::get('logout', 'LogController@logout');

/*-- Rutas para el dashboard --*/
Route::get('/dashboard','LogController@index');//Carga solo el panel administrativo
Route::post('/grafica', 'LogController@get_userSesions');//Carga los datos de la gráfica

/*-- Rutas para la pestaña de usuariosSistema --*/
Route::get('/usuarios/sistema','UsersController@index');//Carga la tabla de usuarios del sistema
Route::post('/usuarios/sistema/validar_usuario', 'UsersController@validar_usuario');//Checa si un usuario del sistema existe
Route::post('/usuarios/sistema/guardar_usuario', 'UsersController@guardar_usuario');//Guarda un usuario del sistema
Route::post('/usuarios/sistema/guardar_foto_usuario_sistema', 'UsersController@guardar_foto_usuario_sistema');//Guarda la foto de perfil de un usuario del sistema
Route::post('/usuarios/sistema/eliminar_usuario', 'UsersController@eliminar_usuario');//Elimina un usuario del sistema
Route::post('/usuarios/sistema/change_password', 'UsersController@change_password');//Elimina un usuario del sistema

/*-- Rutas para la pestaña usuariosApp--*/
Route::get('/usuarios/app','UsersController@usuariosApp');//Carga la tabla de usuarios de la aplicación
Route::get('/usuarios/app/exportar_usuarios_app','ExcelController@exportar_usuarios_app');//Exporta todos los usuarios de la aplicación a excel
Route::post('/usuarios/app/guardar_usuario_app', 'UsersController@guardar_usuario_app');//Guarda un nuevo usuario de la aplicación
Route::post('/usuarios/app/editar_usuario_app', 'UsersController@editar_usuario_app');//Edita un usuario de la aplicación
Route::post('/usuario/cambiarStatus', 'UsersController@destroy');//Da de baja un usuario

/*-- Ruta para la pestaña de productos --*/
Route::get('/productos','ProductosController@index');//Carga la tabla de productos del sistema
Route::post('/productos/guardar', 'ProductosController@guardar_producto');//Guarda un producto
Route::post('/productos/editar', 'ProductosController@editar_producto');//Edita un producto
Route::post('/productos/eliminar', 'ProductosController@eliminar_producto');//Elimina un producto
Route::post('/productos/eliminar_multiples', 'ProductosController@eliminar_multiples_productos');//Elimina varios productos
Route::post('/productos/importar_productos', ['as' => '/productos/importar_productos', 'uses' => 'ExcelController@importar_productos']);//Carga los productos a excel
Route::get('/productos/exportar_productos/{fecha_inicio}/{fecha_fin}', 'ExcelController@exportar_productos');//Exporta ciertos productos a excel
Route::post('/productos/cargar_subcategorias', 'ProductosController@cargar_subcategorias');//Carga las subcategorías de una categoría.

/*-- Ruta para los tipos de productos dentro de la pestaña de productos*/
Route::post('/tipo_producto/guardar_tipo_producto', 'ProductosController@guardar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/editar_tipo_producto', 'ProductosController@editar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/eliminar_tipo_producto', 'ProductosController@eliminar_tipo_producto');//Guarda un tipo de producto.

/*-- Rutas para la pestaña de configuración --*/
Route::get('/configuracion/preguntas_frecuentes','ConfiguracionController@preguntas_frecuentes');//Carga la tabla de preguntas frecuentes.
Route::post('/preguntas_frecuentes/guardar_pregunta', 'ConfiguracionController@guardar_pregunta');//Guarda una pregunta
Route::post('/preguntas_frecuentes/editar_pregunta', 'ConfiguracionController@editar_pregunta');//Edita una pregunta
Route::post('/preguntas_frecuentes/eliminar_pregunta', 'ConfiguracionController@eliminar_pregunta');//Elimina una pregunta

/*-- Rutas para la pestaña de estilistas --*/
Route::get('/estilistas','EstilistasController@index');//Carga la tabla de estilistas.
Route::post('/estilistas/guardar_estilista', 'EstilistasController@guardar_estilista');//Guarda un estilista
Route::post('/estilistas/editar_estilista', 'EstilistasController@editar_estilista');//Edita un estilista
Route::post('/estilistas/cambiar_status_estilista', 'EstilistasController@cambiar_status');//Cambia el status de un estilista o lo elimina según sea el caso

/*-- Rutas para la pestaña de estilistas --*/
Route::get('/menu_app','MenuController@index');//Muestra las pestañas del menú principal de la aplicación.
Route::post('/menu_app/menus_categorias','MenuController@menus_categorias');//Muestra las categorías de un menú.
Route::post('/menu_app/categorias/cargar_subcategorias','MenuController@cargar_subcategorias');//Muestra las categorías de un menú.
Route::get('/categorias/{categoria_id}/subcategorias','MenuController@subcategorias_1');//Muestra las subcategorias dada una categoria.

/*-- Rutas para la pestaña de subcategorías --*/
Route::get('/subcategorias_app','MenuController@subcategorias');//Muestra las subcategorías de la aplicación.
Route::post('/subcategorias_app/guardar','MenuController@subcategorias_guardar');//Guarda una subcategoría.
Route::post('/subcategorias_app/editar','MenuController@subcategorias_editar');//Edita una subcategoría.
Route::post('/subcategorias_app/eliminar','MenuController@subcategorias_eliminar');//Elimina una subcategoría.
Route::post('/subcategorias_app/eliminar_multiples','MenuController@subcategorias_eliminar_multiples');//Elimina varias subcategorías.

/*-- Rutas para la pestaña de configuración servicios --*/
Route::get('/configurarcion_servicios','MenuController@configurar_servicios');//Muestra los detalles de las categorias (precio y tiempos estimados) de la aplicación.
Route::post('/configurarcion_servicios/editar_config','MenuController@editar_config');//Edita una categoría.

/*-- Rutas para la pestaña de cupones --*/
/*-- Cupones generales --*/
Route::get('/cupones/generales','CuponesController@cupones_generales');//Carga la vista que contiene los cupones generales.
Route::post('/cupones/generales/guardar','CuponesController@guardar_cupon_general');//Guarda un cupón general.
Route::post('/cupones/generales/editar','CuponesController@editar_cupon_general');//Edita un cupón general.

/*-- Cupones individuales --*/
Route::get('/cupones/individuales','CuponesController@cupones_individuales');//Carga la vista que contiene los cupones individuales.
Route::post('/cupones/individuales/guardar','CuponesController@guardar_cupon_individual');//Guarda un cupón individual.
Route::post('/cupones/individuales/editar','CuponesController@editar_cupon_individual');//Guarda un cupón individual.

/*-- Rutas para eliminar tanto cupones generales como individuales --*/
Route::post('/cupones/eliminar','CuponesController@eliminar_cupon');//Elimina un cupón.
Route::post('/cupones/eliminar_multiples','CuponesController@eliminar_multiples_cupones');//Elimina multiples cupones.

/*-- Rutas para la pestaña de pedidos --*/
Route::get('/pedidos','ServiciosController@index');//Carga la vista para los pedidos realizados del panel
Route::post('/pedidos/agregar_num_seguimiento','ServiciosController@agregar_num_seguimiento');//Agrega un número de seguimiento a un pedido
Route::post('/pedidos/obtener_info_pedido','ServiciosController@obtener_pedido_por_id');//Obtiene la información de un pedido por su id.
Route::post('/pedidos/cargar_estilistas_disponibles','ServiciosController@cargar_estilistas_disponibles');//Muestra los estilistas disponibles dentro de un rango de fechas.
Route::post('/pedidos/asignar_estilista','ServiciosController@asignar_estilista');//Actualiza el número de seguimiento (numero de guía) de un pedido.

/*-- Ruta para iframe --*/
Route::get('/notificaciones_app','ionicController@index');//Carga el login de ionic

/*-- Ruta para cargar codigo postales desde excel --*/
Route::post('/cargar/codigo_postal','ExcelController@cargar_excel_cp');//Carga un excel con los códigos postales de jalisco

/*-- Rutas para la pestaña cargar imagenes --*/
Route::get('/cargar_imagenes','ImagenController@index');//Carga el formulario de dropzone para cargar imagenes
Route::post('/subir_imagenes','ImagenController@subir_imagenes');//Carga las imágenes al servidor

/*-- Rutas para la pestaña de galería --*/
Route::get('/galeria','ImagenController@cargar_galeria');//Carga el login de ionic
Route::post('/galeria/eliminar', 'ImagenController@eliminar_galeria');//Da de baja un usuario

/*-- google analytics --*/
Route::get('/data','estadosController@analytics');//Devuelve los datos de google analytics

/**
 *===========================================================================================================================================================
 *=                                             Empiezan las funciones relacionadas a la api para la aplicación                                             =
 *===========================================================================================================================================================
 */
Route::get('/form','dataAppController@cargar_form_conekta');//Carga el formulario de prueba de conekta

Route::post('/generar_token','dataAppController@generar_token');//Genera un token de prueba
Route::post('/post_send','dataAppController@post_send');//Procesa los datos después de generar el token
Route::get('/app/cupones_validos_usuario/{usuario_id}','dataAppController@cupones_validos_usuario');//Regresa todos los cupones válidos del usuario incluyendo los generales.
Route::post('app/validar_cargo','dataAppController@crear_cliente');//Crea un cliente
//Route::post('/crear_cliente','dataAppController@crear_cliente');//Crea un cliente
Route::post('/procesar_orden','dataAppController@procesar_orden');//Procesa una orden
Route::post('/app/orden_empresa','dataAppController@obtener_ordenes');//Obtiene las pedidos de las empresas

Route::post('/app/registro_usuario','dataAppController@registro_app');//Registra un usuario en la aplicación.
Route::post('/app/login','dataAppController@login_app');//Valida el inicio de sesión de un usuario en la aplicación.
Route::post('/app/actualizar_usuario','dataAppController@actualizar_datos_usuario');//Actualiza los datos del usuario a excepción de la contraseña, email y foto.
Route::post('/app/actualizar_contra','dataAppController@actualizar_password_usuario');//Actualiza los datos del usuario a excepción de la contraseña, email y foto.
Route::post('/app/recuperar_contra','dataAppController@recuperar_contra');//Envía una contraseña nueva generada automáticamente al correo del usuario.
Route::post('/app/actualizar_foto','dataAppController@actualizar_foto');//Actualiza la foto de perfil de un usuario.
Route::post('/app/agregar_direccion','dataAppController@agregar_direccion_usuario_app');//Agrega una dirección para el usuario.
Route::post('/app/actualizar_direccion','dataAppController@actualizar_direccion_usuario_app');//Actualiza una dirección del usuario.
Route::post('/app/listar_direcciones','dataAppController@listar_direcciones');//Muestra una lista de todas las direcciones del usuario de la aplicación.
Route::post('/app/eliminar_direccion','dataAppController@eliminar_direccion_usuario_app');//Elimina una dirección del usuario de la aplicación.
Route::post('/app/calificar_servicio','dataAppController@calificar_servicio');//Califica un servicio y lo marca como terminado.
Route::get('/app/productos_categoria','dataAppController@productos_categoria');//Regresa todos los productos enlistados por categorias.
Route::get('/app/estilistas','dataAppController@listar_estilistas');//Regresa todos los estilistas disponibles.
Route::get('/app/estilistas/servicios/{estilista_id}','dataAppController@listar_servicios_estilistas');//Regresa todos los servicios que tiene un estilista dividiéndolos entre pendientes y finalizados.
Route::get('/app/usuarios/servicios/{usuario_id}','dataAppController@listar_servicios_usuario');//Regresa todos los servicios que tiene un usuario dividiéndolos entre pendientes y finalizados.
Route::get('/app/servicios_por_calificar_cliente/{cliente_id}','dataAppController@servicios_sin_calificar_cliente');//Regresa todos los servicios pendientes por calificar que tiene un cliente.
Route::post('/app/info_empresas','dataAppController@info_empresas');//Muestra la información de las empresas de la plataforma.
Route::post('/app/info_empresas/costo_envios','dataAppController@informacion_envio');//Muestra la información de envío de las empresas.
Route::get('/app/preguntas_frecuentes','dataAppController@obtener_preguntas_frecuentes');//Regresa todas las preguntas frecuentes de la aplicación.
Route::get('/app/listar_colonias','dataAppController@listar_colonias');//Regresa las colonias en donde hay servicio.
Route::post('/app/verificar_codigo_postal','dataAppController@verificar_codigo_postal');//Regresa todas las preguntas frecuentes de la aplicación.
Route::post('/app/obtener_pedidos_usuario','dataAppController@obtener_pedidos_usuario');//Devuelve los pedidos del usuario hechas desde la aplicación.
Route::post('/app/enviar_correo_detalle_orden','dataAppController@enviar_correo_detalle_orden');//Envía un correo electrónico con los detalles de la orden.
Route::post('/app/enviar_correo_detalle_cotizacion','dataAppController@enviar_correo_detalle_cotizacion');//Envía un correo electrónico con los detalles de la cotización.
Route::get('/app/menu_detalles','dataAppController@categorias');//Envía un correo electrónico con los detalles de la cotización.
