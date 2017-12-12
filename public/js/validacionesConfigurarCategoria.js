/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar = $("#guardar_categoria");
btn_enviar.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#categoria_tipo'), regExprTexto) == false ? inputs.push('Tipo categoria') : ''
    validarInput($('input#precio'), regExprNum) == false ? inputs.push('Precio') : ''
    validarInput($('input#tiempo_minimo'), regExprNum) == false ? inputs.push('Tiempo mínimo') : ''
    validarInput($('input#tiempo_maximo'), regExprNum) == false ? inputs.push('Tiempo máximo') : ''

    if (inputs.length == 0) {
        $(this).find('i').show(); $(this).attr('disabled', true);
        actualizarMenuCategorias($(this));
        //$('#guardar_categoria').hide();
    } else {
        $('#guardar_categoria').show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#categoria_tipo" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#precio" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#tiempo_minimo" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#tiempo_maximo" ).blur(function() {
    validarInput($(this), regExprNum);
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
