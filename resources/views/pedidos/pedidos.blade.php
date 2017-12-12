@extends('admin.main')

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/> --}}
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
label.control-label{
    font-weight: bold;
}
table td.table-bordered{
    border-bottom: 1px solid gray!important;
    border-top: 1px solid gray!important;
}
span.label_show {
    display: block;
    font-weight: bold;
}
span.label_show span {
    font-weight: normal;
}
li.active{
    color: white;
}
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_detalles_pedido" id="detalles_pedido">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="titulo_detalles_pedido">Detalles del servicio</h2>
                </div>
                <div class="modal-body">
                    <div class="row text-left" id="campos_detalles">
                        <div class="col-md-12">
                            <ul class="list-group">
                                <li class="list-group-item active">Datos generales del servicio</li>
                                <li class="list-group-item"><span class="label_show">Número de orden: <span id="order_id"></span></span></li>
                                <li class="list-group-item"><span class="label_show">ID orden de conekta: <span id="order_id_conekta"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Estatus: <span id="order_status">Pagado</span></span></li>
                                <li class="list-group-item"><span class="label_show">Fecha y hora de pago: <span id="order_date"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Cliente: <span id="order_client"></span></span></li>
                                <li class="list-group-item" id="li_order_start_date"><span class="label_show">Fecha y hora de inicio del servicio: <span id="order_start_date"></span></span></li>
                                <li class="list-group-item" id="li_order_end_date"><span class="label_show">Fecha y hora del término del servicio: <span id="order_end_date"></span></span></li>
                                <li class="list-group-item" id="li_calificacion_a_estilista"><span class="label_show">Calificación a estilista: <span id="calificacion_a_estilista"></span></span></li>
                                <li class="list-group-item" id="li_comentario_a_estilista"><span class="label_show">Comentario a estilista: <span id="comentario_a_estilista"></span></span></li>
                                <li class="list-group-item" id="li_calificacion_a_usuario"><span class="label_show">Calificación a usuario: <span id="calificacion_a_usuario"></span></span></li>
                                <li class="list-group-item" id="li_comentario_a_usuario"><span class="label_show">Comentario a usuario: <span id="comentario_a_usuario"></span></span></li>
                                <li class="list-group-item" id="li_estilista_nombre_completo"><span class="label_show">Estilista: <span id="estilista_nombre_completo"></span></span></li>
                                <li class="list-group-item" id="li_estilista_foto">
                                    <span class="label_show">Foto estilista: </span>
                                    <img width="300px;" src="" id="estilista_foto">
                                </li>
                            </ul>

                            <ul class="list-group">
                                <li class="list-group-item active">Productos</li>
                                <li class="list-group-item">
                                    <div class="table-responsive">
                                        <table id="detalle_pedido" class="table table-responsive">
                                            <thead>
                                                {{-- <th>ID</th> --}}
                                                <th style="text-align: center;">Producto/Servicio</th>
                                                <th style="text-align: center;">Tipo</th>
                                                <th style="text-align: center;">Precio unitario</th>
                                                <th style="text-align: center;">Cantidad</th>
                                                <th style="text-align: center;">Subtotal</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>

                            <ul class="list-group">
                                <li class="list-group-item active">Contacto</li>
                                <li class="list-group-item"><span class="label_show">ID cliente de conekta: <span id="customer_id_conekta"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Cliente: <span id="customer_name"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Email: <span id="customer_email"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Teléfono: <span id="customer_phone"></span></span></li>
                            </ul>

                            <ul class="list-group">
                                <li class="list-group-item active">Dirección</li>
                                <li class="list-group-item"><span class="label_show">Receptor: <span id="recibidor"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Teléfono: <span id="phone"></span></span></li>
                                <li class="list-group-item"><span class="label_show">País: <span id="country"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Estado: <span id="state"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Ciudad: <span id="city"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Código Postal: <span id="postal_code"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Calle: <span id="street"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Entre calle(s): <span id="between"></span></span></li>
                                <li class="list-group-item" id="li_no_int"><span class="label_show">Número interior: <span id="no_int"></span></span></li>
                                <li class="list-group-item"><span class="label_show">Número exterior: <span id="no_ext"></span></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row hide" id="load_bar">
                        <span><i class="fa fa-cloud-download fa-7x" aria-hidden="true"></i></span><br>
                        <h3>Cargando información desde conekta, espere.</h3>
                        <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-6 col-md-push-3 col-md-pull-3">
                            <div class="progress transparent progress-large progress-striped active no-radius no-margin">
                                <div data-percentage="100%" class="progress-bar progress-bar-success animate-progress-bar"></div>       
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="asignar_estilista_label" id="asignar-estilista">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="asignar_estilista_label">Asignar estilista</h4>
                </div>
                <form id="form_asignar_estilista" action="{{url('/pedidos/asignar_estilista')}}" onsubmit="return false;" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="servicio_id" name="servicio_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Fecha inicio</label>
                                    <input type="text" class="form-control" id="start_datetime" name="start_datetime">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Fecha final</label>
                                    <input type="text" class="form-control" id="end_datetime" name="end_datetime">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="estilista_id">Estilista</label>
                                    <select id="estilista_id" name="estilista_id" style="width:100%">
                                        <option value="0">Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-asignar-estilista">
                            Asignar
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Listado de servicios</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table" id="example3">
                                <thead>
                                    <tr>
                                        <th>ID orden</th>
                                        <th>Fecha pago</th>
                                        <th>Inicia en:</th>
                                        <th>Finaliza en:</th>
                                        <th>Total</th>
                                        <th>Cliente</th>
                                        <th class="hide">Estilista id</th>
                                        <th>Estilista</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($pedidos))
                                        @foreach($pedidos as $pedido)
                                            <tr class="" id="{{$pedido->id}}">
                                                <td>{{$pedido->conekta_order_id}}</td>
                                                <td>{{$pedido->created_at}}</td>
                                                <td>{!! $pedido->cantidad_servicios ? "<span class='label label-default'>$pedido->start_datetime</span>" : "<span class='label label-default'>No aplica</span>" !!}</td>  
                                                <td>{!! $pedido->cantidad_servicios ? "<span class='label label-default'>$pedido->end_datetime</span>" : "<span class='label label-default'>No aplica</span>" !!}</td>  
                                                <td>{{'$'.$pedido->costo_total/100}}</td>
                                                <td>{{$pedido->nombre_cliente}}</td>
                                                <td class="hide">{{$pedido->estilista_id}}</td>
                                                <td>
                                                    {!! ($pedido->cantidad_servicios ? ( $pedido->nombre_estilista ? "<span class='label label-success'>$pedido->nombre_estilista</span>" : "<span class='label label-important'>No asignado</span>") : "<span class='label label-default'>No aplica</span>") !!}
                                                </td>  
                                                <td>
                                                    @if ($pedido->cantidad_servicios)
                                                        <button type='button' class='btn btn-success asignar_estilista'>
                                                            <i class="fa fa-scissors" aria-hidden="true"></i> 
                                                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                                                            Estilista
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-info detalle_producto">
                                                        <i class="fa fa-info-circle" aria-hidden="true"></i> 
                                                        Detalles
                                                    </button>
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
<script src="{{ asset('js/pedidosAjax.js') }}"></script>
<script type="text/javascript">

