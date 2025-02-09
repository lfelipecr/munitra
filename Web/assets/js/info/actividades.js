$(document).ready(function (){
    let jsonData = $('#jsonData').val();
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
        console.log(jsonData);
    }
    function MostrarActividades (){

        for (let i = 0; i < jsonData.length; i++){
            let listado = $('#actividades').html();
            let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${jsonData[i][2]}</h5>
                            <p class="card-text">${jsonData[i][3]}</p>
                            <a href="index.php?controlador=Web&metodo=Actividad&id=${jsonData[i][0]}" class="btn btn-outline-warning">Información</a>
                            </div>
                        </div></div>`;
            listado += html;
            $('#actividades').html(listado);
        }
    }
    function MostrarImagenes(){
        let imagenes = $('#imagenes').val();
        if (imagenes != ''){
            imagenes = JSON.parse(imagenes);
            console.log(imagenes);
            for (let i = 0; i < imagenes.length; i++){
                let listado = $('#carousel').html();
                let html = `<div class="carousel-item active"><img src="${imagenes[i]}" class="d-block w-100 h-25 img-fluid border rounded" alt="Imagen ${i}"></div>`;
                listado += html;
                $('#carousel').html(listado);
            }
        }
    }
    if (jsonData == ''){
        MostrarImagenes();
    } else {
        MostrarActividades();
    }    
});