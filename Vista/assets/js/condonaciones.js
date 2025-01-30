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
        $('#alerta').show();
        //datos obligatorios
        if ($('#txtRepresentante').val().trim() == '' || $('#txtIdentificacionRepresentante').val().trim() == '' ||
        $('#txtDireccion').val().trim() == '' || $('#txtRecibido').val().trim() == '' 
        || $('#consecutivo').val().trim() == '')
        {
            $('#alerta').html('Debe proporcionar todos los datos obligatorios, marcados con (*)');
            return false;
        }
        if ($('#contadoOpcion').is(':selected')){
            if ($('#totalContado').val().trim() == '' || $('#montoCondonarContado').val().trim() == '')
            {
                $('#alerta').html('Debe proporcionar todos los datos obligatorios para pago de contado');
                return false;
            }
            else if (Number($('#totalContado').val()) < 1 || Number($('#montoCondonarContado').val()) < 1)
            {
                $('#alerta').html('Los montos no son válidos');
                return false;
            }
        } else {
            if ($('#totalArreglo').val().trim() == '' || 
                $('#montoCondonarArreglo').val().trim() == '' ||
                $('#plazoMeses').val().trim() == '' ||
                $('#cantidadCuotas').val().trim() == '' ||
                $('#adelanto').val().trim() == '' ||
                $('#pagoPorCuota').val().trim() == '')
            {
                $('#alerta').html('Debe proporcionar todos los datos obligatorios para acuerdo de pago');
                return false;                
            }
            else if (Number($('#totalArreglo').val()) < 1 || 
                Number($('#montoCondonarArreglo').val()) < 1 ||
                Number($('#plazoMeses').val()) < 1 ||
                Number($('#cantidadCuotas').val()) < 1 ||
                Number($('#adelanto').val()) < 1 ||
                Number($('#pagoPorCuota').val()) < 1)
            {
                $('#alerta').html('Los montos no son válidos');
                return false;
            }
        }
        if ($('#opcionPrevencion').is(':selected')){
            if ($('#plazo').val().trim() == ''){
                $('#alerta').html('Debe proporcionar todos los datos obligatorios para acuerdo de pago');
                return false;
            } else if (Number($('#plazo').val()) < 1){
                $('#alerta').html('El plazo de prevención no es válido');
                return false;
            }
        }
        let dataURL = canvas.toDataURL("image/png");
        $("#firma").val(dataURL);
        return true;
    });
    $('#slFuncionarios').select2();
})