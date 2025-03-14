let jsonData = $("#jsonData").val();
let idUsuario = $("#idUsuario").val();
let indiceGlobal = 0;
function Adjuntos(jsonAdjuntos) {
  $("#docs").html("");
  let adjuntos = JSON.parse(jsonAdjuntos);
  for (let i = 0; i < adjuntos.length; i++) {
    let docs = $("#docs").html();
    docs += `<embed src="${adjuntos[i]}" type="application/pdf" width="100%" height="500px"> <hr>`;
    $("#docs").html(docs);
  }
}
function AbrirConversacion(indice) {
  indiceGlobal = indice;
  $("#modalConversacion").modal("show");
  $("#idConsulta").val(jsonData[indice][0]);
  $("#bitacora").html("");
  let chat = [];
  $.ajax({
    url: "index.php?controlador=Consulta&metodo=ObtenerInteracciones",
    type: "GET",
    data: { idConsulta: jsonData[indice][0] },
    success: function (response) {
      if (response != "") {
        chat = JSON.parse(response);
        for (let i = 0; i < chat.length; i++) {
          let listado = $("#bitacora").html();
          listado += `<div class="col-12 my-1">
                                <div class="card py-2 px-5 text-end">
                                    <h6><strong>${chat[i][4]}</strong> - ${chat[i][3]}</h6>
                                    <hr>
                                    <p>${chat[i][1]}</p>`;
          if (chat[i][2] != "") {
            let adjuntos = chat[i][2];
            listado += `<button class="btn btn-outline-warning mx-1 mt-md-none mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalDocs" onclick='Adjuntos(${JSON.stringify(
              adjuntos
            ).replace(/"/g, "&quot;")})'>
                            <span style="font-size: 1em;">Adjuntos</span>
                            <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M88.7 223.8L0 375.8 0 96C0 60.7 28.7 32 64 32l117.5 0c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 28.3 18.7 45.3 18.7L416 96c35.3 0 64 28.7 64 64l0 32-336 0c-22.8 0-43.8 12.1-55.3 31.8zm27.6 16.1C122.1 230 132.6 224 144 224l400 0c11.5 0 22 6.1 27.7 16.1s5.7 22.2-.1 32.1l-112 192C453.9 474 443.4 480 432 480L32 480c-11.5 0-22-6.1-27.7-16.1s-5.7-22.2 .1-32.1l112-192z"/></svg>
                        </button>`;
          }
          listado += `</div></div>`;
          $("#bitacora").html(listado);
        }
      }
    },
    error: function (xhr, status, error) {
      console.error("Error en la petición:", error);
    },
  });
}
$(document).ready(function () {
  if (jsonData != "") {
    jsonData = JSON.parse(jsonData);
  }
  function MostrarConsultas() {
    for (let i = 0; i < jsonData.length; i++) {
      if (jsonData[i][6] == idUsuario) id = "#listadoNotiPersona";
      else if (jsonData[i][6] == 0) {
        id = "#listadoNotiMuni";
      } else {
        id = "";
      }
      let tipo = "Consulta";
      if (jsonData[i][7] == 2) {
        tipo = "Denuncia";
      } else if (jsonData[i][7] == 3) {
        tipo = "Queja";
      }

      let estado = "Pendiente";
      if (jsonData[i][9] == 1) {
        estado = "Atendido";
      }
      let cuerpo = JSON.parse(jsonData[i][6]);
      let listado = $(id).html();
      listado += `<div class="col-12 m-1">
                            <div class="card chat p-5" onclick='AbrirConversacion(${i})'>
                                <h5>${jsonData[i][1]} - ${jsonData[i][2]} - ${jsonData[i][8]}</h5>
                                <h6>${tipo} - ${estado}</h6>
                                <hr>
                                <strong>${jsonData[i][5]}</strong>
                            </div>
                        </div>`;
      $(id).html(listado);
    }
    let html = `<div class="col-12 text-center mx-1"><div class="card p-5"><h5>Aún no hay consultas!</h5></div></div>`;
    if ($("#listadoNotiMuni").html() == "") {
      $("#listadoNotiMuni").html(html);
    }
    if ($("#listadoNotiPersona").html() == "") {
      $("#listadoNotiPersona").html(html);
    }
  }
  MostrarConsultas();
  $("#btnResponder").on("click", function () {
    if ($("#txtCuerpo").val().trim() != "") {
      let idConsulta = $("#idConsulta").val();
      let cuerpo = $("#txtCuerpo").val();

      let formData = new FormData();
      formData.append("idConsulta", idConsulta);
      formData.append("cuerpo", cuerpo);
      let archivos = document.getElementById("idAdjuntos").files;
      for (let i = 0; i < archivos.length; i++) {
        formData.append("adjuntos[]", archivos[i]);
      }

      $.ajax({
        url: "index.php?controlador=Consulta&metodo=ResponderConsulta",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          //ajax whatsapp api
          console.log(response);
        },
        error: function (xhr, status, error) {
          console.error("Error en la petición:", error);
        },
      }).then(function () {
        location.reload();
      });
      $("#txtCuerpo").val("");
    }
  });
  $("#btnCerrarAdjuntos").on("click", function () {
    $("#modalDocs").modal("hide");
    $("#modalConversacion").modal("show");
  });
  $("#txtBusqueda").on("keyup", function () {
    let query = $("#txtBusqueda").val();
    if (query != "") {
      for (let i = 0; i < jsonData.length; i++) {
        //recorre la matriz buscando similitudes
        for (let j = 0; j < 9; j++) {
          if (jsonData[i][j].includes(query)) {
            id = "#listadoNotiMuni";
            $(id).html("");
            if (jsonData[i][6] == 0) {
              let tipo = "Consulta";
              if (jsonData[i][7] == 2) {
                tipo = "Denuncia";
              } else if (jsonData[i][7] == 3) {
                tipo = "Queja";
              }
              let estado = "Pendiente";
              if (jsonData[i][9] == 1) {
                estado = "Atendido";
              }
              let cuerpo = JSON.parse(jsonData[i][6]);
              let listado = $(id).html();
              listado += `<div class="col-12 m-1">
                            <div class="card chat p-5" onclick='AbrirConversacion(${i})'>
                                <h5>${jsonData[i][1]} - ${jsonData[i][2]} - ${jsonData[i][8]}</h5>
                                <h6>${tipo} - ${estado}</h6>
                                <hr>
                                <strong>${jsonData[i][5]}</strong>
                            </div>
                        </div>`;
              $(id).html(listado);
            }
            let html = `<div class="col-12 text-center mx-1"><div class="card p-5"><h5>Aún no hay consultas!</h5></div></div>`;
            if ($("#listadoNotiMuni").html() == "") {
              $("#listadoNotiMuni").html(html);
            }
            if ($("#listadoNotiPersona").html() == "") {
              $("#listadoNotiPersona").html(html);
            }
          }
        }
      }
    } else {
      MostrarConsultas();
    }
  });
});
