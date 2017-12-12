/*Código para validar el formulario de datos del usuario*/
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var inputs = [];
var msgError = '';
var regExprNombre = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_\s .]{2,50}$/i;
var regExprPass = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var btn_enviar_usuario_sistema = $("#guardar-datos-estilista");
btn_enviar_usuario_sistema.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#nombre'), regExprNombre) == false ? inputs.push('Nombre') : ''
    validarInput($('input#apellido'), regExprNombre) == false ? inputs.push('Apellido') : ''
    validarInput($('textarea#descripcion'), regExprTexto) == false ? inputs.push('Descripción') : ''
    validarArchivo($('input#foto_estilista')) == false ? inputs.push('Foto estilista') : ''
    validarInput($('input#correo'), regExprEmail) == false ? inputs.push('Correo') : ''
    validarInput($('input#password'), regExprPass) == false ? inputs.push('Contraseña') : ''


    if (inputs.length == 0) {
        $('#guardar-datos-estilista').hide();
        $('#guardar-datos-estilista').submit();
    } else {
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#nombre" ).blur(function() {
    validarInput($(this), regExprNombre);
});
$( "input#apellido" ).blur(function() {
    validarInput($(this), regExprNombre);
});
$( "textarea#descripcion" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#foto_estilista" ).blur(function() {
    validarArchivo($(this));
});
$( "input#correo" ).blur(function() {
    validarInput($(this), regExprEmail);
});
$( "input#password" ).blur(function() {
    validarInput($(this), regExprPass);
});


function validarInput (campo,regExpr) {
    if($('form#form_estilistas input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
        return true;
    } else if (!$(campo).val().match(regExpr)) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}

$('input#foto_estilista').bind('change', function() {
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
    if($('form#form_estilistas input#id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
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