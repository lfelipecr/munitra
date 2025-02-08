$(document).ready(function (){
    $('#txtIdentificacion').on('keyup', function(){
        let txtCedula = $('#txtIdentificacion').val().trim();
        $.ajax({
            url: "index.php?controlador=Usuario&metodo=BuscarCedula",
            type: "GET",
            data: { cedula: txtCedula },
            success: function (response) {
                $('.form-control').removeAttr('disabled');
                $('.dataPersona').val('');
                if (response != 'null'){
                    let json = JSON.parse(response, null, 2)
                    $('#tipo'+json['tipoId']).attr('selected','');

                    $('#distrito'+json['distrito']).attr('selected','');
                    $('#canton'+json['canton']).attr('selected','');
                    $('#provincia'+json['provincia']).attr('selected','');
                    
                    $('#slCanton').attr('disabled','');
                    $('#slDistrito').attr('disabled','');
                    $('#slProvincia').attr('disabled','');
                    
                    $('#txtTipoId').attr('disabled','');
                    $('#txtNombre').attr('disabled','');
                    $('#txtNombre').val(json['nombre']);
                    $('#txtApellido1').attr('disabled','');
                    $('#txtApellido1').val(json['apellido1']);
                    $('#txtApellido2').attr('disabled','');
                    $('#txtApellido2').val(json['apellido2']);
                    $('#txtDireccion').attr('disabled','');
                    $('#txtDireccion').val(json['direccion']);
                    $('#txtTelefono').attr('disabled','');
                    $('#txtTelefono').val(json['telefono']);
                    $('#txtWhatsapp').attr('disabled','');
                    $('#txtWhatsapp').val(json['whatsapp']);
                    $('#txtCorreo').attr('disabled','');
                    $('#txtCorreo').val(json['correo']);
                    console.log(json);
                }                
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    });
});