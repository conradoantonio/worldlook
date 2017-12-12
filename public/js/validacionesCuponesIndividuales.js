/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ % ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprDate = /^\d{4}-\d{2}-\d{2}$/i;
var regExprNum = /^[\d .]{1,2}$/i;
var regExprNumOpc = /^([\d .]{1,2})?$/i;
//\d{0,2}(\.\d{1,2})?
var btn_enviar_producto = $("#guardar_cupon");
btn_enviar_producto.on('click', function() {
    inputs = [];
    msgError = '';

    validarSelect($('select#factor_id')) == false ? inputs.push('Factor') : ''
    validarInput($('input#cantidad_servicios'), regExprNum) == false ? inputs.push('Cantidad servicios') : ''
    validarInput($('input#cantidad_productos'), regExprNum) == false ? inputs.push('Cantidad productos') : ''
    validarInput($('input#porcentaje'), regExprNum) == false ? inputs.push('Porcentaje') : ''
    validarSelect($('select#usuario_id')) == false ? inputs.push('Usuario id') : ''
    validarInput($('input#fecha_inicio'), regExprDate) == false ? inputs.push('Fecha inicio') : ''
    validarInput($('input#fecha_final'), regExprDate) == false ? inputs.push('Fecha límite') : ''
    validarInput($('textarea#descripcion'), regExprTexto) == false ? inputs.push('Descripción') : ''

    if (inputs.length == 0) {
        $('#guardar_cupon').hide();
        $('#guardar_cupon').submit();
    } else {
        $('#guardar_cupon').show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "select#factor_id" ).change(function() {
    validarSelect($(this));
});
$( "input#cantidad_servicios" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#cantidad_productos" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#porcentaje" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "select#usuario_id" ).change(function() {
    validarSelect($(this));
});
$( "input#fecha_inicio" ).blur(function() {
    validarInput($(this), regExprDate);
});
$( "input#fecha_final" ).blur(function() {
    validarInput($(this), regExprDate);
});
$( "textarea#descripcion" ).blur(function() {
    validarInput($(this), regExprTexto);
});

function validarInput (campo,regExpr) {
    if (!$(campo).is(":visible")) {
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
