$(document).ready(function (){
    let fecha = '2025';
    let jsonData = $('#jsonData').val();
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
    }
    function MostrarSesiones (){
        $('#sesiones').html('');
        console.log(jsonData);
        for (let i = 0; i < jsonData.length; i++){
            let listado = $('#sesiones').html();
            let html = '';
            let fechaRegistro = jsonData[i][1].split("-")[0];
            if (fecha == fechaRegistro){
                if (jsonData[i][4] != ''){
                    html += `<tr>
                            <th scope="">${jsonData[i][2]} - ${jsonData[i][1]}</th>
                            <td class="text-end"><a href="${jsonData[i][4]}" class="btn btn-outline-warning">Acta</a>
                            <a href="${jsonData[i][5]}" class="btn btn-outline-warning">Agenda</a>`;
                } else {
                    html += `<tr>
                            <th scope="">${jsonData[i][2]} - ${jsonData[i][1]}</th>
                            <a href="${jsonData[i][5]}" class="btn btn-outline-warning">Agenda</a>`;
                }
                if (jsonData[i][6] != ''){
                    html += `<a href="${jsonData[i][6]}" class="btn btn-outline-warning mx-1">Ver Sesión</a>`;
                }
                html += '</td></tr>';
                listado += html;
                $('#sesiones').html(listado);
            }
        }
        if ($('#sesiones').html() == ''){
            let listado = $('#sesiones').html();
            let html = `<div class="col-md-12 text-center d-flex justify-content-center"><div class="my-1" style="padding-bottom: 9rem;padding-top: 9rem;">
                            <h5 class="card-title">No hay sesiones disponibles!</h5>
                        </div></div>`;
            listado += html;
            $('#sesiones').html(listado);
        }
    }
    $('#fecha').on('change', function (){
        fecha = $('#fecha').val();
        MostrarSesiones();
    })
    fecha = $('#fecha').val();
    MostrarSesiones();
});