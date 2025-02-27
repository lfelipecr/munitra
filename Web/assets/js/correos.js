function EnviarCaptcha(){
    $('#btnEnviarCorreo').show();
    $('#captchaInput').val('');
    $('#catpchaInfo').html('Ingrese el siguiente código para enviar su consulta:');
    $('#captchaInput').removeAttr('disabled');
    captchaGenerado = Math.random().toString(36).substring(2, 8).toUpperCase();
    captcha = captchaGenerado;
    document.getElementById("captchaText").innerText = captchaGenerado;
}
$(document).ready(function (){
    let intentos = 0;
    let captcha = '';
    $('#btnActualizar').on('click', function () {
        if ($('#cuerpoConsulta').val().trim() != ''){
            let idConsulta = $('#idConsulta').val();
            let cuerpo = $('#cuerpoConsulta').val();
            $.ajax({
                url: "index.php?controlador=Consulta&metodo=ActualizarConsulta",
                type: "POST",
                data: { idConsulta: idConsulta,
                        consulta: cuerpo
                 },
                success: function (response) {
                    //ajax whatsapp api
                    //render
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error("Error en la petición:", error);
                }
            }).then(function () {
                location.reload();
            });
            $('#txtCuerpo').val('');
        }
    });
    $('#btnEnviarCaptcha').on('click', function(){
        EnviarCaptcha();
    });
    $('#btnEnviarCorreo').on('click', function(){
        let captchaGenerado = $('#captchaInput').val();
        if (captcha == captchaGenerado){
            let tipo = $('#tipoConsulta').val(); 
            if ($('#identificacionConsulta').val().trim() != '' && $('#nombreConsulta').val().trim() != '' &&
            $('#telefonoConsulta').val().trim() != '' && $('#correoConsulta').val().trim() != '' &&
            $('#asuntoConsulta').val().trim() != '' && $('#cuerpoConsulta').val().trim() != '')
            {
                let formData = new FormData();
                formData.append("identificacion", $('#identificacionConsulta').val().trim());
                formData.append("nombreCompleto", $('#nombreConsulta').val().trim());
                formData.append("telefono", $('#telefonoConsulta').val().trim());
                formData.append("correo", $('#correoConsulta').val().trim());
                formData.append("asunto", $('#asuntoConsulta').val().trim());
                formData.append("consulta", $('#cuerpoConsulta').val().trim());
                formData.append("idConsultado", $('#idConsultado').val());
                formData.append("tipo", tipo);
                let archivos = document.getElementById("idAdjuntos").files;
                for (let i = 0; i < archivos.length; i++) {
                    formData.append("adjuntos[]", archivos[i]);
                }
                $.ajax({
                    url: "index.php?controlador=Consulta&metodo=EnviarConsulta",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData:false,
                    success: function (response) {
                        console.log(response);
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
                            $('#infoModal').html('<span>Su solicitud ha sido enviada y su código de solicitud es: '+response+'.<br>La respuesta a su consulta llegará a su whatsapp o correo electrónico, agradecemos su paciencia</span>');
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
    });
});