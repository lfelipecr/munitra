<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tramitación | Municipalidad de Río Cuarto</title>
    <link rel="icon" type="image/x-icon" href="./Vista/assets/img/icon.png" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./Vista/assets/img/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./Vista/assets/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
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
        <div class="card p-1">
            <div class="text-center p-md-5 p-1">
                <h4 class="h3">Registro</h4>
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <hr>
                <input type="hidden" id="msg" value="<?php echo $msg; ?>">
                <form action="index.php?controlador=Login&metodo=RegistrarUsuario" id="frmIngresar"  method="post" class="text-start">
                    <div class="my-1 p-3">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <span class="mb-3">Tipo de Identificacion (*)</span>
                            <select name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
                                <option value="1">Cedula de Identidad</option>
                                <option value="2">Pasaporte</option>
                                <option value="3">Cédula de Residencia</option>
                                <option value="4">Número Interno</option>
                                <option value="5">Número Asegurado</option>
                                <option value="6">DIMEX</option>
                                <option value="7">NITE</option>
                                <option value="8">DIDI</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span class="mb-3">Identificacion (*)</span>
                            <input type="text" class="form-control mb-3" name="identificacion" id="txtIdentificacion">
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Nombre (*)</span>
                            <input type="text" class="form-control mb-3 dataPersona" name="nombre" id="txtNombre">
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Primer Apellido (*)</span>
                            <input type="text" class="form-control mb-3 dataPersona" name="apellido1" id="txtApellido1">
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Segundo Apellido</span>
                            <input type="text" class="form-control mb-3 dataPersona" name="apellido2" id="txtApellido2">
                        </div>
                        <div class="col-12">
                            <span class="mb-3">Dirección (*)</span>
                            <input type="text" class="form-control mb-3 dataPersona" name="direccion" id="txtDireccion">
                        </div>
                        <div class="col-md-6">
                            <span class="mb-3">Teléfono</span>
                            <input type="number" class="form-control mb-3 dataPersona" name="telefono" id="txtTelefono">
                        </div>
                        <div class="col-md-6">
                            <span class="mb-3">Whatsapp</span>
                            <input type="number" class="form-control mb-3 dataPersona" name="whatsapp" id="txtWhatsapp">
                        </div>
                        <div class="col-md-12">
                            <span class="mb-3">Correo (*)</span>
                            <input type="text" class="form-control mb-3 dataPersona" name="correo" id="txtCorreo">
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="consentimiento" value="0">
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Provincia (*)</span>
                            <select name="provincia" class="form-control" id="slProvincia">
                                <?php for ($i = 0; $i < sizeof($arrLocaciones[0]); $i++) {?>
                                <option value="<?php echo $arrLocaciones[0][$i]->getId();?>">
                                    <span><?php echo $arrLocaciones[0][$i]->getNombre();?></span>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Cantón (*)</span>
                            <select name="canton" class="form-control" id="slCanton">
                                <?php for ($i = 0; $i < sizeof($arrLocaciones[1]); $i++) {?>
                                <option value="<?php echo $arrLocaciones[1][$i]->getId();?>">
                                    <span><?php echo $arrLocaciones[1][$i]->getNombre();?></span>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span class="mb-3">Distrito (*)</span>
                            <select name="distrito" class="form-control" id="slDistrito">
                                <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) {?>
                                <option value="<?php echo $arrLocaciones[2][$i]->getId();?>">
                                    <span><?php echo $arrLocaciones[2][$i]->getNombre();?></span>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-1">
                            <input type="hidden" class="form-control mb-3" name="nombreUsuario" id="txtNombreUsuario">
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" value="1" name="depto" id="slDepto">
                        </div>
                        <div class="col-md-6">
                            <span class="mb-3">Contraseña (*)</span>
                            <input type="password" class="form-control mb-3" name="pass" id="txtPass1">
                        </div>
                        <div class="col-md-6">
                            <span class="mb-3">Confirme su contraseña (*)</span>
                            <input type="password" class="form-control mb-3" id="txtPass2">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="hidden" name="estado" id="lsEstado" value="3">
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="responsable" value="0" id="valorResponsable">
                        </div>
                        <div class="col-12 py-2">
                            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
                        </div>
                        <div class="col-12 d-flex align-items-center mb-3">
                            <button type="submit" class="btn btn-outline-warning mx-1">
                                <span>Ingresar +</span>
                            </button>
                            <a href="index.php" class="btn btn-outline-danger mx-1">
                                <span>Cancelar x</span>
                            </a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="./Vista/assets/js/registro.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./Vista/assets/js/busquedaDinamicaCedula.js"></script>
    <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
</body>
</html>