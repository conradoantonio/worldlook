@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_tipo_categoria" id="categoria_dialogo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_tipo_categoria">Categorías</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="tab-01">
                                <li class="active"><a href="#tabTablaCategoria">Tabla categorias</a></li>
                                <li><a href="#tabNuevaCategoria">Nueva categoría</a></li>
                            </ul>
                            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabTablaCategoria">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" id="nueva_categoria"><i class="fa fa-plus" aria-hidden="true"></i> Nueva categoría</button>
                                            <h3>Tabla de categorías disponibles: </h3>
                                            <div class="table-responsive">
                                                <table class="table" id="categoria">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Categoria producto</th>
                                                            <th class="hide">Foto</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($tipos) > 0)
                                                            @foreach($tipos as $tipo)
                                                                <tr class="" id="{{$tipo->id}}">
                                                                    <td>{{$tipo->id}}</td>
                                                                    <td>{{$tipo->tipo}}</td>
                                                                    <td class="hide">{{$tipo->foto}}</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-info editar_categoria">Editar</button>
                                                                        <button type="button" class="btn btn-danger eliminar_categoria">Borrar</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabNuevaCategoria">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form enctype="multipart/form-data" action="" method="POST" onsubmit="return false;" autocomplete="off" id="form_tipos">
                                                <div class="row">
                                                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                                                    <div class="col-sm-6 col-xs-12 hidden">
                                                        <div class="form-group">
                                                            <label for="id">ID</label>
                                                            <input type="text" class="form-control" id="tipo_producto_id" name="tipo_producto_id">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="alert alert-info alert-dismissible text-left" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                                            <strong>Nota: </strong>
                                                            Solo se permiten subir imágenes con formato jpg, png y jpeg con un tamaño menor a 5mb. 
                                                            Procure que su resolución sea de 340x355 px o su equivalente a escala.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tipo_producto">Categoría</label>
                                                            <input type="text" class="form-control" id="tipo_producto" name="tipo_producto" placeholder="Categoría">
                                                        </div>
                                                    </div>
                                                    <div id="input_foto_producto" class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="foto_tipo_producto">Foto</label>
                                                            <input type="file" class="form-control" id="foto_tipo_producto" name="foto_tipo_producto">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="foto_tipo">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Foto actual</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="guardar_categoria">Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_producto" id="formulario_producto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_producto">Nuevo producto</h4>
                </div>
                <form id="form_producto" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="Stock">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="tipo_producto_id">Categoría</label>
                                    <select class="form-control" id="tipo_producto_id" name="tipo_producto_id">
                                        <option value="0">Seleccione una opción</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-dismissible text-left" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Nota: </strong>
                                    Solo se permiten subir imágenes con formato jpg, png, jpeg y gif con un tamaño menor a 5mb. 
                                    Procure que su resolución sea de 340x355 px o su equivalente a escala.
                                </div>
                            </div>
                            <div id="input_foto_producto" class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="foto_producto">Foto producto</label>
                                    <input type="file" class="form-control" id="foto_producto" name="foto_producto">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="foto_producto">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_producto">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de productos</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="importar-excel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Importar desde Excel</h4>
                </div>
                <form method="POST" action="<?php echo url();?>/productos/importar_productos" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-justify">Para importar productos a través de Excel, los datos deben estar acomodados como se describe a continuación: <br>
                                Los campos de la primera fila de la hoja de excel deben de ir los campos llamados 
                                <strong>nombre, descripcion, precio, stock, categoria, foto</strong><br>
                                Finalmente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de los productos.
                                <br><strong>Nota: </strong>Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd> y 
                                los productos repetidos en el excel no serán creados.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="file" id="archivo-excel" name="archivo-excel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="enviar-excel">Importar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        @if(count($productos) > 0)
                            <button type="button" class="btn btn-info" id="exportar_productos_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar productos</button>
                            <button type="button" class="btn btn-danger" id="eliminar_multiples_productos"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar productos</button>
                        @endif
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importar-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar productos</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto</button>
                        <button type="button" class="btn btn-default" {{-- data-toggle="modal" data-target="#categoria_dialogo" --}} id="categorias_crud"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Categorías</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table" id="example3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th class="hide">Descripción</th>
                                        <th class="hide">Tipo_id</th>
                                        <th class="hide">Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($productos) > 0)
                                        @foreach($productos as $producto)
                                            <tr class="" id="{{$producto->id}}">
                                                <td class="small-cell v-align-middle">
                                                    <div class="checkbox check-success">
                                                        <input id="checkbox{{$producto->id}}" type="checkbox" class="checkDelete" value="1">
                                                        <label for="checkbox{{$producto->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>{{$producto->id}}</td>
                                                <td>{{$producto->nombre}}</td>
                                                <td>{{$producto->precio}}</td>
                                                <td><?php echo $producto->stock == '0' ? '<span class="label label-important">'.$producto->stock.'</span>' : '<span class="label label-info">'.$producto->stock.'</span>';?></td>
                                                <td class="hide">{{$producto->descripcion}}</td>
                                                <td class="hide">{{$producto->tipo_producto_id}}</td>
                                                <td class="hide">{{$producto->foto_producto}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info editar_producto">Editar</button>
                                                    <button type="button" class="btn btn-danger eliminar_producto">Borrar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/productosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesProductos.js') }}"></script>
<script src="{{ asset('js/validacionesTipoProductos.js') }}"></script>
<script type="text/javascript">

/**
 *=====================================================================================================================================================
 *=                                         Empiezan las funciones relacionadas al crud de tipos de productos                                         =
 *=====================================================================================================================================================
 */
$('body').delegate('button#categorias_crud','click', function() {
    $('#form_tipos input.form-control').val('');
    $('#form_tipos div.form-group').removeClass('has-error');
    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/guardar_tipo_producto')}}");
    $('a[href="#tabTablaCategoria"]').tab('show');
    $('a[href="#tabNuevaCategoria"]').text('Nueva categoría');
    $("div#foto_tipo").hide();
    $('#categoria_dialogo').modal({
        keyboard: false
    });
});

$('body').delegate('button#nueva_categoria','click', function() {
    $('#form_tipos div.form-group').removeClass('has-error');
    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/guardar_tipo_producto')}}");
    $('#form_tipos input.form-control').val('');
    $("div#foto_tipo").hide();
    $('a[href="#tabNuevaCategoria"]').text('Nueva categoría').tab('show');
});


$('body').delegate('button.editar_categoria','click', function() {
    $('#form_tipos div.form-group').removeClass('has-error');

    tipo_producto_id = $(this).parent().siblings("td:nth-child(1)").text(),
    tipo_producto = $(this).parent().siblings("td:nth-child(2)").text(),
    foto_tipo_producto = $(this).parent().siblings("td:nth-child(3)").text();

    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/editar_tipo_producto')}}");
    $("#form_tipos input#tipo_producto_id").val(tipo_producto_id);
    $("#form_tipos input#tipo_producto").val(tipo_producto);

    $('div#foto_tipo').children().children().children().remove('img#foto_tipo');
    $('div#foto_tipo').children().children().append(
        "<img src='<?php echo asset('');?>/"+foto_tipo_producto+"' class='img-responsive img-thumbnail' alt='Responsive image' id='foto_tipo'>"
    );

    $("div#foto_tipo").show();
    $('a[href="#tabNuevaCategoria"]').text('Editar categoría').tab('show');
});

$('body').delegate('button.eliminar_categoria','click', function() {
    var id = $(this).parent().siblings("td:nth-child(1)").text();
    var nombre = $(this).parent().siblings("td:nth-child(2)").text();
    var token = $("#token").val();

    swal({
        title: "¿Realmente desea eliminar la categoría <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarTipoProducto(id,token);
    });
    
});


/**
 *=============================================================================================================================================
 *=                                        Empiezan las funciones relacionadas a la tabla de productos                                        =
 *=============================================================================================================================================
 */

$('#formulario_producto').on('hidden.bs.modal', function (e) {
    $('#formulario_producto div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $("#formulario_producto input#oferta").prop('checked',false);
});

$('#formulario_producto').on('shown.bs.modal', function () {
    categoria_id = $('select#subcategoria_id').attr('categoria-id');
    $("#formulario_producto select#subcategoria_id").val(categoria_id);
});

$('body').delegate('button#exportar_productos_excel','click', function() {
    fecha_inicio = false;
    fecha_fin = false;
    window.location.href = "<?php echo url();?>/productos/exportar_productos/"+fecha_inicio+"/"+fecha_fin;
});

$('body').delegate('button#nuevo_producto','click', function() {
    $('select.form-control').val(0);
    $('input.form-control').val('');
    $('div#foto_producto').hide();
    $("h4#titulo_form_producto").text('Nuevo producto');
    $("form#form_producto").get(0).setAttribute('action', '<?php echo url();?>/productos/guardar');
});

$('body').delegate('.editar_producto','click', function() {
    $('input.form-control').val('');
    id = $(this).parent().siblings("td:nth-child(2)").text(),
    nombre = $(this).parent().siblings("td:nth-child(3)").text(),
    precio = $(this).parent().siblings("td:nth-child(4)").text(),
    stock = $(this).parent().siblings("td:nth-child(5)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(6)").text(),
    tipo_producto_id = $(this).parent().siblings("td:nth-child(7)").text(),
    imagen = $(this).parent().siblings("td:nth-child(8)").text(),
    token = $('#token').val();

    $("h4#titulo_form_producto").text('Editar producto');
    $("form#form_producto").get(0).setAttribute('action', '<?php echo url();?>/productos/editar');
    $("#formulario_producto input#id").val(id);
    $("#formulario_producto input#nombre").val(nombre);
    $("#formulario_producto input#precio").val(precio);
    $("#formulario_producto input#stock").val(stock);
    $("#formulario_producto textarea#descripcion").val(descripcion);
    $("#formulario_producto select#tipo_producto_id").val(tipo_producto_id);
    //$("#formulario_producto input#oferta").prop('checked',oferta == 1 ? true : false );

    $('div#foto_producto').children().children().children().remove('img#foto_producto');
    $('div#foto_producto').children().children().append(
        "<img src='<?php echo asset('');?>/"+imagen+"' class='img-responsive img-thumbnail' alt='Responsive image' id='foto_producto'>"
    );
    $("div#foto_producto").show();

    $('#formulario_producto').modal();
});

$('body').delegate('#eliminar_multiples_productos','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar los <span style='color:#F8BB86'>" + checking.length + "</span> productos seleccionados?",
            text: "¡Esta acción no podrá deshacerse!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            var token = $("#token").val();
            eliminarMultiplesProductos(checking, token);
        });
    }
});


$('body').delegate('.eliminar_producto','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(3)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar al producto <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarProducto(id,token);
    });
});
</script>
@endsection