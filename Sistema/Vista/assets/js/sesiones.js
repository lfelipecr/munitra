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
    function CheckboxActa(){
        console.log($('#cbxActa').prop('checked'));
        if ($('#cbxActa').prop('checked')) {
            $('#valorActa').val('1');
        } else {
            $('#valorActa').val('0');
        }
    }
    CheckboxActa();
    $('#cbxActa').on('change', function () {
        CheckboxActa();
    });
    $('#frmSesion').on('submit', function (){
        $('#alerta').show();
        if ($('#txtDescripcion').val().trim() == '' || $('#ipFechaHora').val() == '')
        {
            $('#alerta').html('Debe proporcionar todos los datos marcados con asterisco (*)');
            return false;
        }
        return true;
    })
})