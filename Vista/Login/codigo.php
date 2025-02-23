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
                <h4 class="h3">Ingresar Código de Confirmación<a href="#" style="text-decoration: none;">(?)</a></h4>
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <input type="hidden" id="msg" value="<?php echo $msg;?>">
                <hr>
                <form action="index.php?controlador=Usuario&metodo=ValidarCodigo" method="post" id="frmIngresar">
                    <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                <div class="form-floating mb-3">
                                <input type="text" name="codigo" class="form-control" placeholder="" id="txtCodigo">
                                <label>Código</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 py-2">
                        <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
                    </div>    
                    <div class="row">
                        <div class="col-12 d-flex">
                            <button class="btn-outline-warning btn w-100" type="submit">
                                <span class="p-1 px-md-5 p-1">Ingresar</span>
                            </button>
                            <a href="index.php?controlador=Tramites&metodo=InicioExterno" class="btn-outline-danger btn w-100">
                                <span class="p-1 px-md-5 p-1">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
</body>
</html>