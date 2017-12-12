base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function eliminarProducto(id,token) {
    url = base_url.concat('/productos/eliminar');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal({
                title: "Producto eliminado correctamente, esta página se recargará automáticamente ahora.",
                type: "success",
                showConfirmButton: false,
            }, 
                function() {
                    location.reload();
                }
            );
            setTimeout("location.reload()",1200);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este producto, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarMultiplesProductos(checking, token) {
    console.info(checking);
    url = base_url.concat('/productos/eliminar_multiples');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "checking":checking,
            "_token":token
        },
        success: function(data) {
            swal({
                title: "Productos eliminados correctamente, esta página se recargará automáticamente ahora.",
                type: "success",
                showConfirmButton: false,
            }, 
                function() {
                    location.reload();
                }
            );
            setTimeout("location.reload()",1200);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando los productos seleccionados, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarTipoProducto(id,token) {
    url = base_url.concat('/tipo_producto/eliminar_tipo_producto');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "tipo_producto_id":id,
            "_token":token
        },
        success: function(response) {
            swal({
                title: "Registro eliminado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            recargarSelect(response);
            dibujarTabla(response);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este registro, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function agregarTipoProducto() {
    $.ajax({
        url:$("form#form_tipos").attr('action'),
        type:$("form#form_tipos").attr('method'),
        data:new FormData($("form#form_tipos")[0]),
        processData: false,
        contentType: false,
        success:function(response) {
            $('#form_tipos input.form-control').val('');
            $('#form_tipos div.form-group').removeClass('has-error');
            $('a[href="#tabNuevaCategoria"]').text('Nueva categoría');
            $("div#foto_tipo").hide();
            $('#guardar_categoria').show();
            swal({
                title: "Registro agregado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            recargarSelect(response);
            dibujarTabla(response);
            $('a[href="#tabTablaCategoria"]').tab('show');
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema guardando este registro, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    })
}

function dibujarTabla(response) {
    var buttons_table = "<button type='button' class='btn btn-info editar_categoria'>Editar</button> " +
                        "<button type='button' class='btn btn-danger eliminar_categoria'>Borrar</button>";
    var oTable = $('#categoria').dataTable();
    oTable.fnClearTable();
    $.each(response,function(i,e) {
        if ( response.length > 0 ) {
            oTable.dataTable().fnAddData( 
            [
                e.id,
                e.tipo,
                e.foto,
                buttons_table
            ] );      
        }
    })
    $("table#categoria tbody tr td:nth-child(3)").addClass("hide");
}

function recargarSelect(data) {
    $('select#tipo_producto_id option').remove();
    $('select#tipo_producto_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
    
    data.forEach(function (option) {
        $('select#tipo_producto_id').append('<option value="'+option.id+'">'+option.tipo+'</option>');
    });
}
