base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
console.info(base_url);
function eliminarNoticia(id,token) {
    url = base_url.concat('/noticias/eliminar');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal({
                title: "Noticia eliminada correctamente, esta página se recargará automáticamente ahora.",
                type: "success",
                showConfirmButton: false,
            }, 
                function() {
                    location.reload();
                });
                setTimeout("location.reload()",1200);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>Error!</small>",
                text: "Se encontró un problema eliminando la noticia, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}