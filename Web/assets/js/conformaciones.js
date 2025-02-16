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
        if (datosJSON != ''){
            let ultimoIdDom = '';
            for (let i = 0; i < datosJSON.length; i++){
                let html = '';
                let idDom = "#listadoDepto"+datosJSON[i][17]
                let listado = $(idDom).html();
                if (idDom != ultimoIdDom){
                    ultimoIdDom = idDom;
                    html += `<div class="col-lg-12 text-center">
                            <button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalDocs" onclick="ObtenerDatos(${datosJSON[i][17]});">
                                <span style="font-size: 1em;">Documentos Departamentales</span>
                            </button>
                        </div>`;
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