@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}" type="text/css"/>
<style type="text/css">
div.zoom img{
    transition: .5s ease;
    -moz-transition: .5s ease; /* Firefox */
    -webkit-transition: .5s ease; /* Chrome - Safari */
    -o-transition: .5s ease; /* Opera */
}
div.zoom img:hover{
    transform : scale(1.005);
    -moz-transform : scale(1.005); /* Firefox */
    -webkit-transform : scale(1.005); /* Chrome - Safari */
    -o-transform : scale(1.005); /* Opera */
    -ms-transform : scale(1.005); /* IE9 */
}
img.menu:hover{
    cursor: pointer;
}
img.menu{
    margin-top: 20px;
    margin-bottom: 30px;
    width: 100%;
    height: 100%;
}
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="ver-menus">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Editar categorias menu</h4>
                </div>
                <form id="form_subcategorias" action="" onsubmit="return false" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="menu_id">Categoria ID</label>
                                    <input type="text" class="form-control" id="menu_id" name="menu_id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <select class="selectpicker form-control" id="sel-categorias" name="sel-categorias[]" data-live-search="true"  multiple>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar-categorias-menu">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Menu App</h2>
    <div class="well">Haga click en cualquiera de las opciones para ver las categorías asignadas.</div>
    <div class="row">
        @foreach($menus as $menu_app)
            <div class="col-xs-12 col-sm-6">
                <div class="zoom">
                    <h4>{{$menu_app->menu}}</h4>
                    <img id="{{$menu_app->id}}" class="img-responsive menu" array_categorias="{{$menu_app->array_categorias}}" menu_id="{{$menu_app->id}}" alt="Responsive image" src="{{ asset('')}}/{{$menu_app->foto}}">
                </div>
            </div>
        @endforeach
    </div>

</div>
<script type="text/javascript" src="{{asset('/js/bootstrap-select.js')}}"></script>
<script type="text/javascript">
    $('body').delegate('img.menu','click', function() {
        if ($(this).attr('menu_id') == 4) {
            window.location.href = "{{url('productos')}}";
        } else {
            $('select#sel-categorias').selectpicker('val');
            $('select#sel-categorias').selectpicker('val', JSON.parse($(this).attr('array_categorias')));
            $('input#menu_id').val($(this).attr('menu_id'));
            $('#ver-menus').modal({
                keyboard: false
            });
        }
    });

    $('body').delegate('button#guardar-categorias-menu','click', function() {
        var button = $(this);
        button.children('i').show();
        button.attr('disabled', true);
        var array_categorias = $('select#sel-categorias').val();
        var menu_id = $('input#menu_id').val();
        var token = $('input[name="_token"]').val();
        actualizarMenuCategorias(array_categorias, menu_id, button, token);
    });


    function actualizarMenuCategorias(array_categorias, menu_id, button, token) {
        url = "{{url('menu_app/menus_categorias')}}";
        $.ajax({
            method: "POST",
            url: url,
            data:{
                "array_categorias":array_categorias,
                "menu_id":menu_id,
                "_token":token
            },
            success: function(data) {
                button.children('i').hide();
                button.attr('disabled', false);
                $('#ver-menus').modal('hide');
                $('img#'+menu_id).attr('array_categorias', JSON.stringify(data));
                swal({
                    title: "<small>¡Éxito!</small>",
                    text: "Categorías actualizadas correctamente",
                    html: true,
                    type: "success"
                });
            },
            error: function(xhr, status, error) {
                button.children('i').hide();
                button.attr('disabled', false);
                swal({
                    title: "<small>¡Error!</small>",
                    text: "Se encontró un problema actualizando las categorías del menú, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                    html: true
                });
            }
        });
    }
</script>
@endsection