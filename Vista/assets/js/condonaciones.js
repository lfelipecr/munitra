$(document).ready(function () {
    $('#pagoContado').hide();
    $('#pagoArreglo').hide();
    $('#prevencion').hide();
    function CheckboxCumple(){
        if ($('#cbxCumple').prop('checked')) {
            $('#valorCumple').val('1');
        } else {
            $('#valorCumple').val('0');
        }
    }
    function RenderizarDatosJSON(){
        let datos = $('#jsonData').val();
        if (datos != ''){
            datos = JSON.parse(datos);
            let html;
            for (let i = 0; i < datos.length; i++)
            {
                switch  (datos[i][4]){
                    case '32':
                        $('#idRepresentante').val(datos[i][0]);
                        $('#txtRepresentante').val(datos[i][1]);
                        break;
                    case '33':
                        $('#idIdentificacionRepresentante').val(datos[i][0]);
                        $('#txtIdentificacionRepresentante').val(datos[i][1]);
                        break;
                    case '34':
                        $('#idDireccion').val(datos[i][0]);
                        $('#txtDireccion').val(datos[i][1]);
                        break;
                    case '35':
                        $('#idNotificaciones').val(datos[i][0]);
                        $('#txtNotificaciones').val(datos[i][1]);
                        break;
                    case '36':
                        $('#idTipoSolicitud').val(datos[i][0]);
                        html = '';
                        if (datos[i][1] == 'Pago de contado'){
                            html = '<option selected="" value="Pago de contado" id="contadoOpcion">Pago de contado</option><option value="Arreglo de pago" id="arregloOpcion">Arreglo de pago</option>'
                        } else {
                            html = '<option value="Pago de contado" id="contadoOpcion">Pago de contado</option><option value="Arreglo de pago" selected="" id="arregloOpcion">Arreglo de pago</option>'
                        }
                        $('#tipoSolicitud').html(html);
                        break;
                    case '37':
                        $('#idFirma').val(datos[i][0]);
                        if (document.getElementById('firmaCredenciales')){
                            document.getElementById('firmaCredenciales').src = datos[i][1];
                        }
                        break;
                    case '38':
                        $('#idRecibido').val(datos[i][0]);
                        $('#txtRecibido').val(datos[i][1]);
                        console.log(datos[i]);
                        break;
                    case '39':
                        $('#idFecha').val(datos[i][0]);
                        $('#fecha').val(datos[i][1]);
                        break;
                    case '40':
                        id = datos[i][1].replaceAll(' ','_');
                        $('#idFuncionario').val(datos[i][0]);
                        if ('#'+id != '#'){
                            $('#'+id).attr('selected', '');
                        }
                        break;
                    case '41':
                        $('#idConsecutivo').val(datos[i][0]);
                        $('#consecutivo').val(datos[i][1]);
                        break;
                    case '42':
                        $('#idTotalContado').val(datos[i][0]);
                        $('#totalContado').val(datos[i][1]);
                        break;
                    case '43':
                        $('#idMontoCondonarContado').val(datos[i][0]);
                        $('#montoCondonarContado').val(datos[i][1]);
                        break;
                    case '44':
                        $('#idFechaPago').val(datos[i][0]);
                        $('#fechaPago').val(datos[i][1]);
                        break;
                    case '45':
                        $('#idTotalArreglo').val(datos[i][0]);
                        $('#totalArreglo').val(datos[i][1]);
                        break;
                    case '46':
                        $('#idMontoCondonarArreglo').val(datos[i][0]);
                        $('#montoCondonarArreglo').val(datos[i][1]);
                        break;
                    case '47':
                        $('#idFechaInicio').val(datos[i][0]);
                        $('#fechaInicio').val(datos[i][1]);
                        break;
                    case '48':
                        $('#idPlazoMeses').val(datos[i][0]);
                        $('#plazoMeses').val(datos[i][1]);
                        break;
                    case '49':
                        $('#idCantidadCuotas').val(datos[i][0]);
                        $('#cantidadCuotas').val(datos[i][1]);
                        break;
                    case '50':
                        $('#idAdelanto').val(datos[i][0]);
                        $('#adelanto').val(datos[i][1]);
                        break;
                    case '51':
                        $('#idPagoPorCuota').val(datos[i][0]);
                        $('#pagoPorCuota').val(datos[i][1]);
                        break;
                    case '52':
                        $('#idResolucion').val(datos[i][0]);
                        html = '';
                        if (datos[i][1] == 'Prevención'){
                            html = '<option value="Aprobación">Aprobación</option><option value="Denegatoria">Denegatoria</option><option selected value="Prevención" id="opcionPrevencion">Prevención</option>';
                        } else if (datos[i][1] == 'Denegatoria'){
                            html = '<option value="Aprobación">Aprobación</option><option selected value="Denegatoria">Denegatoria</option><option value="Prevención" id="opcionPrevencion">Prevención</option>';
                        } else {
                            html = '<option selected value="Aprobación">Aprobación</option><option value="Denegatoria">Denegatoria</option><option value="Prevención" id="opcionPrevencion">Prevención</option>';
                        }
                        $('#resolucion').html(html);
                        break;
                    case '53':
                        $('#idPlazo').val(datos[i][0]);
                        $('#plazo').val(datos[i][1]);
                        break;
                    case '54':
                        $('#idFechaNotificacion').val(datos[i][0]);
                        $('#fechaNotificacion').val(datos[i][1]);
                        break;
                    case '55':
                        $('#idCumple').val(datos[i][0]);
                        $('#valorCumple').val(datos[i][1]);
                        break;
                }
            }
        }
    }
    function Resolucion(){
        if ($('#opcionPrevencion').is(':selected')){
            $('#prevencion').show();
        } else {
            $('#prevencion').hide();
        }
    }
    function TipoSolicitud(){
        if ($('#contadoOpcion').is(':selected')){
            $('#pagoContado').show();
            $('#pagoArreglo').hide();
        } else {
            $('#pagoContado').hide();
            $('#pagoArreglo').show();
        }
    }
    RenderizarDatosJSON();
    CheckboxCumple();
    Resolucion();
    TipoSolicitud();
    $('#cbxCumple').on('change', function (){
        CheckboxCumple();
    });
    $('#resolucion').on('change', function(){
        Resolucion();
    });
    $('#tipoSolicitud').on('change', function(){
        TipoSolicitud();
    });

    $('#frmCondonacion').on('submit', function () {
        $('#alerta').show();
        if ($('#txtNombre').length){
            //Datos obligatorios
            if ($('#txtNombre').val().trim() == '' || $('#txtApellido1').val().trim() == '' 
            || $('#txtDireccion').val().trim() == '' || $('#txtIdentificacion').val() == ''){
                $('#alerta').html('Debe proporcionar todos los datos marcados con asterisco (*)');
                return false;
            }
            //Info de contacto 
            //Debe llenar al menos un teléfono
            if ($('#txtTelefono').val().trim() == '' && $('#txtWhatsapp').val().trim() == ''){
                $('#alerta').html('Debe llenar al menos uno de los dos teléfonos');
                return false;
            }
            //Correo
            if (!$('#txtCorreo').val().trim().includes('@') 
            || !$('#txtCorreo').val().trim().includes('.')){
                $('#alerta').html('Debe verificar el correo');
                return false;
            }
        }
        //datos obligatorios
        if ($('#txtRepresentante').val().trim() == '' || $('#txtIdentificacionRepresentante').val().trim() == '' ||
        $('#txtDireccion').val().trim() == '' || $('#txtRecibido').val().trim() == '')
        {
            $('#alerta').html('Debe proporcionar todos los datos obligatorios, marcados con (*)');
            return false;
        }
        if ($('#usuarioTipo').val() != 'externo'){
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
                //borra los campos no necesarios para la solicitud
                $('#totalArreglo').val('');
                $('#montoCondonarArreglo').val('');
                $('#plazoMeses').val('');
                $('#cantidadCuotas').val('');
                $('#adelanto').val('');
                $('#pagoPorCuota').val('');
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
                //borra los campos no necesarios para la solicitud
                $('#totalContado').val('');
                $('#montoCondonarContado').val('');
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
        }        
        let dataURL = canvas.toDataURL("image/png");
        $("#firma").val(dataURL);
        return true;
    });
    $('#slFuncionarios').select2();
    let estado = $('#idEstado').val();
    $('#estado'+estado).attr('selected', '');
})