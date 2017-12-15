@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
th {
    text-align: center!important;
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
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_noticias" id="form_noticia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_noticias">Editar noticia</h4>
                </div>
                <form id="noticias" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        
                        <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                        <div class="col-sm-6 col-xs-12 hidden">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" name="id">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" id="titulo" placeholder="Noticia" name="titulo">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="mensaje">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" placeholder="Escriba su contenido detalladamente aquí..." name="mensaje" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Cargar Imagen</label>
                                    <input type="file" name="foto" class="form-control" id="foto" size="5120">
                                </div>
                            </div>
                        </div>

                        <div class="row" id="foto">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Imagen Actual</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_noticia">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de noticias</h2>

    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary" id="nueva_noticia">Agregar noticia</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="example3">
                            <thead class="centered">    
                                <th>ID</th>
                                <th>Título</th>
                                <th>Mensaje</th>
                                <th class="hide">Foto</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody id="" class="">
                                @if(count($noticias) > 0)                    
                                    @foreach($noticias as $noticia)
                                        <tr id="{{$noticia->id}}">
                                            <td>{{$noticia->id}}</td>
                                            <td>{{$noticia->titulo}}</td>
                                            <td class="text"> <span>{{$noticia->mensaje}}</span></td>
                                            <td class="hide">{{$noticia->foto}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info editar_noticia">Editar</button>
                                                <button type="button" class="btn btn-danger eliminar_noticia" status-pueblo="0">Borrar</button>
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
<script src="{{ asset('js/validacionesNoticias.js') }}"></script>
<script src="{{ asset('js/noticiasAjax.js') }}"></script> 
<script type="text/javascript">

$('#form_noticia').on('hidden.bs.modal', function (e) {
    $('#form_noticia div.form-group').removeClass('has-error');
    $('#guardar_noticia').show();
})

$('body').delegate('#nueva_noticia','click', function() {
    $("form#noticias").get(0).setAttribute('action', "{{url('/noticias/guardar')}}");
    $('h4#titulo_form_noticias').text('Nueva noticia');
    $("#form_noticia .form-control").val('');
    $("div#foto").hide();
    $('#form_noticia').modal();
});

$('body').delegate('.editar_noticia','click', function() {
    $("form#noticias").get(0).setAttribute('action', "{{url('/noticias/editar')}}");
    $('h4#titulo_form_noticias').text('Editar noticia');
    id = $(this).parent().siblings("td:nth-child(1)").text(),
    titulo = $(this).parent().siblings("td:nth-child(2)").text(),
    mensaje = $(this).parent().siblings("td:nth-child(3)").text();
    imagen = $(this).parent().siblings("td:nth-child(4)").text();
    ayuda_menu_id = $(this).parent().siblings("td:nth-child(5)").text();

    $("#form_noticia input#id").val(id);
    $("#form_noticia input#titulo").val(titulo);
    $("#form_noticia textarea#mensaje").val(mensaje);
    $('div#foto').children().children().children().remove('img#foto');
    $('div#foto').children().children().append(
        "<img src='<?php echo asset('');?>"+imagen+"' class='img-responsive img-thumbnail' alt='Responsive image' id='foto'>"
    );
    $("div#foto").show();

    $('#form_noticia').modal();
});

$('body').delegate('.eliminar_noticia','click', function() {
    var noticia_id = $(this).parent().siblings("td:nth-child(1)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar la noticia con el id " + "<span style='color:#F8BB86'>" + noticia_id + "</span>?",
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
        eliminarNoticia(id,token);
    });
});

</script>
@endsection