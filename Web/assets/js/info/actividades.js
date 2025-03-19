$(document).ready(function () {
  let jsonData = $("#jsonData").val();
  if (jsonData != "") {
    jsonData = JSON.parse(jsonData);
  }
  function MostrarActividades() {
    if (jsonData.length < 1) {
      let listado = $("#actividades").html();
      let html = `<div class="col-md-12 text-center d-flex justify-content-center"><div class="my-1" style="padding-bottom: 9rem;padding-top: 9rem;">
                            <h5 class="card-title">No hay actividades disponibles!</h5>
                        </div></div>`;
      listado += html;
      $("#actividades").html(listado);
    }
    jsonData.forEach((actividad) => {
      let listado = $("#actividades").html();
      let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${actividad.titulo}</h5>
                            <p class="card-text">${actividad.fecha}</p>
                            <a href="index.php?controlador=Web&metodo=Actividad&id=${actividad.id}" class="btn btn-outline-warning">Información</a>
                            </div>
                        </div></div>`;
      listado += html;
      $("#actividades").html(listado);
    });
  }
  MostrarActividades();
});
