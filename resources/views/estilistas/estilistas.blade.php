@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-select.min.css')}}" type="text/css"/>
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
textarea {
    resize: none;
}
.table td.text {
    max-width: 177px;
}
.table td.text span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
    max-width: 100%;
}
</style>
<div class="text-center" style="margin: 20px;">
    <h2>Lista de estilistas</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editar-estilista">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Editar estilista</h4>
                </div>
                <form id="form_estilistas" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Estilista ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="usuario_id">Usuario ID</label>
                                    <input type="text" class="form-control" id="usuario_id" name="usuario_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre (s)</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="apellido">Apellido (s)</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="correo">Categorías</label>
                                    <select class="selectpicker form-control" id="categorias_id" name="categorias_id[]" data-live-search="true"  multiple>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="correo">Subcategorías</label>
                                    <select class="selectpicker form-control" id="subcategorias_id" name="subcategorias_id[]" data-live-search="true"  multiple>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="input_foto_estilista">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="foto-usuario">Foto usuario</label>
                                    <input type="file" class="form-control" id="foto_estilista" name="foto_estilista">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="foto_estilista">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar-datos-estilista">
                            Guardar
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                        </button>
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
                        <button type="button" class="btn btn-primary" id="nuevo_estilista"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo estilista</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_estilistas">         
                            @include('estilistas.tabla')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('/js/bootstrap-select.js')}}"></script>
<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/validacionesEstilistas.js') }}"></script>
<script src="{{ asset('js/estilistasAjax.js') }}"></script>
<script>
/*Código para cuando se ocultan los modal*/
$('#editar-estilista').on('hidden.bs.modal', function (e) {
    $('#editar-estilista div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
});
/*Fin de código para cuando se ocultan los modal*/

$('body').delegate('button#nuevo_estilista','click', function() {
    $('#editar-estilista div.form-group').removeClass('has-error');
    $("form#form_estilistas").get(0).setAttribute('action', '{{ url('estilistas/guardar_estilista')}}');
    $('input.form-control').val('');
    $("h4#gridSystemModalLabel").text('Nuevo estilista');
    $("div#foto_estilista").hide();
    $('#editar-estilista').modal();
});

$('body').delegate('.editar-estilista','click', function() {

    $('select#categorias_id').selectpicker('val');
    $("h4#gridSystemModalLabel").text('Editar estilista');
    $('#editar-estilista div.form-group').removeClass('has-error');
    $('input.form-control').val('');
    $("form#form_estilistas").get(0).setAttribute('action', '{{ url('estilistas/editar_estilista')}}');
    estilista_id = $(this).parent().siblings("td:nth-child(1)").text(),
    nombre = $(this).parent().siblings("td:nth-child(2)").text(),
    apellido = $(this).parent().siblings("td:nth-child(3)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(4)").text(),
    foto = $(this).parent().siblings("td:nth-child(5)").text(),
    //status = $(this).parent().siblings("td:nth-child(6)").text();
    correo = $(this).parent().siblings("td:nth-child(7)").text();
    usuario_id = $(this).parent().siblings("td:nth-child(8)").text();
    //array_categorias = $(this).parent().siblings("td:nth-child(9)").text(),

    $("#form_estilistas input#id").val(estilista_id);
    $("#form_estilistas input#nombre").val(nombre);
    $("#form_estilistas input#apellido").val(apellido);
    $("#form_estilistas textarea#descripcion").val(descripcion);
    $("#form_estilistas input#correo").val(correo);
    $("#form_estilistas input#usuario_id").val(usuario_id);
    //$('#form_estilistas select#categorias_id').selectpicker('val', JSON.parse(array_categorias));

    $('div#foto_estilista').children().children().children().remove('img#foto_estilista');
    $('div#foto_estilista').children().children().append(
        "<img src='{{asset('')}}/"+foto+"' class='img-responsive img-thumbnail' style='max-width: 200px;' alt='Responsive image' id='foto_estilista'>"
    );
    $("div#foto_estilista").show();

    $('#editar-estilista').modal({
            keyboard: false,
            backdrop: 'static',
    });
});

$('body').delegate('.eliminar-estilista, .bloquear-estilista, .reactivar-estilista','click', function() {
    var estilista = $(this).parent().siblings("td:nth-child(2)").text();
    var status = $(this).attr("change-to");
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    var mensajeStatus = (status == '0' ? 'borrar' :  (status == '1' ? 'reactivar' : (status == '2' ? 'bloquear' : '')))

    swal({
        title: "¿Realmente desea " + mensajeStatus + " al estilista " + "<span style='color:#F8BB86'>" + estilista + "</span>?",
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
        eliminarBloquearUsuario(id,status,token);
    });
});
</script>
@endsection