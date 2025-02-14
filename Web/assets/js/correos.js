function MostrarConversacion(){
    let consultas = $('#consultas').val();
    if (consultas != undefined){
        let respuestas = $('#respuestas').val();
        if (respuestas != ''){
            consultas = JSON.parse(consultas.replace(/[\u0000-\u001F\u007F]/g, ""));
            respuestas = JSON.parse(respuestas.replace(/[\u0000-\u001F\u007F]/g, ""));
            chat = [...consultas, ...respuestas];
            //ambito mostrar conversacion
            function getFecha(str) {
                const strFecha = str.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/);
                return strFecha ? new Date(strFecha[0]) : null;
            }

            chat.sort((a, b) => getFecha(a) - getFecha(b));
        } else {
            chat = JSON.parse(consultas.replace(/[\u0000-\u001F\u007F]/g, ""));
        }
        $('#bitacora').html('');
        for (let i = 0; i < chat.length; i++){
            let listado = $('#bitacora').html();
            datos = chat[i].split('-');
            listado +=`<div class="col-12 my-1">
                        <div class="card py-2 p-1 px-5 text-end">
                            <h6><strong>${datos[4]}</strong> - ${datos[1]} ${datos[2]} ${datos[3]}</h6>
                            <hr>
                            <p>${datos[0]}</p>
                        </div>
                    </div>`;
            $('#bitacora').html(listado);
        }
    }
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
                //location.reload();
            });
            $('#txtCuerpo').val('');
        }
    });
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
    });
    MostrarConversacion();
});