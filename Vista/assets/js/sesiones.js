$(document).ready(function (){
    function CheckboxActa(){
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