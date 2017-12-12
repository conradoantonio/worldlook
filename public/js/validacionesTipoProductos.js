/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar_producto = $("#guardar_categoria");
btn_enviar_producto.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#tipo_producto'), regExprTexto) == false ? inputs.push('Categoría') : ''
    validarArchivo($('input#foto_tipo_producto'), $('div#foto_tipo')) == false ? inputs.push('Imagen') : ''

    if (inputs.length == 0) {
        $('#guardar_categoria').hide();
        agregarTipoProducto();
    } else {
        $('#guardar_categoria').show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#tipo_producto" ).blur(function() {
    validarInput($(this), regExprTexto);
});


function validarInput (campo,regExpr) {
    if (!$(campo).val().match(regExpr)) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}

$('input#foto_tipo_producto').bind('change', function() {
    if ($(this).val() != '') {

        kilobyte = (this.files[0].size / 1024);
        mb = kilobyte / 1024;

        archivo = $(this).val();
        extension = archivo.split('.').pop().toLowerCase();

        if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
            swal({
                title: "Archivo no válido",
                text: "Debe seleccionar una imágen con formato jpg, jpeg o png, y debe pesar menos de 5MB",
                type: "error",
                closeOnConfirm: false
            });
        }
    }
});

function validarArchivo(campo, div) {
    archivo = $(campo).val();
    extension = archivo.split('.').pop().toLowerCase();

    if ($(div).is(":visible") && ($(campo).val() == '' || $(campo).val() == null)) {
        return true;
    } else if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}
/*Fin de código para validar el formulario de datos del usuario*/
