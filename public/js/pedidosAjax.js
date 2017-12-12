base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function obtenerInfoPedido(orden_id,token) {
    url = base_url.concat('/pedidos/obtener_info_pedido');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "orden_id":orden_id,
            "_token":token
        },
        success: function(data) {
            console.info(data);

            $("table#detalle_pedido tbody").children().remove();
            $('li#li_comentario_a_estilista').hide();
            $('#li_calificacion_a_estilista').hide();
            $('li#li_comentario_a_usuario').hide();
            $('#li_calificacion_a_usuario').hide();
            $('li#li_estilista_nombre_completo').hide();
            $('li#li_estilista_foto').hide();
            $('li#li_order_start_date').hide();
            $('li#li_order_end_date').hide();
            $('li#li_no_int').hide();

            var items = data.detalles;

            /*Datos generales*/
            $('span#order_id').text(data.id);
            $('span#order_id_conekta').text(data.conekta_order_id);
            $('span#order_status').text('Pagado');
            $('span#order_date').text(data.created_at);
            $('span#order_client').text(data.nombre_cliente);
            if (data.cantidad_servicios != 0) {
                $('li#li_order_start_date').show();
                $('li#li_order_end_date').show();
                $('span#order_start_date').text(data.start_datetime);
                $('span#order_end_date').text(data.end_datetime);
            }
            if (data.estilista_nombre != null) {
                $('li#li_estilista_nombre_completo, li#li_estilista_foto').show();
                $('span#estilista_nombre_completo').text(data.estilista_nombre + ' ' +data.estilista_apellido);
                $("img#estilista_foto").attr("src", baseUrl+'/'+data.estilista_foto);
            }

            if (data.comentario_estilista != null) {
                $('#li_comentario_a_estilista').show();
                $('#comentario_a_estilista').text(data.comentario_estilista);
            }

            if (data.puntuacion_estilista != null) {
                $('#li_calificacion_a_estilista').show();
                $('#calificacion_a_estilista').text(data.puntuacion_estilista == 1 ? data.puntuacion_estilista + ' Estrella' : data.puntuacion_estilista + ' Estrellas');
            }

            if (data.comentario_usuario != null) {
                $('#li_comentario_a_usuario').show();
                $('#comentario_a_usuario').text(data.comentario_usuario);
            }

            if (data.puntuacion_usuario != null) {
                $('#li_calificacion_a_usuario').show();
                $('#calificacion_a_usuario').text(data.puntuacion_usuario == 1 ? data.puntuacion_usuario + ' Estrella' : data.puntuacion_usuario + ' Estrellas');
            }
            
            /*Datos de contacto*/
            $('span#customer_id_conekta').text(data.customer_id_conekta);
            $('span#customer_name').text(data.nombre_cliente);
            $('span#customer_email').text(data.correo_cliente);
            $('span#customer_phone').text(data.telefono);

            /*Dirección*/
            $('span#recibidor').text(data.recibidor);
            $('span#phone').text(data.telefono);
            $('span#country').text(data.pais);
            $('span#state').text(data.estado);
            $('span#city').text(data.ciudad);
            $('span#postal_code').text(data.codigo_postal);
            $('span#street').text(data.calle);
            $('span#between').text(data.entre);
            if (data.num_int != null) {
                $('li#li_no_int').show();
                $('span#no_int').text(data.num_int);
            }
            $('span#no_ext').text(data.num_ext);

            /*Detalles de pedido (Productos)*/
            for (var key in items) {
                if (items.hasOwnProperty(key)) {
                    $("table#detalle_pedido tbody").append(
                        '<tr>'+
                            '<td class="text-center">'+items[key].nombre_producto+'</td>'+
                            '<td class="text-center">'+(items[key].tipo)+'</td>'+
                            '<td class="text-center">$'+(items[key].precio / 100)+'</td>'+
                            '<td class="text-center">'+(items[key].cantidad)+'</td>'+
                            '<td class="text-center">$'+((items[key].precio * items[key].cantidad) / 100)+'</td>'+
                        '</tr>'
                    );
                }
            }

            $("table#detalle_pedido tbody").append(
                '<tr>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center bold">Costo total</td>'+
                    '<td class="text-center">$'+(data.costo_total/100)+'</td>'+
                '</tr>'
            );

            $('div#campos_detalles').removeClass('hide');
            $('div#load_bar').addClass('hide');
        },
        error: function(xhr, status, error) {
            $('#detalles_pedido').modal('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema obteniendo los detalles de este servicio, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function asignarEstilista(btn) {
    $.ajax({
        url:$("form#form_asignar_estilista").attr('action'),
        type:$("form#form_asignar_estilista").attr('method'),
        data:new FormData($("form#form_asignar_estilista")[0]),
        processData: false,
        contentType: false,
        success:function(data) {
            console.log(data.id);
            tr = $('tr.modifiable');
            tr.children('td').siblings("td:nth-child(7)").text(data.id);
            tr.children('td').siblings("td:nth-child(8)").children('span').removeClass('label-important').addClass('label-success').text(data.nombre);
            tr.removeClass('modifiable');

            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            $('#asignar-estilista').modal('hide');
            swal({
                title: "Estilista asignado correctamente.",
                type: "success",
                timer: 1500,
                showConfirmButton: true,
            });
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema asignado un estilista a este servicio, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    })
}

function cargarEstilistasSelect(start_datetime, end_datetime, estilista_id, btn, token) {
    btn.find('i.fa-scissors').hide();
    btn.find('i.fa-spin').show();
    btn.attr('disabled', true);
    url = base_url.concat('/pedidos/cargar_estilistas_disponibles');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "start_datetime":start_datetime,
            "end_datetime":end_datetime,
            "estilista_id":estilista_id,
            "_token":token
        },
        success: function(data) {
            console.info(data);
            $('select#estilista_id option').remove();
            $('select#estilista_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
            
            data.forEach(function (option) {
                $('select#estilista_id').append('<option value="'+option.id+'">'+ option.nombre + ' ' + option.apellido + '</option>');
            });

            btn.find('i.fa-scissors').show();
            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            $('#asignar-estilista').modal();

        },
        error: function(xhr, status, error) {
            btn.find('i.fa-scissors').show();
            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema filtrando los estilistas disponibles, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
