function ValidacionForm () {
    let usuario = {
        cedula: $('#cedula').val().trim(),
        nombre: $('#nombre').val().trim(),
        apellido1: $('#apellido1').val().trim(),
        apellido2: $('#apellido2').val().trim(),
    }
    let arr = Object.values(usuario)
    for (let i = 0; i < arr.length; i++)
    {
        if (arr[i] == '')
        {
            $('#alerta').show();
            $('#alerta').html('Llene todos los datos');
            return false;
        }
    }
    if (usuario.cedula.length != 9){
        $('#alerta').show();
        $('#alerta').html('Cédula no válida');
        return false;
    }
    return true;
}
$(document).ready(function () {
    $('#alerta').hide();
    let msg = $('#msg').val();

    if (msg != ''){
        $('#alerta').show();
        $('#alerta').html(msg);
    }
})
