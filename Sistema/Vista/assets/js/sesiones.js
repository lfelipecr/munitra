$(document).ready(function (){
    //Variable con el feedback del servidor
    let msg = $('#msg').val();
    //Valida que el servidor no haya dado ningún feedback
    if (msg != ''){
        $('#alerta').show();
        $('#alerta').html(msg);
    } else {
        $('#alerta').hide();
    }
    $('#slAsistentes').select2();
})