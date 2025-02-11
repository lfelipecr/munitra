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
                                    <div class="bgNoticiaNoPic"></div>
                                    <!--<img src="..." class="card-img-top" alt="...">-->
                                    <div class="card-body">
                                    <h5 class="card-title">${jsonData[i][1]}</h5>
                                    <a href="${jsonData[i][2]}" class="btn btn-outline-primary">Ver</a>
                                    <a href="${jsonData[i][2]}" download class="btn btn-outline-warning">Descargar</a>
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
                            </div>
                        </div>`;
                listado = listado + html;
                $(idDom).html(listado);
            }
        }
        
    }
    DatosDepartamento();
});