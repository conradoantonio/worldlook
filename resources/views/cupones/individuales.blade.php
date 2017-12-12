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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_cupon" id="formulario_cupon">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_cupon">Nuevo cupón</h4>
                </div>
                <form id="form_cupon" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="usuario_id">ID</label>
                                    <input type="text" class="form-control" id="usuario_id" name="usuario_id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="factor_id">Factor de descuento</label>
                                    <select class="form-control" id="factor_id" name="factor_id">
                                        <option value="0">Seleccione un factor</option>
                                        <option value="1">Por servicio</option>
                                        <option value="2">Por producto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12" id="div_cantidad_servicios">
                                <div class="form-group">
                                    <label for="cantidad_servicios">Cantidad servicios</label>
                                    <input type="number" min="0" class="form-control" id="cantidad_servicios" name="cantidad_servicios" placeholder="Cantidad servicios">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12" id="div_cantidad_productos">
                                <div class="form-group">
                                    <label for="cantidad_productos">Cantidad productos</label>
                                    <input type="number" min="0" class="form-control" id="cantidad_productos" name="cantidad_productos" placeholder="Cantidad productos">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="porcentaje">Porcentaje</label>
                                    <input type="number" min="0" class="form-control" id="porcentaje" name="porcentaje" placeholder="Porcentaje">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usuario_id">Usuario</label>
                                    <select class="form-control" id="usuario_id" name="usuario_id">
                                        <option value="0">Seleccione un usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{$usuario->id}}">{{$usuario->nombre}} {{$usuario->apellido}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Fecha inicio</label>
                                    <input type="text" name="fecha_inicio" class='form-control' id='fecha_inicio'>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Fecha límite</label>
                                    <input type="text" name="fecha_final" class='form-control' id='fecha_final'>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_cupon">Crear cupón</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de cupones individuales</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        @if(count($cupones) > 0)
                            <button type="button" class="btn btn-danger" id="eliminar_multiples_cupones"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar cupones</button>
                        @endif
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_cupon" id="nuevo_cupon"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo cupón</button>
                    </div>
                    <div class="grid-body ">
                        <div class="table-responsive">
                            <table class="table" id="example3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>No. Servicios</th>
                                        <th>No. Productos</th>
                                        <th>Porcentaje descuento</th>
                                        <th>Usuario</th>
                                        <th class="hide">Usuario_id</th>
                                        <th>Inicia en</th>
                                        <th>Finaliza en</th>
                                        <th>Código</th>
                                        <th class="hide">Descripción</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($cupones) > 0)
                                        @foreach($cupones as $cupon)
                                            <tr class="" id="{{$cupon->id}}">
                                                <td class="small-cell v-align-middle">
                                                    <div class="checkbox check-success">
                                                        <input id="checkbox{{$cupon->id}}" type="checkbox" class="checkDelete" value="1">
                                                        <label for="checkbox{{$cupon->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>{{$cupon->id}}</td>
                                                <td>{{$cupon->cantidad_servicios}}</td>
                                                <td>{{$cupon->cantidad_productos}}</td>
                                                <td>{{$cupon->porcentaje_descuento}}</td>
                                                <td>{{$cupon->nombre}} {{$cupon->apellido}}</td>
                                                <td class="hide">{{$cupon->usuario_id}}</td>
                                                <td>{{$cupon->fecha_inicio}}</td>
                                                <td>{{$cupon->fecha_fin}}</td>
                                                <td>{{$cupon->codigo}}</td>
                                                <td class="hide">{{$cupon->descripcion}}</td>
                                                <td>
                                                    {!! ($cupon->status_cupon == 'Activo' ? '<span class="label label-success">'.$cupon->status_cupon.'</span>' : 
                                                        ($cupon->status_cupon == 'Inactivo' ? '<span class="label label-warning">'.$cupon->status_cupon.'</span>' :
                                                        ($cupon->status_cupon == 'Expirado' ? '<span class="label label-important">'.$cupon->status_cupon.'</span>' : 
                                                        '<span class="label label-default">Desconocido</span>')))
                                                    !!}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info editar_cupon">Editar</button>
                                                    <button type="button" class="btn btn-danger eliminar_cupon">Borrar</button>
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
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/cuponesAjax.js') }}"></script>
<script src="{{ asset('js/validacionesCuponesIndividuales.js') }}"></script>
<script type="text/javascript">
window.onload = function (){
    $( "#fecha_inicio" ).datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
    }).on( "changeDate", function(e) {
        $( "#fecha_final" ).datepicker('setStartDate',e.date);
    });

    $( "#fecha_final" ).datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
    }).on( "changeDate", function(e) {
        $( "#fecha_inicio" ).datepicker('setEndDate',e.date);
    });
}

