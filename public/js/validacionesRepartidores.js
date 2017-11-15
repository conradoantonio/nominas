/*Código para validar el formulario de datos del usuario*/
mb = 0;
extensionesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];//Mix
var inputs = [];
var msgError = '';
var regExprNombre = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_\s .]{2,50}$/i;
var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var regExprNum = /^[0-9]{1,18}$/;
var regExprCel = /^[ () \- + \d \s]{1,24}$/;
var btn = $("#guardar-datos-repartidor");
btn.on('click', function() {
    inputs = [];
    msgError = '';

    !validarInput($('input#password'), regExprNombre) ? inputs.push('\n Contraseña') : ''
    !validarInput($('input#nombre'), regExprNombre) ? inputs.push('\n Nombre') : ''
    !validarInput($('input#apellido'), regExprNombre) ? inputs.push('\n Apellido') : ''
    !validarInput($('input#correo'), regExprEmail) ? inputs.push('\n Correo') : ''
    !validarInput($('input#celular'), regExprCel) ? inputs.push('\n Celular') : ''
    !validarArchivo($('input#comprobante_domicilio')) ? inputs.push('\n Comprobante de domicilio') : ''
    !validarArchivo($('input#licencia')) ? inputs.push('\n Licencia') : ''
    !validarArchivo($('input#solicitud_trabajo')) ? inputs.push('\n Solicitud de trabajo') : ''
    !validarArchivo($('input#credencial_elector')) ? inputs.push('\n Credencial de elector') : ''

    if (inputs.length == 0) {
        console.log(inputs)
        btn.children('i').show();
        btn.attr('disabled', true);
        guardarRepartidor(btn);
    }
    else {
        console.log(inputs)
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

$('input#comprobante_domicilio, input#licencia, input#solicitud_trabajo, input#credencial_elector').bind('change', function() {
    if ($(this).val() != '') {
        checkInfoFile($(this), extensionesPermitidas);
    }
});

function validarInput (campo,regExpr) {
    if($('form#form_repartidores input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
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


function validarArchivo(campo) {
    /*Si el campo está vacío y es un edit entonces está correcto*/
    if ($('form#form_repartidores input#user_id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
        return true;
    }
    else if ($('form#form_repartidores input#user_id').val() == '' && ($(campo).val() == '' || $(campo).val() == null)) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    }
    else if (($('form#form_repartidores input#user_id').val() == '' || $('form#form_repartidores input#user_id').val() != '') && $(campo).val() != '') {
        console.info(campo[0].files[0].size);
        var archivo = $(campo).val();
        var extension = archivo.split('.').pop().toLowerCase();
        var kilobyte = (campo[0].files[0].size / 1024);
        var mb = kilobyte / 1024;
        if ($.inArray(extension, extensionesPermitidas) == -1 || mb >= 5) {
            $(campo).parent().addClass("has-error");
            msgError = msgError + $(campo).parent().children('label').text() + '\n';
        }
        else {
            $(campo).parent().removeClass("has-error")
        }
        return $.inArray(extension, extensionesPermitidas) == -1 || mb >= 5 ? false : true;
    }
    console.warn('no debió llegar hasta aquí');
    return false;
}

function checkInfoFile(campo, extensions_permited) {
    console.info(campo[0].files[0].size)
    var kilobyte = (campo[0].files[0].size / 1024);
    var mb = kilobyte / 1024;

    var archivo = $(campo).val();
    var extension = archivo.split('.').pop().toLowerCase();

    if ($.inArray(extension, extensions_permited) == -1 || mb >= 5) {
        swal({
            title: "Archivo no válido",
            text: "Debe seleccionar una imagen con formato jpg, jpeg, png o pdf y debe pesar menos de 5MB",
            type: "error",
            closeOnConfirm: false
        });
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error")
        return true;
    }
}
/*Fin de código para validar el formulario de datos del usuario*/
