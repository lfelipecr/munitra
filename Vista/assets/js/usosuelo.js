$(document).ready(function (){
    function RenderizarDatosJSON(){
        let datos = $('#jsonData').val();
        if (datos != ''){
            datos = JSON.parse(datos);
            for (let i = 0; i < datos.length; i++)
            {
                switch  (datos[i][4]){
                    case '10':
                        $('#idDistrito').val(datos[i][0]);
                        $('#distrito'+datos[i][1]).attr('selected', '');
                        break;
                    case '11':
                        $('#idDireccionPropiedad').val(datos[i][0]);
                        $('#txtDireccionPropiedad').val(datos[i][1]);
                        break;
                    case '12':
                        $('#idFinca').val(datos[i][0]);
                        $('#txtFinca').val(datos[i][1]);
                        break;
                    case '13':
                        $('#idPlano').val(datos[i][0]);
                        $('#txtPlano').val(datos[i][1]);
                        break;
                    case '14':
                        $('#idMotivoUso').val(datos[i][0]);
                        break;
                    case '15':
                        $('#idUsoSolicitado').val(datos[i][0]);
                        $('#txtUsoSolicitado').val(datos[i][1]);
                        break;
                    case '16':
                        $('#idPlanoCatastro').val(datos[i][0]);
                        break;
                    case '17':
                        $('#idDigital').val(datos[i][0]);
                        $('#valorDigital').val(datos[i][1]);
                        break;
                }
            }
        }
    }

    function CheckboxDigital(){
        if ($('#cbxDigital').prop('checked')) {
            $('#valorDigital').val('1');
        } else {
            $('#valorDigital').val('0');
        }
    }
    RenderizarDatosJSON();
    CheckboxDigital();
    $('#cbxDigital').on('change', function (){
        CheckboxDigital();
    })
    $('#frmUsoSuelo').on('submit', function (){
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
        if ($('#txtDireccionPropiedad').val().trim() == '' ||
        $('#txtUsoSolicitado').val().trim() == '' || $('#txtPlano').val().trim() == ''
        || $('#txtPlano').val().trim() == ''){
            $('#alerta').html('Debe proporcionar todos los datos obligatorios, marcados con (*)');
            return false;
        }
        return true;
    });
    let estado = $('#idEstado').val();
    $('#estado'+estado).attr('selected', '');
})