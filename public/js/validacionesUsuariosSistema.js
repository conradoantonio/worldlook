/*Código para validar el formulario de datos del usuario*/
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var inputs = [];
var msgError = '';
var regExprNombre = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_\s .]{2,50}$/i;
var regExprUser = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var btn_enviar_usuario_sistema = $("#guardar-usuario-sistema");
btn_enviar_usuario_sistema.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#user_name'), regExprUser) == false ? inputs.push('Usuario') : ''
    validarInput($('input#password'), regExprUser) == false ? inputs.push('Contraseña') : ''
    validarInput($('input#email'), regExprEmail) == false ? inputs.push('Email') : ''
    validarArchivo($('input#foto_usuario')) == false ? inputs.push('Imagen Festividad') : ''

    if (inputs.length == 0) {
        $('#guardar-usuario-sistema').hide();
        $('#guardar-usuario-sistema').submit();
    } else {
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#user_name" ).blur(function() {
    validarInput($(this), regExprUser);
});
$( "input#password" ).blur(function() {
    validarInput($(this), regExprUser);
});
$( "input#email" ).blur(function() {
    validarInput($(this), regExprEmail);
});


function validarInput (campo,regExpr) {
    if($('form#form_usuario_sistema input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
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

$('input#foto_usuario').bind('change', function() {
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

    if ($(campo).val() == '' || $(campo).val() == null) {
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