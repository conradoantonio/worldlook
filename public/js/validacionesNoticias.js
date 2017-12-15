/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , % : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var btn_enviar_pregunta = $("#guardar_noticia");
btn_enviar_pregunta.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#titulo'), regExprTexto) == false ? inputs.push('Título') : ''
    validarInput($('textarea#mensaje'), regExprTexto) == false ? inputs.push('Mensaje') : ''
    validarArchivo($('input#foto'), $('div#foto')) == false ? inputs.push('Foto') : ''

    if (inputs.length == 0) {
        $(this).hide();
        $(this).submit();
    } else {
        $(this).show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#titulo" ).blur(function() {
    validarInput($(this), regExprTexto);
});

$( "textarea#mensaje" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "select#ayuda_menu_id" ).change(function() {
    validarSelect($(this));
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

$('input#foto').bind('change', function() {
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
