base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
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
