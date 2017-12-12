/*Código para validar el formulario de datos del usuario*/
var inputs = [];
var msgError = '';
var regExprNombre = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_\s .]{2,50}$/i;
var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var regExprNum = /^[0-9]{1,18}$/;
var regExprCel = /^[ () \- + \d \s]{1,24}$/;
var regExprFecha = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
var btn_enviar_usuario_app = $("#guardar-datos-usuario");
btn_enviar_usuario_app.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#password'), regExprNombre) == false ? inputs.push('Password') : ''
    validarInput($('input#nombre'), regExprNombre) == false ? inputs.push('Nombre') : ''
    validarInput($('input#apellido'), regExprNombre) == false ? inputs.push('Apellido') : ''
    validarInput($('input#correo'), regExprEmail) == false ? inputs.push('Correo') : ''
    validarInput($('input#celular'), regExprCel) == false ? inputs.push('Celular') : ''

    if (inputs.length == 0) {
        $('#guardar-datos-usuario').hide();
        $('#guardar-datos-usuario').submit();
    }
    else {
        $('#guardar-datos-usuario').show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#password" ).blur(function() {
    validarInput($(this), regExprNombre);
});
$( "input#nombre" ).blur(function() {
    validarInput($(this), regExprNombre);
});
$( "input#apellido" ).blur(function() {
    validarInput($(this), regExprNombre);
});
$( "input#correo" ).blur(function() {
    validarInput($(this), regExprEmail);
});
$( "input#celular" ).blur(function() {
    validarInput($(this), regExprCel);
});

function validarInput (campo,regExpr) {
    if($('form#form_usuarios_app input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
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
/*Fin de código para validar el formulario de datos del usuario*/