$( "select#factor_id" ).change(function() {
    factor_id = $(this).val();
    $('div#div_cantidad_productos').hide();
    $('div#div_cantidad_servicios').hide();

    if (factor_id == 1) {//Servicios
        $('div#div_cantidad_servicios').show();
        $("input#cantidad_productos").val('');
    } else if (factor_id == 2) {//Productos
        $('div#div_cantidad_productos').show();
        $("input#cantidad_servicios").val('');
    }
});

$('#formulario_cupon').on('hidden.bs.modal', function (e) {
    $('#formulario_cupon div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $('select').val(0);
});

$('#formulario_cupon').on('shown.bs.modal', function () {
    
});

$('body').delegate('button#nuevo_cupon','click', function() {
    $('div#div_cantidad_productos').hide();
    $('div#div_cantidad_servicios').hide();
    $('input.form-control').val('');
    $('div#foto_cupon').hide();
    $("h4#titulo_form_cupon").text('Nuevo cupón');
    $("form#form_cupon").get(0).setAttribute('action', '{{url('/cupones/individuales/guardar')}}');
});

$('body').delegate('.editar_cupon','click', function() {
    $('div#div_cantidad_productos').hide();
    $('div#div_cantidad_servicios').hide();
    $('input.form-control').val('');

    id = $(this).parent().siblings("td:nth-child(2)").text(),
    cantidad_servicios = $(this).parent().siblings("td:nth-child(3)").text(),
    cantidad_productos = $(this).parent().siblings("td:nth-child(4)").text(),
    porcentaje_descuento = $(this).parent().siblings("td:nth-child(5)").text(),
    usuario = $(this).parent().siblings("td:nth-child(6)").text(),
    usuario_id = $(this).parent().siblings("td:nth-child(7)").text(),
    fecha_inicio = $(this).parent().siblings("td:nth-child(8)").text(),
    fecha_fin = $(this).parent().siblings("td:nth-child(9)").text(),
    codigo = $(this).parent().siblings("td:nth-child(10)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(11)").text(),
    token = $('#token').val();

    if (cantidad_productos == 0 || cantidad_productos == '') {
        $("#formulario_cupon select#factor_id").val(1);
        $('div#div_cantidad_servicios').show();
        $("input#cantidad_servicios").val(cantidad_servicios);
    }

    if (cantidad_servicios == 0 || cantidad_servicios == '') {
        $("#formulario_cupon select#factor_id").val(2);
        $('div#div_cantidad_productos').show();
        $("input#cantidad_productos").val(cantidad_productos);
    }

    $("h4#titulo_form_cupon").text('Editar cupón '+ codigo);
    $("form#form_cupon").get(0).setAttribute('action', '{{url('/cupones/individuales/editar')}}');
    $("#formulario_cupon input#id").val(id);
    
    $("#formulario_cupon input#cantidad_productos").val(cantidad_productos);
    $("#formulario_cupon input#porcentaje").val(porcentaje_descuento);
    $("#formulario_cupon select#usuario_id").val(usuario_id);
    $("#formulario_cupon input#fecha_inicio").val(fecha_inicio);
    $("#formulario_cupon input#fecha_final").val(fecha_fin);
    $("#formulario_cupon textarea#descripcion").val(descripcion);

    $('#formulario_cupon').modal();
});

$('body').delegate('#eliminar_multiples_cupones','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar los <span style='color:#F8BB86'>" + checking.length + "</span> cupones seleccionados?",
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
            eliminarMultiplesCupones(checking, token);
        });
    }
});


$('body').delegate('.eliminar_cupon','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(10)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar al cupon <span style='color:#F8BB86'>" + nombre + "</span>?",
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
        eliminarCupon(id,token);
    });
});
</script>
@endsection