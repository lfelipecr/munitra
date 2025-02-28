let interno;
function Adjuntos(jsonAdjuntos) {
  $("#docs").html("");
  let adjuntos = JSON.parse(jsonAdjuntos);
  for (let i = 0; i < adjuntos.length; i++) {
    let docs = $("#docs").html();
    docs += `<embed src="${adjuntos[i]}" type="application/pdf" width="100%" height="500px"> <hr>`;
    $("#docs").html(docs);
  }
}
function CambiarFormulario(conv) {
  $("#txtCuerpo").removeAttr("disabled");
  $("#idAdjuntos").removeAttr("disabled");
  $("#bitacora").html("");
  if (conv == 0) {
    interno = 0;
  } else {
    interno = 1;
  }
  let idSoli = $("#idSolicitud").val();
  $.ajax({
    url: "index.php?controlador=Bitacora&metodo=BuscarConversacion",
    type: "GET",
    data: { idConv: idSoli, interno: interno },
    success: function (response) {
      if (response == "") {
        let html = `<div class="col-12 my-1"><div class="py-2 px-5 text-center"><h6><strong>No hay mensajes</strong></h6></div>`;
        $("#bitacora").html(html);
      } else {
        let jsonData = JSON.parse(response);
        console.log(jsonData);
        for (let i = 0; i < jsonData.length; i++) {
          let listado = $("#bitacora").html();
          let html = `<div class="col-12 my-1">
                                    <div class="card py-2 px-5 text-end">
                                        <h6><strong>${jsonData[i][10]} ${jsonData[i][11]} ${jsonData[i][12]}</strong> - ${jsonData[i][3]}</h6>
                                        <hr>
                                        <p>${jsonData[i][5]}</p>`;
          if (jsonData[i][14] != "") {
            let adjuntos = jsonData[i][14];
            html += `<button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalDocs" onclick='Adjuntos(${JSON.stringify(
              adjuntos
            ).replace(/"/g, "&quot;")})'>
                            <span style="font-size: 1em;">Adjuntos</span>
                            <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M88.7 223.8L0 375.8 0 96C0 60.7 28.7 32 64 32l117.5 0c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 28.3 18.7 45.3 18.7L416 96c35.3 0 64 28.7 64 64l0 32-336 0c-22.8 0-43.8 12.1-55.3 31.8zm27.6 16.1C122.1 230 132.6 224 144 224l400 0c11.5 0 22 6.1 27.7 16.1s5.7 22.2-.1 32.1l-112 192C453.9 474 443.4 480 432 480L32 480c-11.5 0-22-6.1-27.7-16.1s-5.7-22.2 .1-32.1l112-192z"/></svg>
                        </button>`;
          }
          html += `</div></div>`;
          listado += html;
          $("#bitacora").html(listado);
        }
      }
    },
    error: function (xhr, status, error) {
      console.error("Error en la petición:", error);
    },
  });
}
$("#btnEnviarExterno").on("click", function () {
  if ($("#txtCuerpo").val().trim() == "") {
    return false;
  } else {
    let formData = new FormData();
    formData.append("controlador", $("#controlador").val());
    formData.append("idSolicitante", $("#idSolicitante").val());
    formData.append("idSolicitud", $("#idSolicitud").val());
    formData.append("cuerpoEmail", $("#txtCuerpo").val());
    formData.append("interno", interno);
    let archivos = document.getElementById("idAdjuntos").files;
    for (let i = 0; i < archivos.length; i++) {
      formData.append("adjuntos[]", archivos[i]);
    }
    $.ajax({
      url: "index.php?controlador=Bitacora&metodo=EnviarEmail",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        CambiarFormulario(interno);
      },
      error: function (xhr, status, error) {
        console.error("Error en la petición:", error);
      },
    });
  }
  $("#txtCuerpo").val("");
  $("#idAdjuntos").val("");
  return false;
});
$("#btnCerrarAdjuntos").on("click", function () {
  $("#modalDocs").modal("hide");
  $("#modalBitacora").modal("show");
});
