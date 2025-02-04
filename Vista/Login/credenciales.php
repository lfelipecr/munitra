<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipalidad de Río Cuarto</title>
    <link rel="icon" type="image/x-icon" href="./Vista/assets/img/icon.png" />
    <style>
        body{
            background-color: #0f1a4f !important;
        }
        .btn-outline-warning{
            color: #272a2e;
            border-color: #f3aa17;
        }
        .btn-outline-warning:hover{
            background-color: #f3aa17;
            color: #f3aa17;
        }
        #canvas {
            border: .5px solid black;
            cursor: crosshair;
        }
        .rojo{
            color: red;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid d-flex justify-content-center all pt-md-5 mt-5">
        <div class="card p-5">
            <div class="text-center p-md-5 p-1">
                <h4 class="h3">Confirmar Cuenta <a href="#" style="text-decoration: none;">(?)</a></h4>
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <hr>
                <form action="index.php?controlador=Login&metodo=IngresarCredenciales" method="post" id="frmIngresar">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <video id="video" class="border rounded" width="100%" height="auto" autoplay></video>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <canvas id="canvasFoto" class="d-none"></canvas>
                            <img id="photo" class="img-fluid border rounded d-none">
                            <input type="hidden" name="foto" id="fotoUrl">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-1 mb-3">
                        <div class="col-12 text-center">
                            <button id="capture" class="btn btn-outline-primary mt-3 mx-1">Tomar Foto</button>
                            <button id="new" class="btn btn-outline-primary mt-3 mx-1">Tomar de nuevo</button>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <div class="col-md-12 mt-md-3 text-center">
                            <span class="mb-3">Firma (*)</span><br>
                            <canvas id="canvas" width="400" height="200"></canvas>
                            <br>
                            <input type="hidden" name="firma" id="firma">
                            <button id="clear" class="btn btn-outline-danger">Limpiar</button>
                        </div>
                    </div>
                    <button class="btn-outline-warning btn w-100" type="submit">
                        <span class="p-1 px-md-5 p-1">Ingresar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="./Vista/assets/js/fotos.js"></script>
    <script src="./Vista/assets/js/firmas.js"></script>
    <script>
       $('#frmIngresar').on('submit', function (){
            let dataURL = canvas.toDataURL("image/png");
            $("#firma").val(dataURL);
            if ($('#fotoUrl').val() == ''){
                return false;
            }
            return true;
       })
    </script>
</body>
</html>