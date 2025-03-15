$(document).ready(function () {
  let jsonData = JSON.parse($("#jsonData").val());
  function MostrarDatos() {
    jsonData.forEach((documento) => {
      let listado = $("#docs").html();
      let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${documento.descripcion}</h5>
                            <a href="${documento.urlArchivo}" target="_blank" class="btn btn-outline-primary">Ver</a>
                            <a href="index.php?controlador=Documentacion&metodo=Eliminar&id=${documento.id}" class="btn btn-outline-danger">Eliminar</a>
                            </div>
                        </div></div>`;
      listado += html;
      $("#docs").html(listado);
    });
  }
  MostrarDatos();
});
