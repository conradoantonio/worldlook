base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

function guardarEstilista(button) {
    var formData = new FormData($("form#form_estilistas")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_estilistas").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#editar-estilista').modal('hide');
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            $('div#editar-estilista').modal('hide');
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema guardando los datos, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarBloquearUsuario(id,status,token) {
    url = base_url.concat('/estilistas/cambiar_status_estilista');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "status":status,
            "_token":token
        },
        success: function() {
            status_usuario = (status == '0' ? 'borrado' :  (status == '1' ? 'reactivado' : (status == '2' ? 'bloqueado' : '')))

            swal({
                title: "Usuario " + status_usuario + " correctamente, esta página se recargará automáticamente ahora",
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
                title: "<small>Error!</small>",
                text: "Se encontró un problema cambiando el status del usuario, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#div_tabla_estilistas').fadeOut();
    $('div#div_tabla_estilistas').empty();
    $('div#div_tabla_estilistas').load(url, function() {
        $('div#div_tabla_estilistas').fadeIn();
        $("table#example3").dataTable({
            "aaSorting": [[ 0, "desc" ]]
        });
    });
}
