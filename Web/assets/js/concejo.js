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
            for (let i = 0; i < datosJSON.length; i++){
                switch(datosJSON[i][17]){
                    case '16':
                    case '17':
                    case '18':
                    case '19':
                    case '20':
                        let idDom = "#listadoDepto"+datosJSON[i][17]
                        let listado = $(idDom).html();
                        let html = `<div class="col-lg-4">
                            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                <img class="img-fluid rounded-circle mb-3" src="${datosJSON[i][21]}" alt="...">
                                <button class="btn btn-warning nomFuncionario" data-bs-toggle="modal" data-bs-target="#modalContacto" onclick="ModificarFormulario(${i})">
                                    <h5 class="mt-1">${datosJSON[i][1]} ${datosJSON[i][2]} ${datosJSON[i][3]}</h5>
                                </button>
                                <p class="font-weight-light mb-0">${datosJSON[i][23]}</p>
                                <h6 class="mt-1">Correo: ${datosJSON[i][8]}</h6>
                                <h6 class="mt-1">Tel: 4000-1600 Ext: ${datosJSON[i][5]}</h6>
                            </div>
                        </div>`;
                        if (i == 23 || i  ==  24){
                            html = `<div class="col-lg-4">
                                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                        <img class="img-fluid rounded-circle mb-3" src="${datosJSON[i][21]}" alt="...">
                                        <button class="btn btn-warning nomFuncionario" data-bs-toggle="modal" data-bs-target="#modalContacto" onclick="ModificarFormulario(${i})">
                                            <h5 class="mt-1">${datosJSON[i][1]} ${datosJSON[i][2]} ${datosJSON[i][3]}</h5>
                                        </button>
                                        <h6 class="mt-1">${datosJSON[i][14]}</h6>
                                        <p class="font-weight-light mb-0">${datosJSON[i][23]}</p>
                                    </div>
                                </div>`;
                        }
                        listado = listado + html;
                        $(idDom).html(listado);
                        break;
                }
            }
        }
        
    }
    DatosDepartamento();
});