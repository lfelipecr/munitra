<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipalidad de Río Cuarto</title>
    <link rel="icon" type="image/x-icon" href="./Vista/assets/img/icon.png" />
    <style>
        body {
            background-color: #0f1a4f !important;
        }

        .btn-outline-warning {
            color: #272a2e;
            border-color: #f3aa17;
        }

        .btn-outline-warning:hover {
            background-color: #f3aa17;
            color: #f3aa17;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid d-flex justify-content-center all pt-md-5 mt-5">
        <div class="card p-5">
            <div class="text-center p-md-5 p-1">
                <h4 class="h3">Confirmar Cuenta <a href="index.php?controlador=Usuario&metodo=Listado" style="text-decoration: none;">(x)</a></h4>
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <hr>
                <div>
                    <input type="hidden" id="jsonData" name="jsonData" value='<?php echo $jsonData; ?>'>
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center d-block">
                            <p id="nombre">Nombre: </p>
                            <p id="cedula">Cédula: </p>
                            <p id="correo">Correo: </p>
                            <p id="telefono">Teléfono: </p>
                            <p id="whatsapp">Whatsapp: </p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <div class="col-md-12 mt-md-3 text-center">
                            <span class="mb-3">Firma</span><br>
                            <img src="" class="img-fluid border rounded" id="firmaCredenciales" alt="">
                            <br>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <a class="btn btn-warning" href="#" id="consentimiento">Consentimiento Informado</a>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <a class="btn-outline-warning btn w-100 mx-1" type="submit" id="aceptar">
                                <span class="p-1 px-md-5 p-1">Aceptar</span>
                            </a>
                            <a class="btn-outline-danger btn w-100 mx-1" id="denegar">
                                <span class="p-1 px-md-5 p-1">Denegar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let jsonData = JSON.parse($('#jsonData').val());
            $('#nombre').html(`Nombre: ${jsonData.NOMBRE} ${jsonData.PRIMER_APELLIDO} ${jsonData.SEGUNDO_APELLIDO}`);
            $('#cedula').html(`Nombre: ${jsonData.IDENTIFICACION}`);
            $('#correo').html(`Correo: ${jsonData.CORREO_USUARIO}`);
            $('#telefono').html(`Telefono: ${jsonData.TELEFONO}`);
            $('#whatsapp').html(`Whatsapp: ${jsonData.WHATSAPP}`);
            document.getElementById('firmaCredenciales').src = jsonData.FIRMA;
            document.getElementById('consentimiento').href = jsonData.URL_CONSENTIMIENTO;
            document.getElementById('denegar').href = `index.php?controlador=Usuario&metodo=ValidarCredenciales&id=${jsonData.ID_USUARIO}&idCredencial=${jsonData.ID_CREDENCIAL}&validar=false`;
            document.getElementById('aceptar').href = `index.php?controlador=Usuario&metodo=ValidarCredenciales&id=${jsonData.ID_USUARIO}&idCredencial=${jsonData.ID_CREDENCIAL}&validar=true`;
        });
    </script>
</body>

</html>