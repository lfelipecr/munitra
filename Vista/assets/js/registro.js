$(document).ready(function () {
    $('#frmIngresar').on('submit', function () {
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
        if ($('#txtPass1').val() == ''){
            $('#alerta').html('Debe proporcionar todos los datos marcados con asterisco');
            return false;
        } else 
        {
            if ($('#txtPass1').val() != $('#txtPass2').val()){
                $('#alerta').html('Las contraseñas no coinciden');
                return false;
            }
        }
        if ($('#txtNombreUsuario').val() == ''){
            let fecha = new Date();
            let nombreUsuario = $('#txtNombre').val().trim().charAt(0);
            nombreUsuario += $('#txtApellido1').val().trim();
            nombreUsuario += fecha.getDay()+'-'+fecha.getMonth()+'-'+fecha.getHours();
            $('#txtNombreUsuario').val(nombreUsuario);
        }
        return true;
    });
});