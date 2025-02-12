$(document).ready(function (){
    let intentos = 0;
    let captcha = '';
    $('#btnEnviarCaptcha').on('click', function(){
        $('#btnEnviarCorreo').show();
        $('#captchaInput').val('');
        $('#catpchaInfo').html('Ingrese el siguiente código para enviar su consulta:');
        $('#captchaInput').removeAttr('disabled');
        captchaGenerado = Math.random().toString(36).substring(2, 8).toUpperCase();
        captcha = captchaGenerado;
        document.getElementById("captchaText").innerText = captchaGenerado;
    });
    $('#btnEnviarCorreo').on('click', function(){
        let enviado = localStorage.getItem('solicitudEnviada');
        if (enviado != true){
            let captchaGenerado = $('#captchaInput').val();
            if (captcha == captchaGenerado){
                if ($('#identificacionConsulta').val().trim() != '' && $('#nombreConsulta').val().trim() != '' &&
                $('#telefonoConsulta').val().trim() != '' && $('#correoConsulta').val().trim() != '' &&
                $('#asuntoConsulta').val().trim() != '' && $('#cuerpoConsulta').val().trim() != '')
                {
                    $.ajax({
                        url: "index.php?controlador=Consulta&metodo=EnviarConsulta",
                        type: "POST",
                        data: {
                            identificacion: $('#identificacionConsulta').val().trim(),
                            nombreCompleto: $('#nombreConsulta').val().trim(),
                            telefono: $('#telefonoConsulta').val().trim(),
                            correo: $('#correoConsulta').val().trim(),
                            asunto: $('#asuntoConsulta').val().trim(),
                            consulta: $('#cuerpoConsulta').val().trim(),
                            idConsultado: $('#idConsultado').val()
                        },
                        success: function (response) {
                            $('#identificacionConsulta').val('');
                            $('#nombreConsulta').val('');
                            $('#telefonoConsulta').val('');
                            $('#correoConsulta').val('');
                            $('#asuntoConsulta').val('');
                            $('#cuerpoConsulta').val('');
                            $('#idConsultado').val('');
                            if (response == '0'){
                                $('#catpchaInfo').html('Si tiene una solicitud registrada, no puede generar una nueva!');
                                document.getElementById("captchaText").innerText = '';
                                $('#captchaInput').val('');
                                $('#captchaInput').attr('disabled', '');
                            } else {
                                let solicitudEnviada = true;
                                localStorage.setItem('solicitudEnviada', true);
                                $('#btnEnviarCaptcha').hide();
                                $('#btnEnviarCorreo').hide();
                                $('#titulo').html('Solicitud Enviada!');
                                $('#infoModal').html('<span>Su solicitud ha sido enviada y su código de solicitud es: '+response+'.<br><strong>No envíe más solicitudes!</strong> La respuesta a su consulta llegará a su whatsapp y correo electrónico, agradecemos su paciencia</span>');
                                console.log(response);
                            }
                        },
                        error: function (xhr, status, error) {
                            
                            console.error("Error en la petición:", error);
                        }
                    });
                } else {
                    $('#catpchaInfo').html('No puede dejar datos en blanco!');
                    document.getElementById("captchaText").innerText = '';
                    $('#captchaInput').attr('disabled', '');
                }
            } else {
                intentos++;
                $('#catpchaInfo').html('Su código no es correcto, ingrese este nuevo código:');
                captchaGenerado = Math.random().toString(36).substring(2, 8).toUpperCase();
                captcha = captchaGenerado;
                document.getElementById("captchaText").innerText = captchaGenerado;
            }
        } else {
            $('#catpchaInfo').html('No puede dejar datos en blanco!');
            document.getElementById("captchaText").innerText = '';
            $('#captchaInput').attr('disabled', '');
        }
    });
});