let jsonData = $('#jsonData').val();
let idUsuario = $('#idUsuario').val();
let indiceGlobal = 0;
function AbrirConversacion(indice){
    indiceGlobal = indice;
    $("#modalConversacion").modal("show");
    $('#idConsulta').val(jsonData[indice][0]);
    let chat;
    if (jsonData[indice][11] != null){
        let consultas = JSON.parse(jsonData[indice][6].replace(/[\u0000-\u001F\u007F]/g, ""));
        let respuestas = JSON.parse(jsonData[indice][11].replace(/[\u0000-\u001F\u007F]/g, ""));
        chat = [...consultas, ...respuestas];
        //ambito abrir conversacion
        function getFecha(str) {
            const strFecha = str.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/);
            return strFecha ? new Date(strFecha[0]) : null;
        }
        chat.sort((a, b) => getFecha(a) - getFecha(b));
    } else {
        chat = JSON.parse(jsonData[indice][6].replace(/[\u0000-\u001F\u007F]/g, ""));
    }
    $('#bitacora').html('');
    for (let i = 0; i < chat.length; i++){
        let listado = $('#bitacora').html();
        datos = chat[i].split('-');

        listado +=`<div class="col-12 my-1">
                    <div class="card py-2 px-5 text-end">
                        <h6><strong>${datos[4]}</strong> - ${datos[1]} ${datos[2]} ${datos[3]}</h6>
                        <hr>
                        <p>${datos[0]}</p>
                    </div>
                </div>`;
        $('#bitacora').html(listado);
    }

}
$(document).ready(function (){
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
    }
    function MostrarConsultas(){
        for (let i = 0; i < jsonData.length; i++)
        {
            if (jsonData[i][7] == idUsuario)
                id = '#listadoNotiPersona';
            else if (jsonData[i][7] == 0) {
                id = '#listadoNotiMuni';
            } else {
                id = '';
            }
            let cuerpo = JSON.parse(jsonData[i][6]);
            let listado = $(id).html();
            listado += `<div class="col-12 m-1">
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
    $('#btnResponder').on('click', function(){
        if ($('#txtCuerpo').val().trim() != ''){
            let idConsulta = $('#idConsulta').val();
            let cuerpo = $('#txtCuerpo').val();
            $.ajax({
                url: "index.php?controlador=Consulta&metodo=ResponderConsulta",
                type: "POST",
                data: { idConsulta: idConsulta,
                        cuerpo: cuerpo
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
});