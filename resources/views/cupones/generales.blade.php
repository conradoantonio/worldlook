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
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="porcentaje">Porcentaje</label>
                                    <input type="number" min="0" class="form-control" id="porcentaje" name="porcentaje" placeholder="Porcentaje">
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

    <h2>Lista de cupones generales</h2>

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
                                        <th>Porcentaje descuento</th>
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
                                                <td>{{$cupon->porcentaje_descuento}}</td>
                                                <td>{{$cupon->fecha_inicio}}</td>
                                                <td>{{$cupon->fecha_fin}}</td>
                                                <td>{{$cupon->codigo}}</td>
                                                <td class="hide">{{$cupon->descripcion}}</td>
                                                <td>
                                                    {!! ($cupon->status_cupon == 'Activo' ? '<span class="label label-success">'.$cupon->status_cupon.'</span>' : 
                                                        ($cupon->status_cupon == 'Inactivo' ? '<span class="label label-important">'.$cupon->status_cupon.'</span>' :
                                                        ($cupon->status_cupon == 'Expirado' ? '<span class="label label-danger">'.$cupon->status_cupon.'</span>' : 
                                                        '<span class="label label-danger">Desconocido</span>')))
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
<script src="{{ asset('js/validacionesCuponesGenerales.js') }}"></script>
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
$('#formulario_cupon').on('hidden.bs.modal', function (e) {
    $('#formulario_cupon div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
});

$('#formulario_cupon').on('shown.bs.modal', function () {
    categoria_id = $('select#subcategoria_id').attr('categoria-id');
    $("#formulario_cupon select#subcategoria_id").val(categoria_id);
});

$('body').delegate('button#nuevo_cupon','click', function() {
    $('input.form-control').val('');
    $('div#foto_cupon').hide();
    $("h4#titulo_form_cupon").text('Nuevo cupón');
    $("form#form_cupon").get(0).setAttribute('action', '{{url('/cupones/generales/guardar')}}');
});

$('body').delegate('.editar_cupon','click', function() {
    $('input.form-control').val('');

    id = $(this).parent().siblings("td:nth-child(2)").text(),
    porcentaje_descuento = $(this).parent().siblings("td:nth-child(3)").text(),
    fecha_inicio = $(this).parent().siblings("td:nth-child(4)").text(),
    fecha_fin = $(this).parent().siblings("td:nth-child(5)").text(),
    codigo = $(this).parent().siblings("td:nth-child(6)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(7)").text(),
    token = $('#token').val();

    $("h4#titulo_form_cupon").text('Editar cupón '+ codigo);
    $("form#form_cupon").get(0).setAttribute('action', '{{url('/cupones/generales/editar')}}');
    $("#formulario_cupon input#id").val(id);
    $("#formulario_cupon input#porcentaje").val(porcentaje_descuento);
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
    var nombre = $(this).parent().siblings("td:nth-child(6)").text();
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