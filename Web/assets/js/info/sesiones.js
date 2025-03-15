$(document).ready(function () {
  let fecha = "2025";
  let jsonData = $("#jsonData").val();
  if (jsonData != "") {
    jsonData = JSON.parse(jsonData);
  }
  function MostrarSesiones() {
    $("#sesiones").html("");
    jsonData.forEach((sesion) => {
      let listado = $("#sesiones").html();
      let html = "";
      let fechaRegistro = sesion.fecha.split("-")[0];
      if (fecha == fechaRegistro) {
        fechaRegistro = sesion.fecha.replace(" ", "T");
        fechaRegistro = new Date(fechaRegistro);
        if (sesion.urlActa != "") {
          html += `<tr>
                            <td scope="">${sesion.descripcion}</td>
                            <td scope="">${
                              fechaRegistro.toISOString().split("T")[0]
                            }</td>
                            <td scope="">${fechaRegistro.getHours()}: ${fechaRegistro.getMinutes()}</td>
                            <td class="text-end"><a href="${
                              sesion.urlActa
                            }" target="_blank" class="btn btn-outline-warning">Acta</a>
                            <a href="${
                              sesion.urlAgenda
                            }" target="_blank" class="btn btn-outline-warning">Agenda</a>`;
        } else {
          html += `<tr>
                            <td scope="">${sesion.descripcion}</td>
                            <td scope="">${
                              fechaRegistro.toISOString().split("T")[0]
                            }</td>
                            <td scope="">${fechaRegistro.getHours()}: ${fechaRegistro.getMinutes()}</td>
                            <a href="${
                              sesion.urlAgenda
                            }" target="_blank" class="btn btn-outline-warning">Agenda</a>`;
        }
        if (sesion.urlVideo != "") {
          html += `<a href="${sesion.urlVideo}" target="_blank" class="btn btn-outline-warning mx-1">Transmisión</a>`;
        }
        html += "</td></tr>";
        listado += html;
        $("#sesiones").html(listado);
      }
    });
    if ($("#sesiones").html() == "") {
      let listado = $("#sesiones").html();
      let html = `<div class="col-md-12 text-center d-flex justify-content-center"><div class="my-1" style="padding-bottom: 9rem;padding-top: 9rem;">
                            <h5 class="card-title">No hay sesiones disponibles!</h5>
                        </div></div>`;
      listado += html;
      $("#sesiones").html(listado);
    }
  }
  $("#fecha").on("change", function () {
    fecha = $("#fecha").val();
    MostrarSesiones();
  });
  fecha = $("#fecha").val();
  MostrarSesiones();
});