$.fn.modal.Constructor.prototype.enforceFocus = function() {};//Esto corrige que el select2 pueda funcionar apropiadamente
var token = $("#token").val();

$('body').delegate('.detalle_producto','click', function() {
    var orden_id = $(this).parent().siblings("td:nth-child(1)").text();

    $('div#campos_detalles').addClass('hide');
    $('div#load_bar').removeClass('hide');
    $('#detalles_pedido').modal();
    obtenerInfoPedido(orden_id,token);
});

$('body').delegate('.asignar_estilista','click', function() {
    $("select#estilista_id").val("0").trigger("change");
    $('tr').removeClass('modifiable');
    $(this).parent().parent().addClass('modifiable');
    var orden_id_conekta = $(this).parent().siblings("td:nth-child(1)").text();
    var start_datetime = $(this).parent().siblings("td:nth-child(3)").text();
    var end_datetime = $(this).parent().siblings("td:nth-child(4)").text();
    var estilista_id = $(this).parent().siblings("td:nth-child(7)").text();
    var btn = $(this);
    $('input#servicio_id').val(orden_id_conekta);
    $('input#start_datetime').val(start_datetime);
    $('input#end_datetime').val(end_datetime);

    cargarEstilistasSelect(start_datetime, end_datetime, estilista_id, btn, token);
});

$('body').delegate('#btn-asignar-estilista','click', function() {
    if ($('select#estilista_id').val() != 0) {
        btn = $(this);
        btn.find('i.fa-spin').show();
        btn.attr('disabled', true);
        asignarEstilista(btn);
    } else {
        swal({
            title: "<small>¡Error!</small>",
            text: "Seleccione un estilista antes de continuar",
            html: true
        });
    }
});

</script>
@endsection