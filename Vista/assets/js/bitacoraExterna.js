let interno;
function CambiarFormulario(){
    $('#txtCuerpo').removeAttr('disabled');
    $('#bitacora').html('');
    let idSoli = $('#idSolicitud').val();
    $.ajax({
        url: "index.php?controlador=Bitacora&metodo=BuscarConversacion",
        type: "GET",
        data: { idConv: idSoli, interno: 0},
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
$('#btnEnviarExterno').on('click', function (){
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
                cuerpoEmail: $('#txtCuerpo').val(),
                interno: 0
             },
            success: function (response) {
                console.log(response);
                CambiarFormulario();
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    }
    $('#txtCuerpo').val('')
    return false;
});
CambiarFormulario();
