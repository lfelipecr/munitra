$(document).ready(function (){
    let jsonData = $('#jsonData').val();
    if (jsonData != ''){
        jsonData = JSON.parse(jsonData);
    }
    function MostrarNoticias (){

        for (let i = 0; i < jsonData.length; i++){
            let listado = $('#noticias').html();
            let html = `<div class="col-md-4 text-center d-flex justify-content-center"><div class="card my-1" style="width: 18rem;">
                            <div class="bgNoticiaNoPic"></div>
                            <!--<img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                            <h5 class="card-title">${jsonData[i][1]}</h5>
                            <p class="card-text">${jsonData[i][2]}</p>
                            <a href="index.php?controlador=Web&metodo=Noticia&id=${jsonData[i][0]}" class="btn btn-outline-warning">Información</a>
                            </div>
                        </div></div>`;
            listado += html;
            $('#noticias').html(listado);
        }
    }
    MostrarNoticias();
});