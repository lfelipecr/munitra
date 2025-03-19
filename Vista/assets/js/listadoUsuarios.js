function CambiarModal(id) {
  let datos = JSON.parse($("#jsonData").val());
}
$(document).ready(function () {
  let descripciones = [
    "",
    "Activo",
    "Inactivo",
    "Sin Registrar",
    "Por Confirmar",
    "Revisado",
    "Externo",
  ];
  let estadoUsuario = 0;
  let activos = true;
  let datos = JSON.parse($("#jsonData").val());
  function RenderizarTabla() {
    let tabla = "";
    datos.forEach((persona) => {
      function Imprimir() {
        tabla += `<tr>
            <td>${persona.id}</td>
            <td>${persona.nombre} ${persona.primerApellido}  ${
          persona.segundoApellido
        }</td>
            <td>${persona.identificacion}</td>
            <td>${descripciones[persona.idEstado]}</td>
              <td class="align-items-center d-flex justify-content-end">
                    <a class="btn btn-warning mx-1" href="index.php?controlador=Usuario&metodo=VActualizar&id=${
                      persona.id
                    }&idUsuario=${persona.idUsuario}">
                        <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span>
                    </a>`;
        if (persona.idEstado == "4") {
          tabla += `<a class="btn btn-info mx-1" href="index.php?controlador=Usuario&metodo=VerCredenciales&id=${persona.id}">
                  <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></span>
              </a>`;
        }
        tabla += `</td></tr>`;
        if (persona.idEstado == 6) {
          persona.idEstado = null;
        }
      }
      if (!activos && persona.idEstado == null) {
        persona.idEstado = 6;
        Imprimir();
      } else if (activos) {
        if (estadoUsuario != 0) {
          if (persona.idEstado == estadoUsuario) {
            Imprimir();
          }
        } else if (persona.idEstado != null) {
          Imprimir();
        }
      }
    });
    $("#tbodyListadoPersonas").html(tabla);
  }
  $("#btnSolicitudes").on("click", function () {
    if (activos) activos = false;
    else activos = true;
    RenderizarTabla();
  });
  $("#txtBusqueda").on("keyup", function () {
    let query = $("#txtBusqueda").val();
    if (query == "" || query == null) {
      RenderizarTabla();
    } else {
      let tabla = "";
      datos.forEach((persona) => {
        if (
          persona.id.includes(query.toLowerCase()) ||
          persona.nombre.toLowerCase().includes(query.toLowerCase()) ||
          persona.primerApellido.toLowerCase().includes(query.toLowerCase()) ||
          persona.segundoApellido.toLowerCase().includes(query.toLowerCase()) ||
          persona.identificacion.toLowerCase().includes(query.toLowerCase())
        ) {
          function Imprimir() {
            tabla += `<tr>
            <td>${persona.id}</td>
            <td>${persona.nombre} ${persona.primerApellido}  ${persona.segundoApellido}</td>
            <td>${persona.identificacion}</td>
            <td>${descripciones[persona.idEstado]}</td>
              <td class="align-items-center d-flex justify-content-end">
                    <a class="btn btn-warning mx-1" href="index.php?controlador=Usuario&metodo=VActualizar&id=${
                      persona.id
                    }&idUsuario=${persona.idUsuario}">
                        <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span>
                    </a>`;
            if (persona.idEstado == "4") {
              tabla += `<a class="btn btn-info mx-1" href="index.php?controlador=Usuario&metodo=VerCredenciales&id=${persona.id}">
                  <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></span>
              </a>`;
            }
            tabla += `</td></tr>`;
            if (persona.idEstado == 6) {
              persona.idEstado = null;
            }
          }
          if ((!activos && persona.idEstado == null) || persona.idEstado == null) {
            persona.idEstado = 6;
            Imprimir();
          } else if (activos) {
            if (estadoUsuario != 0) {
              if (persona.idEstado == estadoUsuario) {
                Imprimir();
              }
            } else if (persona.idEstado != null) {
              Imprimir();
            }
          }
        }
      });
      $("#tbodyListadoPersonas").html(tabla);
    }
  });
  $("#estadoUsuario").on("change", () => {
    estadoUsuario = $("#estadoUsuario").val();
    if (estadoUsuario == "6") {
      activos = false;
    } else {
      activos = true;
    }
    RenderizarTabla();
  });
  RenderizarTabla();
});
