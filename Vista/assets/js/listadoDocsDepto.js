$(document).ready(function (){
    let jsonData = JSON.parse($('#jsonData').val());
    console.log(jsonData);
    function MostrarDatos(){
        for (let i = 0; i < jsonData.length; i++){
            let listado = $('#docs').html();
            let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${jsonData[i][1]}</h5>
                            <a href="${jsonData[i][2]}" class="btn btn-outline-primary">Ver</a>
                            <a href="index.php?controlador=Documentacion&metodo=Eliminar&id=${jsonData[i][0]}" class="btn btn-outline-danger">Eliminar</a>
                            </div>
                        </div></div>`;
            listado += html;
            $('#docs').html(listado);
        }
    }
    MostrarDatos();
});