$(document).ready(function () {
    //Variable con el feedback del servidor
    let msg = $('#msg').val();
    //Valida que el servidor no haya dado ningún feedback
    if (msg != ''){
        $('#alerta').show();
        $('#alerta').html(msg);
    } else {
        $('#alerta').hide();
    }
    $('#frmIngresar').on('submit', function () {
        $('#alerta').show();
        if ($('#txtCorreo').val().trim() == '' ||
        $('#txtCorreo').val().trim() == ''){
            $('#alerta').html('Complete todos los datos');
            return false
        }
        return true;
    });
});