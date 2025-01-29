$(document).ready(function () {
    $('#frmNoticia').on('submit', function () {
        $('#alerta').show();
        let titulo = $('#txtTitulo').val().trim();
        let descripcion = $('#txtDescripcion').val().trim();
        if (titulo == '' || descripcion == ''){
            $('#alerta').html('Debe proporcionar todos los datos marcados con asterisco (*)');
            return false;
        }
        if (descripcion.length > 1000){
            $('#alerta').html('Ha superado el número de caracteres para la noticia');
            return false;
        }
            
        return true;
    });
});