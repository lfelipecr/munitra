function AbrirModalTramites(id){
    let tramites = JSON.parse($('#tramites').val());
    for (let i = 0; i < tramites.length; i++){
        if (tramites[i][2] == id){
            let listado = $('#tramitesModal').html();
            listado += `<div class="col-md-12 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">${tramites[i][1]}</h5>
                    <a href="index.php?controlador=Web&metodo=SolicitarTramite&tramite=${tramites[i][0]}" class="btn btn-outline-primary">Ir <svg style='width: 1em' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg></a>
                    </div>
                </div></div>`;        
            $('#tramitesModal').html(listado);
        }
    }
    
}
function Redirigir (id){
    window.location.href = 'index.php?controlador=Web&metodo=SolicitarTramite&tramite='+id;
}
//Documentos asociados a departamento
function ObtenerDatos(idDepto){
    $('#docs').html('<div class="col-md-12 text-center d-flex justify-content-center"><p>Este departamento aún no ha subido nada</p></div>');
    $.ajax({
        url: "index.php?controlador=Web&metodo=ListadoDocsWeb",
        type: "GET",
        data: { idDepto: idDepto },
        success: function (response) {
            if (response != ''){
                let listado = $('#docs').html('');
                let jsonData = JSON.parse(response);
                for (let i = 0; i < jsonData.length; i++){
                    let listado = $('#docs').html();
                    let html = `<div class="col-md-12 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                                    <div class="card-body">
                                    <h5 class="card-title">${jsonData[i][1]}</h5>
                                    <a href="${jsonData[i][2]}" class="btn btn-outline-primary"><svg style='width: 1.5em' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg></a>
                                    <a href="${jsonData[i][2]}" download class="btn btn-outline-warning"><svg style='width: 1.5em' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg></a>
                                    </div>
                                </div></div>`;
                    listado += html;
                    $('#docs').html(listado);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición:", error);
        }
    });
}
function ModificarFormularioJefeDepto(id){
    let datosJSON = JSON.parse($('#jsonData').val());
    let depto = JSON.parse($('#deptos').val());
    console.log(depto);
    let comunicado;
    for (let i = 0; i < depto.length; i++){
        if (depto[i]['id'] == id){
            id = depto[i]['jefe'];
        }
    }
    if (id != 0){
        for (let i = 0; i < datosJSON.length; i++){
            if (datosJSON[i][0] == id){
                comunicado = datosJSON[i];
                break;
            }
        }
    }
    $('#nombreComunicar').html(`${comunicado[1]} ${comunicado[2]} ${comunicado[3]}`);
    $('#puestoComunicar').html(comunicado[14]);
    $('#idConsultado').val(comunicado[13]);
}
function ModificarFormulario(id){
    let datosJSON = JSON.parse($('#jsonData').val());
    let comunicado = datosJSON[id];
    $('#nombreComunicar').html(`${comunicado[1]} ${comunicado[2]} ${comunicado[3]}`);
    $('#puestoComunicar').html(comunicado[14]);
    $('#idConsultado').val(comunicado[13]);
}
$(document).ready(function () {
    function DatosDepartamento(){
        let datosJSON = JSON.parse($('#jsonData').val());
        let tramites = JSON.parse($('#tramites').val());
        if (datosJSON != ''){
            let ultimoIdDom = '';
            for (let i = 0; i < datosJSON.length; i++){
                let html = '';
                let idDom = "#listadoDepto"+datosJSON[i][17]
                let listado = $(idDom).html();
                if (idDom != ultimoIdDom){
                    html += '<div class="col-lg-12"><div class="row">';
                    let regularBotonTramites = true;
                    ultimoIdDom = idDom;
                    html += `<div class="col-lg-4">
                            <button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalDocs" onclick="ObtenerDatos(${datosJSON[i][17]});">
                                <span style="font-size: 1em;">Documentos Departamentales</span>
                                <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M88.7 223.8L0 375.8 0 96C0 60.7 28.7 32 64 32l117.5 0c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 28.3 18.7 45.3 18.7L416 96c35.3 0 64 28.7 64 64l0 32-336 0c-22.8 0-43.8 12.1-55.3 31.8zm27.6 16.1C122.1 230 132.6 224 144 224l400 0c11.5 0 22 6.1 27.7 16.1s5.7 22.2-.1 32.1l-112 192C453.9 474 443.4 480 432 480L32 480c-11.5 0-22-6.1-27.7-16.1s-5.7-22.2 .1-32.1l112-192z"/></svg>
                            </button>
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalContacto" onclick="ModificarFormularioJefeDepto(${datosJSON[i][17]});">
                                <span style="font-size: 1em;">Contactar Departamento</span>
                                <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                            </button>
                        </div>`;
                    for (let j = 0; j < tramites.length; j++){
                        if (tramites[j][2] == datosJSON[i][17] && regularBotonTramites){
                            regularBotonTramites = false;
                            html += `<div class="col-lg-4">
                                    <button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" onclick="AbrirModalTramites(${datosJSON[i][17]})" data-bs-toggle="modal" data-bs-target="#modalTramites">
                                        <span style="font-size: 1em;">Trámites Departamentales</span>
                                        <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm128 80c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/></svg>
                                    </button>
                                </div>`;
                            break;
                        }
                    }
                    html += '</div></div>';
                }
                html += `<div class="col-lg-4">
                            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                <img class="img-fluid rounded-circle mb-3" src="${datosJSON[i][21]}" alt="...">
                                <button class="btn btn-warning nomFuncionario" data-bs-toggle="modal" data-bs-target="#modalContacto" onclick="ModificarFormulario(${i})">
                                    <h5 class="mt-1">${datosJSON[i][1]} ${datosJSON[i][2]} ${datosJSON[i][3]}</h5>
                                </button>
                                <h6 class="mt-1">${datosJSON[i][14]}</h6>
                                <p class="mt-1">Correo: ${datosJSON[i][8]}</p>
                                <p class="mt-1">Tel: 4000-1600 Ext: ${datosJSON[i][5]}</p>
                            </div>
                        </div>`;
                listado = listado + html;
                $(idDom).html(listado);
            }
        }
        
    }
    DatosDepartamento();
});