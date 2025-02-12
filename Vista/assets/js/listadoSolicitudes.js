let datos = JSON.parse($('#jsonData').val());
let controlador = $('#controlador').val();
let indiceActivo = 0;
function CambiarFormulario(indice){
    indiceActivo = indice;
    $('#bitacora').html('');
    destinatario = datos[indice];
    $('#idSolicitante').val(destinatario[9]);
    $('#idSolicitud').val(destinatario[0]);
    let idSoli = destinatario[0];
    $.ajax({
        url: "index.php?controlador=Bitacora&metodo=BuscarConversacion",
        type: "GET",
        data: { idConv: idSoli },
        success: function (response) {
            if (response == ''){
                let html = `<div class="col-12 my-1"><div class="py-2 px-5 text-center"><h6><strong>No hay mensajes</strong></h6></div>`;
                $('#bitacora').html(html);
            } else {
                let jsonData = JSON.parse(response);
                for (let i = 0; i < jsonData.length; i++){
                    let listado = $('#bitacora').html();
                    let html = `<div class="col-12 my-1">
                                    <div class="card py-2 px-5 text-end">
                                        <h6><strong>${jsonData[i][10]} ${jsonData[i][11]} ${jsonData[i][12]}</strong> - ${jsonData[i][3]}</h6>
                                        <hr>
                                        <p>${jsonData[i][5]}</p>
                                    </div>
                                </div>`;
                    listado += html;
                    $('#bitacora').html(listado);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición:", error);
        }
    });
}
$(document).ready(function (){    
    $('#jsonData').val('');
    function RenderizarTabla() {       
        let tabla = "";
        for(let i = 0; i < datos.length; i++){
            tabla += `<tr>
                <td>${datos[i][0]}</td>
                <td>${datos[i][1]}</td>
                <td>${datos[i][4]} ${datos[i][5]}</td>
                <td>${datos[i][7]}</td>
                <td class="align-items-center d-flex justify-content-end">
                    <a onclick='CambiarFormulario(${i})' data-bs-toggle="modal" data-bs-target="#modalBitacora" class="btn btn-info mx-1" href="#">
                        <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                    </a>
                    <a class="btn btn-warning mx-1" href="index.php?controlador=${controlador}&metodo=VActualizar&id=${datos[i][0]}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                </td></tr>`;
        }
        ultIdImpreso = 0;
        $('#tbodyListadoPersonas').html(tabla);
    }
    $('#frmEmail').on('submit', function (){
        if ($('#txtCuerpo').val().trim() == ''){
            return false;
        } else {
            $.ajax({
                url: "index.php?controlador=Bitacora&metodo=EnviarEmail",
                type: "POST",
                data: {
                    controlador: $('#controlador').val(),
                    idSolicitante: $('#idSolicitante').val(),
                    idSolicitud: $('#idSolicitud').val(),
                    cuerpoEmail: $('#txtCuerpo').val()
                 },
                success: function (response) {
                    CambiarFormulario(indiceActivo);
                },
                error: function (xhr, status, error) {
                    console.error("Error en la petición:", error);
                }
            });
        }
        $('#txtCuerpo').val('')
        return false;
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
                        tabla += `<tr>
                        <td>${datos[i][0]}</td>
                        <td>${datos[i][1]}</td>
                        <td>${datos[i][4]} ${datos[i][5]}</td>
                        <td>${datos[i][7]}</td>
                        <td class="align-items-center d-flex justify-content-end">
                            <a onclick='CambiarFormulario(${i})' data-bs-toggle="modal" data-bs-target="#modalBitacora" class="btn btn-info mx-1" href="#">
                                <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                            </a>
                            <a class="btn btn-warning mx-1" href="index.php?controlador=${controlador}&metodo=VActualizar&id=${datos[i][0]}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                        </td></tr>`;
                }    
            }
            ultIdImpreso = 0;
            $('#tbodyListadoPersonas').html(tabla);
        }
    })
    RenderizarTabla(); 
});