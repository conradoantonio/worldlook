base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function eliminarCupon(id,token) {
    url = base_url.concat('/cupones/eliminar');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal({
                title: "Cupón eliminado correctamente, esta página se recargará automáticamente ahora.",
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
                text: "Se encontró un problema eliminando este cupón, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarMultiplesCupones(checking, token) {
    console.info(checking);
    url = base_url.concat('/cupones/eliminar_multiples');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "checking":checking,
            "_token":token
        },
        success: function(data) {
            swal({
                title: "Cupones eliminados correctamente, esta página se recargará automáticamente ahora.",
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
                text: "Se encontró un problema eliminando los cupones seleccionados, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
