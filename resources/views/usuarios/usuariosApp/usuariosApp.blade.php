@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
th {
    text-align: center!important;
}
/* Cambia el color de fondo de los input con autofill */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="text-center" style="margin: 20px;">
    <h2>Lista de usuarios en la aplicación</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editar-usuario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Editar usuario</h4>
                </div>
                <form id="form_usuarios_app" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Nombre (s)</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Apellido (s)</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hide">
                                <div class="form-group">
                                    <label for="user">Correo viejo</label>
                                    <input type="text" class="form-control" id="correo_viejo" name="correo_viejo" placeholder="Correo viejo">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Correo</label>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar-datos-usuario">Guardar</button>
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
                        @if(count($usuarios) > 0)
                            <button type="button" class="btn btn-info" id="exportar_usuarios_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar usuarios (app)</button>
                        @endif
                        <button type="button" class="btn btn-primary" id="nuevo_usuario_app"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario (app)</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">         
                            <table class="table table-hover" id="example3">
                                <thead class="centered">    
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th class="hide">Apellido</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th class="hide">Foto perfil</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody id="tabla-usuarios-app" class="">
                                    @if(count($usuarios) > 0)
                                        @foreach($usuarios as $usuario)
                                            <tr class="" id="{{$usuario->id}}" idUsuario="{{$usuario->id}}">
                                                <td>{{$usuario->id}}</td>
                                                <td>{{$usuario->nombre}}</td>
                                                <td class="hide">{{$usuario->apellido}}</td>
                                                <td>{{$usuario->correo}}</td>
                                                <td>{{$usuario->celular}}</td>
                                                <td class="hide">{{$usuario->foto_perfil}}</td>
                                                <td><?php echo $usuario->status == '2' ? '<span class="label label-warning">Bloqueado</span>' : ($usuario->status == '1' ? '<span class="label label-success">Activo</span>' : '<span class="label label-info">Desconocido</span>')?></td>
                                                <td>
                                                    @if($usuario->status == '1')
                                                        <button type="button" class="btn btn-info editar-usuario" change-to="">Editar</button>
                                                        <button type="button" class="btn btn-warning bloquear-usuario" change-to="2">Bloquear</button>
                                                        <button type="button" class="btn btn-danger eliminar-usuario" change-to="0">Borrar</button>
                                                    @endif
                                                    
                                                    @if($usuario->status == '2')
                                                        <button type="button" class="btn btn-primary reactivar-usuario" change-to="1">Reactivar</button>
                                                    @endif
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
<script src="{{ asset('js/validacionesUsuariosApp.js') }}"></script>
<script src="{{ asset('js/usuariosAppAjax.js') }}"></script>
<script>
/*Código para cuando se ocultan los modal*/
$('#editar-usuario').on('hidden.bs.modal', function (e) {
    $('#editar-usuario div.form-group').removeClass('has-error');
    $('input.form-control').val('');
});
/*Fin de código para cuando se ocultan los modal*/
$('body').delegate('button#exportar_usuarios_excel','click', function() {
    window.location.href = "<?php echo url();?>/usuarios/app/exportar_usuarios_app";
});

$('body').delegate('button#nuevo_usuario_app','click', function() {
    $('#editar-usuario div.form-group').removeClass('has-error');
    $("form#form_usuarios_app").get(0).setAttribute('action', '<?php echo url();?>/usuarios/app/guardar_usuario_app');
    $('input.form-control').val('');
    $("h4#gridSystemModalLabel").text('Nuevo usuario (app)');
    $('#editar-usuario').modal();
});

$('body').delegate('.editar-usuario','click', function() {
    $('#editar-usuario div.form-group').removeClass('has-error');
    $('input.form-control').val('');
    $("form#form_usuarios_app").get(0).setAttribute('action', '<?php echo url();?>/usuarios/app/editar_usuario_app');
    id = $(this).parent().siblings("td:nth-child(1)").text(),
    nombre = $(this).parent().siblings("td:nth-child(2)").text(),
    apellido = $(this).parent().siblings("td:nth-child(3)").text(),
    correo = $(this).parent().siblings("td:nth-child(4)").text(),
    celular = $(this).parent().siblings("td:nth-child(5)").text(),
    //foto = $(this).parent().siblings("td:nth-child(6)").text(),
    //status = $(this).parent().siblings("td:nth-child(7)").text();

    $("#editar-usuario input#id").val(id);
    $("#editar-usuario input#nombre").val(nombre);
    $("#editar-usuario input#apellido").val(apellido);
    $("#editar-usuario input#correo").val(correo);
    $("#editar-usuario input#correo_viejo").val(correo);
    $("#editar-usuario input#celular").val(celular);

    $('#editar-usuario').modal();
});

$('body').delegate('.eliminar-usuario, .bloquear-usuario, .reactivar-usuario','click', function() {
    var usuario = $(this).parent().siblings("td:nth-child(2)").text();
    var status = $(this).attr("change-to");
    var correo = $(this).parent().siblings("td:nth-child(4)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    var mensajeStatus = (status == '0' ? 'borrar' :  (status == '1' ? 'reactivar' : (status == '2' ? 'bloquear' : '')))

    swal({
        title: "¿Realmente desea " + mensajeStatus + " al usuario " + "<span style='color:#F8BB86'>" + usuario + "</span>?",
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
        eliminarBloquearUsuario(id,status,correo,token);
    });
});
</script>
@endsection