$(document).ready(function (){
    function RenderizarDatosJSON(){
        let datos = $('#jsonData').val();
        if (datos != ''){
            datos = JSON.parse(datos);
            console.log(datos);
            for (let i = 0; i < datos.length; i++)
            {
                switch  (datos[i][4]){
                    case '18':
                        $('#idDireccionPropiedad').val(datos[i][0]);
                        $('#direccionPropiedad').val(datos[i][1]);
                        break;
                    case '19':
                        $('#idDistrito').val(datos[i][0]);
                        $('#distrito'+datos[i][1]).attr('selected', '');
                        break;
                    case '20':
                        $('#idNumeroPlano').val(datos[i][0]);
                        $('#numeroPlano').val(datos[i][1]);
                        break;
                    case '21':
                        $('#idAreaPlano').val(datos[i][0]);
                        $('#areaPlano').val(datos[i][1]);
                        break;
                    case '22':
                        $('#idNumeroFinca').val(datos[i][0]);
                        $('#numeroFinca').val(datos[i][1]);
                        break;
                    case '23':
                        $('#idAreaRegistroPublico').val(datos[i][0]);
                        $('#areaRegistroPublico').val(datos[i][1]);
                        break;
                    case '24':
                        $('#idFrente').val(datos[i][0]);
                        $('#frente').val(datos[i][1]);
                        break;
                    case '25':
                        $('#idNumeroContrato').val(datos[i][0]);
                        $('#numeroContrato').val(datos[i][1]);
                        break;
                    case '26':
                        $('#idCartaDisponibilidad').val(datos[i][0]);
                        break;
                    case '27':
                        $('#idCroquis').val(datos[i][0]);
                        break;
                    case '28':
                        $('#idPlanoCorregido').val(datos[i][0]);
                        break;
                    case '29':
                        $('#idMinuta').val(datos[i][0]);
                        break;
                    case '30':
                        $('#idCartaMOPT').val(datos[i][0]);
                        break;
                    case '31':
                        $('#idFirma').val(datos[i][0]);
                        break;
                }
            }
        }
    }
    RenderizarDatosJSON();
    $('#frmVisado').on('submit', function (){
        $('#alerta').show();
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
        if ($('#direccionPropiedad').val().trim() == '' ||
        $('#numeroPlano').val().trim() == '' || $('#areaPlano').val().trim() == ''
        || $('#numeroFinca').val().trim() == '' || $('#areaRegistroPublico').val().trim() == ''
        || $('#frente').val().trim() == '' || $('#numeroContrato').val().trim() == ''){
            $('#alerta').html('Debe proporcionar todos los datos obligatorios, marcados con (*)');
            return false;
        }
        let dataURL = canvas.toDataURL("image/png");
        $("#firma").val(dataURL);
        return true;
    });
})