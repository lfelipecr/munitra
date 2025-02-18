let datos = JSON.parse($('#jsonData').val());
let controlador = $('#controlador').val();
function CambiarFormulario(indice){
    destinatario = datos[indice];
    $('#idSolicitante').val(destinatario[9]);
    $('#idSolicitud').val(destinatario[0]);
}
$(document).ready(function (){
    $('#jsonData').val('');
    function RenderizarTabla() {
        let tabla = "";
        for(let i = 0; i < datos.length; i++){
            tabla += `<div class="col-12 mb-3">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=${controlador}&metodo=VActualizar&id=${datos[i][0]}';">
                    <div class="d-flex justify-content-between">
                    <h4>Solicitud de ${controlador} - <a href="#" class="link-blog">${datos[i][1]}</a></h4>
                    <h4># ${datos[i][0]}</h4>
                    </div>
                    <hr>
                    <p class="h6">${datos[i][7]}</p>
                </div>
            </div>`;
        }
        ultIdImpreso = 0;
        $('#tbodyListadoPersonas').html(tabla);
    }
    $('#frmEmail').on('submit', function (){
        if ($('#txtAsunto').val().trim() == '' || $('#txtCuerpo').val().trim() == ''){
            return false;
        }
        return true;
    });
    $('#txtBusqueda').on('keyup', function () {
        let query = $('#txtBusqueda').val();
        if (query == '' || query == null){
            RenderizarTabla()
        } else {
            let tabla = "";
            for(let i = 0; i < datos.length; i++){
                if (datos[i][0].includes(query) || datos[i][1].includes(query) || 
                    datos[i][4].includes(query) || datos[i][5].includes(query) || datos[i][7].includes(query)){
                        tabla += `<div class="col-12 mb-3">
                                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=${controlador}&metodo=VActualizar&id=${datos[i][0]}';">
                                        <div class="d-flex justify-content-between">
                                        <h4>Solicitud de ${controlador} - <a href="#" class="link-blog">${datos[i][1]}</a></h4>
                                        <h4># ${datos[i][0]}</h4>
                                        </div>
                                        <hr>
                                        <p class="h6">${datos[i][7]}</p>
                                    </div>
                                </div>`;
                }    
            }
            ultIdImpreso = 0;
            $('#tbodyListadoPersonas').html(tabla);
        }
    })
    RenderizarTabla(); 
});