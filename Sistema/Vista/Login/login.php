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
    <div class="container-fluid d-flex align-items-center justify-content-center all mt-md-5">
        <div class="card p-5">
            <div class="text-center">
                <h4 class="h3">Ingrese</h4>
                <hr>
                <form action="index.php?controlador=Login&metodo=Login" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" name="cedula" class="form-control" placeholder="">
                        <label>Correo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="cedula" class="form-control" placeholder="">
                        <label>Contraseña</label>
                    </div>
                    <button class="btn-outline-warning btn w-100" type="submit">
                        <span class="p-1 px-5">Listo</span>
                    </button>  
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</body>
</html>