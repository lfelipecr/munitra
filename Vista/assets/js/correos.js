let jsonData = $('#jsonData').val();
let idUsuario = $('#idUsuario').val();
function AbrirConversacion(indice){
    $("#modalConversacion").modal("show");
    let consultas = JSON.parse(jsonData[indice][7]);
    let respuestas = JSON.parse(jsonData[indice][10]);
    let max = 0;
    if (consultas.length > respuestas.length) max = consultas.length;
    else max = respuestas.length;
    let arreglo = [];
    for (let i = 0; i < max; i++)
    {
         
    }
}
$(document).ready(function (){
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
    }
    function MostrarConsultas(){
        console.log(jsonData);
        for (let i = 0; i < jsonData.length; i++)
        {
            if (jsonData[i][7] == idUsuario)
                id = '#listadoNotiPersona';
            else id = '#listadoNotiMuni';            
            let cuerpo = JSON.parse(jsonData[i][6]);
            let listado = $(id).html();
            listado += `<div class="col-12 mx-1">
                            <div class="card chat p-5" onclick='AbrirConversacion(${i})'>
                                <h5>${jsonData[i][1]} - ${jsonData[i][2]} - ${jsonData[i][8]}</h5>
                                <hr>
                                <strong>${jsonData[i][5]}</strong>
                                <p>${cuerpo[0].split("-")[0]}</p>
                            </div>
                        </div>`;
            $(id).html(listado);
        }
        let html = `<div class="col-12 text-center mx-1"><div class="card p-5"><h5>Aún no hay consultas!</h5></div></div>`;
        if ($('#listadoNotiMuni').html() == ''){
            $('#listadoNotiMuni').html(html);
        }
        if ($('#listadoNotiPersona').html() == ''){
            $('#listadoNotiPersona').html(html);
        }
    }
    MostrarConsultas();
});