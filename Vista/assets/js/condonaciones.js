$(document).ready(function () {
    $('#pagoContado').show();
    $('#pagoArreglo').hide();
    $('#prevencion').hide();
    function CheckboxCumple(){
        if ($('#cbxCumple').prop('checked')) {
            $('#valorCumple').val('1');
        } else {
            $('#valorCumple').val('0');
        }
    }
    CheckboxCumple();
    $('#cbxCumple').on('change', function (){
        CheckboxCumple();
    });
    $('#resolucion').on('change', function(){
        if ($('#opcionPrevencion').is(':selected')){
            $('#prevencion').show();
        } else {
            $('#prevencion').hide();
        }
    });
    $('#tipoSolicitud').on('change', function(){
        if ($('#contadoOpcion').is(':selected')){
            $('#pagoContado').show();
            $('#pagoArreglo').hide();
        } else {
            $('#pagoContado').hide();
            $('#pagoArreglo').show();
        }
    });
    $('#frmCondonacion').on('submit', function () {
        return true;
    });
    $('#slFuncionarios').select2();
})