@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}" type="text/css"/>
<style type="text/css">
    th {
        text-align: center!important;
    }
</style>

<div class="text-center" style="margin: 20px;">
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_config_categoria" id="configurar_categoria">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_config_categoria">Editar categorias</h4>
                </div>
                <form enctype="multipart/form-data" action="{{url('configurarcion_servicios/editar_config')}}" method="POST" onsubmit="return false;" autocomplete="off" id="form_configurar_categoria">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="tipo_producto_id" name="tipo_producto_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="categoria_tipo">Tipo</label>
                                    <input type="text" class="form-control" id="categoria_tipo" name="categoria_tipo">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-dismissible text-justify" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Nota: </strong>
                                    Sólo se permiten caracteres numéricos, por lo que NO debe ingresar letras ni signos como el de peso $ para completar los campos.
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tiempo_minimo">Tiempo mínimo (En minutos)</label>
                                    <input type="text" class="form-control" id="tiempo_minimo" name="tiempo_minimo" placeholder="Ej: 60">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tiempo_maximo">Tiempo máximo (En minutos)</label>
                                    <input type="text" class="form-control" id="tiempo_maximo" name="tiempo_maximo" placeholder="Ej: 80">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_categoria">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Categorias</h2>
    <div class="well">
        Si alguna de las categorías se encuentra deshabilitada en el menú (Por ejemplo, que no se haya incluido a los niños en piojos), ésta no aparecerá en la aplicación aunque se modifiquen los valores mostrados en esta tabla.
    </div>
    <div class="row" id="tab-tables">
         @include('categorias.configurar_categorias_tabla')
    </div>
</div>
<script type="text/javascript" src="{{asset('/js/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/validacionesConfigurarCategoria.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/tabs_accordian.js') }}"></script>
<script type="text/javascript">
    $('body').delegate('button.editar_categoria','click', function() {
        $('#form_configurar_categoria div.form-group').removeClass('has-error');
        
        tab = $('#tab-01 li.active a').text();
        id = $(this).parent().siblings("td:nth-child(1)").text(),
        categoria = $(this).parent().siblings("td:nth-child(2)").text(),
        precio = $(this).parent().siblings("td:nth-child(3)").text(),
        tiempo_minimo = $(this).parent().siblings("td:nth-child(4)").text(),
        tiempo_maximo = $(this).parent().siblings("td:nth-child(5)").text();
        tipo = $(this).parent().siblings("td:nth-child(6)").text();

        $('h4#titulo_config_categoria').text('Editar categoria ' + tab + ' (' + categoria + ')');
        $("#form_configurar_categoria input#tipo_producto_id").val(id);
        $("#form_configurar_categoria input#precio").val(precio);
        $("#form_configurar_categoria input#tiempo_minimo").val(tiempo_minimo);
        $("#form_configurar_categoria input#tiempo_maximo").val(tiempo_maximo);
        $("#form_configurar_categoria input#categoria_tipo").val(tipo);

        //$('a[href="#tabNuevaCategoria"]').text('Editar categoría').tab('show');

        $('div#configurar_categoria').modal();
    });


    function actualizarMenuCategorias(button) {
        url = "{{url('menu_app/menus_categorias')}}";
        $.ajax({
            method: "POST",
            url: $("form#form_configurar_categoria").attr('action'),
            data: $("form#form_configurar_categoria").serialize(),
            //processData: false,
            success: function(data) {
                button.children('i').hide();
                button.attr('disabled', false);
                $('div#configurar_categoria').modal('hide');
                
                var a_active = '';
                $('a[href="#tabCortes"]').parent('li').hasClass('active') ? a_active = 'tabCortes' : ''
                $('a[href="#tabPeinados"]').parent('li').hasClass('active') ? a_active = 'tabPeinados' : ''
                $('a[href="#tabPiojos"]').parent('li').hasClass('active') ? a_active = 'tabPiojos' : ''
                refreshTable(window.location.href, a_active);
            },
            error: function(xhr, status, error) {
                button.children('i').hide();
                button.attr('disabled', false);
                swal({
                    title: "<small>¡Error!</small>",
                    text: "Se encontró un problema actualizando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                    html: true
                });
            }
        });
    }

    function refreshTable(url, a_active) {
        //var table = $("table").dataTable();
        $('div#tab-tables').fadeOut();
        $('div#tab-tables').empty();
        //table.fnDestroy();
        $('div#tab-tables').load(url, function() {
            $('div#tab-tables').fadeIn();
            setTimeout(function(){ $('a[href="#'+a_active+'"]').tab('show'); }, 500);
            //$("table").dataTable();
        });
    }
</script>
@endsection