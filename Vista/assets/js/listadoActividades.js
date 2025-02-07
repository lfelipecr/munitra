$(document).ready(function (){
    let datos = JSON.parse($('#jsonData').val());
    let idUsuario = $('#idUsuario').val();
    console.log(datos);
    $('#jsonData').val('');
    $('#idUsuario').val('');
    function RenderizarTabla() {
        let tabla = "";
        for(let i = 0; i < datos.length; i++){
            tabla += `<tr>
                <td>${datos[i][0]}</td>
                <td>${datos[i][2]}</td>
                <td>${datos[i][6]}</td>`;
            if (idUsuario == datos[i][1]){
                tabla += `<td class="align-items-center d-flex justify-content-end">
                            <a class="btn btn-danger mx-1" href="index.php?controlador=Actividad&metodo=Eliminar&id=${datos[i][0]}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></span></a>
                            <a class="btn btn-warning mx-1" href="index.php?controlador=Actividad&metodo=VActualizar&id=${datos[i][0]}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                        </td>`;
            }
            tabla += `</tr>`;
        }
        $('#tbodyListadoPersonas').html(tabla);
    }
    $('#txtBusqueda').on('keyup', function () {
        let query = $('#txtBusqueda').val();
        if (query == '' || query == null){
            RenderizarTabla()
        } else {
            let tabla = "";
            for(let i = 0; i < datos.length; i++){
                if (datos[i][0].includes(query) || datos[i][8].includes(query) || 
                    datos[i][9].includes(query) || datos[i][1].includes(query) ||
                    datos[i][10].includes(query)){
                    tabla += `<tr>
                        <td>${datos[i][0]}</td>
                        <td>${datos[i][1]}</td>
                        <td>${datos[i][8]} ${datos[i][9]}  ${datos[i][10]}</td>`;
                    if (idUsuario == datos[i][4]){
                        tabla += `<td class="align-items-center d-flex justify-content-end">
                                    <a class="btn btn-danger mx-1" href="index.php?controlador=Actividad&metodo=Eliminar&id=${datos[i][0]}">
                                        <span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></span>
                                    </a><a class="btn btn-warning mx-1" href="index.php?controlador=Actividad&metodo=VActualizar&id=${datos[i][0]}"><span><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></span></a>
                                </td>`;
                    }
                    tabla += `</tr>`;
                }                
            }
            $('#tbodyListadoPersonas').html(tabla);
        }
    })
    RenderizarTabla();
});