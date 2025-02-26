<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tramitación | Municipalidad de Río Cuarto</title>
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
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid d-flex justify-content-center all pt-md-5 mt-5">
        <div class="card p-5 w-75">
            <div class="text-center p-md-5 p-1">
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <hr>
                <div class="my-md-2">
                    <span class="h5"><strong>Su cuenta ha sido creada exitosamente!</strong></span>
                    <p>A continuación, deberá ingresar a su cuenta <a href="index.php?controlador=Login&metodo=Index" style="text-decoration: none;">aquí</a>, donde podrá ver los requisitos para sus trámites y utilizar la plataforma</p>
                    <p>Sus trámites no entrarán en vigencia hasta que su cuenta sea validada por un funcionario de la <strong>Municipalidad de Río Cuarto</strong>, una vez sea validada su cuenta, se le enviará a su correo electrónico un código y verá en la plataforma el espacio para ingresarlo</p>
                    <a href="index.php?controlador=Tramites&metodo=InicioExterno" class="btn btn-warning">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="./Vista/assets/js/login.js"></script>
    <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
</body>
</html>