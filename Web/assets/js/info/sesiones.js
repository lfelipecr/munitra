$(document).ready(function (){
    let fecha = '2025';
    let jsonData = $('#jsonData').val();
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
        console.log(jsonData);
    }
    function MostrarSesiones (){
        $('#sesiones').html('');
        for (let i = 0; i < jsonData.length; i++){
            let listado = $('#sesiones').html();
            let html = '';
            let fechaRegistro = jsonData[i][1].split("-")[0];
            if (fecha == fechaRegistro){
                if (jsonData[i][3] == '1'){
                    html += `<div class="col-12 text-center d-flex justify-content-center">
                                <div class="card w-100 my-1">
                                    <div class="card-body">
                                    <h5 class="card-title mb-3">${jsonData[i][2]} - ${jsonData[i][1]}</h5>
                                    <a href="${jsonData[i][4]}" class="btn btn-outline-warning">Acta</a>`;
                } else {
                    html += `<div class="col-md-6 text-center d-flex justify-content-center">
                    <div class="card w-100 my-1">
                        <div class="card-body">
                        <h5 class="card-title mb-3">${jsonData[i][2]} - ${jsonData[i][1]}</h5>`;
                }
                if (jsonData[i][6] != ''){
                    html += `<a href="${jsonData[i][5]}" class="btn btn-outline-warning">Agenda</a>
                            <a href="${jsonData[i][6]}" class="btn btn-outline-warning">Ver Sesión</a>`;
                }
                html += '</div></div></div>';
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