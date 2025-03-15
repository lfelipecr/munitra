$(document).ready(function () {
  let jsonData = $("#jsonData").val();
  if (jsonData != "") {
    jsonData = JSON.parse(jsonData);
  }
  function MostrarNoticias() {
    if (jsonData.length < 1) {
      let listado = $("#noticias").html();
      let html = `<div class="col-md-12 text-center d-flex justify-content-center"><div class="my-1" style="padding-bottom: 9rem;padding-top: 9rem;">
                            <h5 class="card-title">No hay noticias disponibles!</h5>
                        </div></div>`;
      listado += html;
      $("#noticias").html(listado);
    }
    jsonData.forEach((noticia) => {
      let listado = $("#noticias").html();
      let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic" style="background: url('${noticia.urlImagen}') no-repeat center center;background-size: cover;"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${noticia.titulo}</h5>
                            <p>${noticia.fecha}</p>
                            <a href="index.php?controlador=Web&metodo=Noticia&id=${noticia.id}" class="btn btn-outline-warning">Información</a>
                            </div>
                        </div></div>`;
      listado += html;
      $("#noticias").html(listado);
    });
  }
  MostrarNoticias();
});
