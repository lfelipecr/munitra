$(document).ready(function () {
  let ultIdImpreso = 0;
  let datos = JSON.parse($("#jsonData").val());
  $("#jsonData").val("");
  function RenderizarTabla() {
    let tabla = "";
    datos.forEach((sesion) => {
      if (sesion.id != ultIdImpreso) {
        let comisiones = JSON.parse($("#comisiones").val());
        let comision = "";
        comisiones.forEach((comision) => {
          if (comision.id == sesion.idComision) {
            comision = comision.descripcion;
          }
        });
        tabla += `<tr>
                <td>${sesion.id}</td>
                <td>${sesion.fecha}</td>
                <td>${sesion.descripcion}</td>
                <td>${comision}</td>
                <td class="align-items-center d-flex justify-content-end">
                    <a class="btn btn-warning mx-1" href="index.php?controlador=Sesion&metodo=VActualizar&id=${sesion.id}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                </td></tr>`;
        ultIdImpreso = sesion.id;
      }
    });
    ultIdImpreso = 0;
    $("#tbodyListadoPersonas").html(tabla);
  }
  $("#txtBusqueda").on("keyup", function () {
    let query = $("#txtBusqueda").val();
    if (query == "" || query == null) {
      RenderizarTabla();
    } else {
      let tabla = "";
      datos.forEach((sesion) => {
        if (
          sesion.id.includes(query) ||
          sesion.fecha.includes(query) ||
          sesion.descripcion.includes(query)
        ) {
          if (sesion.id != ultIdImpreso) {
            let comisiones = JSON.parse($("#comisiones").val());
            let comision = "";
            comisiones.forEach((comision) => {
              if (comision.id == sesion.idComision) {
                comision = comision.descripcion;
              }
            });
            tabla += `<tr>
                        <td>${sesion.id}</td>
                        <td>${sesion.fecha}</td>
                        <td>${sesion.descripcion}</td>
                        <td class="align-items-center d-flex justify-content-end">
                            <a class="btn btn-warning mx-1" href="index.php?controlador=Sesion&metodo=VActualizar&id=${sesion.id}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                        </td></tr>`;
            ultIdImpreso = sesion.id;
          }
        }
      });
      ultIdImpreso = 0;
      $("#tbodyListadoPersonas").html(tabla);
    }
  });
  RenderizarTabla();
});
