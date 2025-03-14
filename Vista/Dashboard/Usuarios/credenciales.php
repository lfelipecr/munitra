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
                        <a class="btn btn-warning" href="#" target="_blank" id="consentimiento">Consentimiento Informado</a>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <a class="btn btn-warning" href="#" target="_blank" id="cedulaFro">Cédula (Frente)</a>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <a class="btn btn-warning" href="#" target="_blank" id="cedulaTra">Cédula (Detrás)</a>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <a class="btn-outline-warning btn w-100 mx-1" type="submit" id="aceptar">
                                <span class="p-1 px-md-5 p-1">Aceptar</span>
                            </a>
                            <a class="btn-outline-danger btn w-100 mx-1" id="" data-bs-toggle="modal" data-bs-target="#modalMensajeDenegacion">
                                <span class="p-1 px-md-5 p-1">Denegar</span>
                            </a>
                        </div>
                        <div class="col-12 d-flex mt-1">
                            <a class="btn-outline-success btn w-100 mx-1" onclick="window.history.back()" href="#">
                                <span class="p-1 px-md-5 p-1">Regresar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMensajeDenegacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBitacoraLabel">Rechazar Credenciales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="" class="form-label" id="razonLabel">Razón de la denegación *</label>
                        <textarea class="form-control" id="denegacionTexto"></textarea>
                        <input type="hidden" id="idConsulta">
                    </div>
                </div>
                <div class="modal-footer d-block">
                    <div class="mb-2 text-end">
                        <a id="denegar" class="btn btn-warning">
                            <span>Enviar</span>
                        </a>
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
            let urlDenegacion = `index.php?controlador=Usuario&metodo=ValidarCredenciales&id=${jsonData.ID_USUARIO}&idCredencial=${jsonData.ID_CREDENCIAL}&validar=false`;
            $('#nombre').html(`Nombre: ${jsonData.NOMBRE} ${jsonData.PRIMER_APELLIDO} ${jsonData.SEGUNDO_APELLIDO}`);
            $('#cedula').html(`Nombre: ${jsonData.IDENTIFICACION}`);
            $('#correo').html(`Correo: ${jsonData.CORREO_USUARIO}`);
            $('#telefono').html(`Telefono: ${jsonData.TELEFONO}`);
            $('#whatsapp').html(`Whatsapp: ${jsonData.WHATSAPP}`);
            document.getElementById('firmaCredenciales').src = jsonData.FIRMA;
            document.getElementById('consentimiento').href = jsonData.URL_CONSENTIMIENTO;
            document.getElementById('cedulaFro').href = jsonData.CEDULA_FRONTAL;
            document.getElementById('cedulaTra').href = jsonData.CEDULA_TRASERA;
            document.getElementById('aceptar').href = `index.php?controlador=Usuario&metodo=ValidarCredenciales&id=${jsonData.ID_USUARIO}&idCredencial=${jsonData.ID_CREDENCIAL}&validar=true&consentimiento=${jsonData.URL_CONSENTIMIENTO}`;
            $('#denegar').on('click', function() {
                let razon = $('#denegacionTexto').val();
                if (razon != '') {
                    urlDenegacion += '&motivo='+razon;
                    window.location.href = urlDenegacion;
                } else {
                    let clases = ['bg-danger', 'text-white', 'p-3', 'card'];
                    clases.forEach(e => {
                        $('#razonLabel').addClass(e);
                    });
                }
            })
        });
    </script>
</body>

</html>