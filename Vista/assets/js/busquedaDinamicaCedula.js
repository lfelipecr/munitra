$(document).ready(function (){
    $('#txtIdentificacion').on('keyup', function(){
        $('.form-control').removeAttr('readonly');
        $('.dataPersona').val('');
        let txtCedula = $('#txtIdentificacion').val().trim();
        $.ajax({
            url: "index.php?controlador=Usuario&metodo=BuscarCedula",
            type: "GET",
            data: { cedula: txtCedula },
            success: function (response) {
                console.log(response);                
                if (response != 'null'){
                    let json = JSON.parse(response, null, 2)
                    $('#tipo'+json['tipoId']).attr('selected','');

                    $('#distrito'+json['distrito']).attr('selected','');
                    $('#canton'+json['canton']).attr('selected','');
                    $('#provincia'+json['provincia']).attr('selected','');
                    
                    $('#slCanton').attr('readonly','');
                    $('#slDistrito').attr('readonly','');
                    $('#slProvincia').attr('readonly','');
                    
                    $('#txtTipoId').attr('readonly','');
                    $('#txtNombre').attr('readonly','');
                    $('#txtNombre').val(json['nombre']);
                    $('#txtApellido1').attr('readonly','');
                    $('#txtApellido1').val(json['apellido1']);
                    $('#txtApellido2').attr('readonly','');
                    $('#txtApellido2').val(json['apellido2']);
                    $('#txtDireccion').attr('readonly','');
                    $('#txtDireccion').val(json['direccion']);
                    $('#txtTelefono').attr('readonly','');
                    $('#txtTelefono').val(json['telefono']);
                    $('#txtWhatsapp').attr('readonly','');
                    $('#txtWhatsapp').val(json['whatsapp']);
                    $('#txtCorreo').attr('readonly','');
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