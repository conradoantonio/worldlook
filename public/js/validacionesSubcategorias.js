/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTextoLimite = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ % ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,50}$/i;
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ % ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprDate = /^\d{4}-\d{2}-\d{2}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar_producto = $("#guardar_subcategoria");
btn_enviar_producto.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#nombre_subcategoria'), regExprTextoLimite) == false ? inputs.push('Nombre subcategoría') : ''
    validarSelect($('select#menu_id')) == false ? inputs.push('Menu') : ''
    validarSelect($('select#categoria_id')) == false ? inputs.push('categoría') : ''
    validarInput($('textarea#descripcion'), regExprTexto) == false ? inputs.push('Descripción') : ''
    validarArchivo($('input#foto_subcategoria')) == false ? inputs.push('Foto') : ''

    if (inputs.length == 0) {
        $(this).hide();
        $(this).submit();
    } else {
        $(this).show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#nombre_subcategoria" ).blur(function() {
    validarInput($(this), regExprTextoLimite);
});
$( "select#menu_id" ).change(function() {
    validarSelect($(this));
});
$( "select#categoria_id" ).change(function() {
    validarSelect($(this));
});
$( "textarea#descripcion" ).blur(function() {
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

function validarSelect (select) {
    if ($(select).val() == '0' || $(select).val() == '' || $(select).val() == null) {
        $(select).parent().addClass("has-error");
        msgError = msgError + $(select).parent().children('label').text() + '\n';
        return false;
    } else {
        $(select).parent().removeClass("has-error");
        return true;
    }
}

$('input#foto_subcategoria').bind('change', function() {
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

function validarArchivo(campo) {
    archivo = $(campo).val();
    extension = archivo.split('.').pop().toLowerCase();
    if($('form#form_subcategoria input#id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
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