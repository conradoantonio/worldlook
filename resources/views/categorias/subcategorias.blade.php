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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_subcategoria" id="formulario_subcategoria">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_subcategoria">Nueva subcategoría</h4>
                </div>
                <form id="form_subcategoria" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
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
                                    <label for="nombre_subcategoria">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_subcategoria" name="nombre_subcategoria" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="menu_id">Menú</label>
                                    <select class="form-control" id="menu_id" name="menu_id">
                                        <option value="0">Seleccione una opción</option>
                                        @foreach($menus as $men)
                                            <option value="{{$men->id}}">{{$men->menu}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="categoria_id">Categoría</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id" menu-id="0">
                                        <option value="0">Seleccione una opción</option>
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
                                    Solo se permiten subir imágenes con formato jpg, png y jpeg con un tamaño menor a 5mb. 
                                    Procura que su resolución sea de 500x496 px o su equivalente a escala.
                                </div>
                            </div>
                            <div id="input_foto_subcategoria" class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="foto_subcategoria">Foto</label>
                                    <input type="file" class="form-control" id="foto_subcategoria" name="foto_subcategoria">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="foto_subcategoria">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_subcategoria">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de subcategorias</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        @if(count($subcategorias) > 0)                    
                            <button type="button" class="btn btn-danger" id="eliminar_multiples_subcategorias"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar subcategorias</button>
                        @endif
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_subcategoria" id="nuevo_subcategoria"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo subcategoria</button>
                    </div>
                    <div class="grid-body ">
                        <div class="table-responsive">
                            <table class="table" id="example3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Subcategoria</th>
                                        <th>Menu</th>
                                        <th class="hide">Menu_id</th>
                                        <th>Categoria</th>
                                        <th class="hide">Categoria_id</th>
                                        <th class="hide">Descripción</th>
                                        <th class="hide">Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($subcategorias) > 0)
                                        @foreach($subcategorias as $subcategoria)
                                            <tr class="" id="{{$subcategoria->subcategoria_id}}">
                                                <td class="small-cell v-align-middle">
                                                    <div class="checkbox check-success">
                                                        <input id="checkbox{{$subcategoria->subcategoria_id}}" type="checkbox" class="checkDelete" value="1">
                                                        <label for="checkbox{{$subcategoria->subcategoria_id}}"></label>
                                                    </div>
                                                </td>
                                                <td>{{$subcategoria->subcategoria_id}}</td>
                                                <td>{{$subcategoria->subcategoria}}</td>
                                                <td>{{$subcategoria->menu}}</td>
                                                <td class="hide">{{$subcategoria->menu_id}}</td>
                                                <td>{{$subcategoria->categoria}}</td>
                                                <td class="hide">{{$subcategoria->categoria_id}}</td>
                                                <td class="hide">{{$subcategoria->descripcion}}</td>
                                                <td class="hide">{{$subcategoria->foto_subcategoria}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info editar_subcategoria">Editar</button>
                                                    <button type="button" class="btn btn-danger eliminar_subcategoria">Borrar</button>
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
<script src="{{ asset('js/subcategoriasAjax.js') }}"></script>
<script src="{{ asset('js/validacionesSubcategorias.js') }}"></script>
<script type="text/javascript">

$('#formulario_subcategoria').on('hidden.bs.modal', function (e) {
    $('select.form-control').val(0);
    $('#formulario_subcategoria div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $("#formulario_subcategoria input#oferta").prop('checked',false);
    reiniciarSelect();
});

$('#formulario_subcategoria').on('shown.bs.modal', function () {
    setTimeout(function() {
        categoria_id = $('select#categoria_id').attr('menu-id');
        $("select#categoria_id").val(categoria_id);
    }, 500)
    
});

$('body').delegate('button#nuevo_subcategoria','click', function() {
    $('input.form-control').val('');
    $('div#foto_subcategoria').hide();
    $("h4#titulo_form_subcategoria").text('Nueva subcategoria');
    $("form#form_subcategoria").get(0).setAttribute('action', '<?php echo url();?>/subcategorias_app/guardar');
});

$('body').delegate('.editar_subcategoria','click', function() {
    $('select.form-control').val(0);

    $('input.form-control').val('');
    id = $(this).parent().siblings("td:nth-child(2)").text(),
    subcategoria = $(this).parent().siblings("td:nth-child(3)").text(),
    //menu = $(this).parent().siblings("td:nth-child(4)").text(),
    menu_id = $(this).parent().siblings("td:nth-child(5)").text(),
    //categoria = $(this).parent().siblings("td:nth-child(6)").text(),
    categoria_id = $(this).parent().siblings("td:nth-child(7)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(8)").text(),
    foto = $(this).parent().siblings("td:nth-child(9)").text(),
    token = $('#token').val();

    $("h4#titulo_form_subcategoria").text('Editar subcategoria');
    $("form#form_subcategoria").get(0).setAttribute('action', '<?php echo url();?>/subcategorias_app/editar');
    $("#formulario_subcategoria input#id").val(id);
    $("#formulario_subcategoria input#nombre_subcategoria").val(subcategoria);
    $("#formulario_subcategoria select#menu_id").val(menu_id);
    $("#formulario_subcategoria select#categoria_id").val(categoria_id);
    $("#formulario_subcategoria textarea#descripcion").val(descripcion);
    
    $('select#categoria_id').attr('disabled', true);
    cargarSubcategorías(menu_id,token);
    $("select#categoria_id").attr('menu-id',categoria_id);

    $('div#foto_subcategoria').children().children().children().remove('img#foto_subcategoria');
    $('div#foto_subcategoria').children().children().append(
        "<img src='<?php echo asset('');?>/"+foto+"' class='img-responsive img-thumbnail' alt='Responsive image' id='foto_subcategoria'>"
    );
    $("div#foto_subcategoria").show();

    $('#formulario_subcategoria').modal();
});

$( "select#menu_id" ).change(function() {
    menu_id = $(this).val();
    token = $('#token').val();
    $('select#categoria_id').attr('disabled', true);
    cargarSubcategorías(menu_id,token);
});

$('body').delegate('#eliminar_multiples_subcategorias','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar los <span style='color:#F8BB86'>" + checking.length + "</span> subcategorias seleccionados?",
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
            eliminarMultiplesSubcategorias(checking, token);
        });
    }
});

$('body').delegate('.eliminar_subcategoria','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(3)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar al subcategoria <span style='color:#F8BB86'>" + nombre + "</span>?",
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
        eliminarSubcategoria(id,token);
    });
});

function reiniciarSelect() {
    $("#formulario_subcategoria select#categoria_id").attr('menu-id', 0);
    $('select#categoria_id option').remove();
    $('select#categoria_id').append('<option value="0" selected="selected">Seleccione una opción</option>');  
}
</script>
@endsection