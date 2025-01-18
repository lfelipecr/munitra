$(document).ready(function () {
    $('#alerta').hide();
    window.setInterval(function(){
        $('#alerta').hide();
      }, 5000);      
    let data = JSON.parse($("#data").val());

    $('#buscar').on('click', function () {
        $('#alerta').show();
        let invitacion = $('#invitacion').val().trim();
        let cedula = $('#cedula').val().trim();
        if (invitacion == "" && cedula == "" || parseInt(invitacion) < 1){
            $('#alerta').html('<span>Ha habido un error</span>');
        } else {
            let valido = false;
            let index = 0;
            let buscar = '';
            let result = 0;
            if (invitacion == ""){
                buscar = cedula;
                index = 6;
                result = 0;
            } else {
                buscar = invitacion;
                index = 0;
                result = 6;
            }
            data.forEach(dato => {
                if (dato[index] == buscar){
                    $('#alerta').show();
                    if (invitacion != "" && cedula != "")
                    {
                        if (dato[index] == invitacion && dato[result] == cedula)
                            $('#alerta').html('<span>Los datos coinciden</span>');
                        else 
                            $('#alerta').html('<span>Los datos no coinciden</span>');
                    } else {
                        $('#alerta').html(dato[result]);
                        let html = $('#alerta').html();
                        if (dato[7] == '1'){
                            $('#alerta').html(html + '<span>Ticket aceptado<span>');    
                        } else {
                            $('#alerta').html(html + '<span>Ticket no aceptado<span>');    
                        }
                    }
                    valido = true;
                }
            });
            if (!valido)
                $('#alerta').html('<span>No se encuentra</span>');
        }
    })

    function Renderizar () {
        let cuerpoAceptados = '';
        let cuerpoNoAceptados = '';
        data.forEach(dato => {
            if (dato[7] == '1'){
                cuerpoAceptados += `<tr onclick="window.location.href='index.php?controlador=Usuario&metodo=RevertirTicket&id=${dato[0]}'">
                    <td>${dato[0]}</td>
                    <td>${dato[6]}</td>
                    <td>${dato[1]} ${dato[2]} ${dato[3]}</td>
                </tr>`;
            } else {
                cuerpoNoAceptados += `<tr onclick="window.location.href='index.php?controlador=Usuario&metodo=ValidarAsistencia&id=${dato[0]}'">
                    <td>${dato[0]}</td>
                    <td>${dato[6]}</td>
                    <td>${dato[1]} ${dato[2]} ${dato[3]}</td>
                </tr>`;
            }
        });
        $("#cuerpoTabla").html(cuerpoAceptados);
        $("#cuerpoTablaNoAceptados").html(cuerpoNoAceptados);
    }
    Renderizar();
})