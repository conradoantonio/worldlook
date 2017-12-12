base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function eliminarSubcategoria(id,token) {
    url = base_url.concat('/subcategorias_app/eliminar');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal({
                title: "Subcategoría eliminada correctamente, esta página se recargará automáticamente ahora.",
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
                text: "Se encontró un problema eliminando esta subcategoría, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarMultiplesSubcategorias(checking, token) {
    url = base_url.concat('/subcategorias_app/eliminar_multiples');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "checking":checking,
            "_token":token
        },
        success: function(data) {
            swal({
                title: "Subcategorías eliminadas correctamente, esta página se recargará automáticamente ahora.",
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
                text: "Se encontró un problema eliminando las subcategorías seleccionadas, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function cargarSubcategorías(menu_id,token) {
    url = base_url.concat('/menu_app/categorias/cargar_subcategorias');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "menu_id":menu_id,
            "_token":token
        },
        success: function(data) {
            $('select#categoria_id').attr('disabled', false);

            $('select#categoria_id option').remove();
            $('select#categoria_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
            
            data.forEach(function (option) {
                $('select#categoria_id').append('<option value="'+option.id+'">'+option.categoria+'</option>');
            });
        },
        error: function(xhr, status, error) {
            $('select#categoria_id').attr('disabled', false);
            $('select#categoria_id option').remove();
            $('select#categoria_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
            console.warn('Error cargando las subcategorías');
        }
    });
}
