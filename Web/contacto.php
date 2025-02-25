<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Municipalidad de Río Cuarto</title>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link rel="icon" type="image/x-icon" href="./Web/assets/img/Municipalidad de Rio Cuarto.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="./Web/css/styles.css" rel="stylesheet"/>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-body-transparent py-4" style="background-color: #0f1a4f;">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">
                    <div class="mx-3 mx-md-5">
                        <img src="./Web/assets/img/Municipalidad de Rio Cuarto.png" class="img-fluid" alt="">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-1">
                        <a href="./index.php?controlador=Login&metodo=Index" class="btn btn-outline-warning mx-1 mt-md-none mt-1">
                            <span style="font-size: 1em;">Trámites</span>
                        </a>
                        <a href="https://comercio.ifam.go.cr/riocuarto" class="btn btn-outline-warning mx-1 mt-md-none mt-1">
                            <span style="font-size: 1em;">Consultar Estado de Cuenta</span>
                        </a>
                    </ul>
                    <div class="navbar-text px-md-5">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Nosotros</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Municipalidad">La Municipalidad</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Alcaldia">Alcaldía</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Departamentos">Departamentos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Nuestro Cantón</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=NuestroCanton">Nuestro Cantón</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Noticias">Noticias</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Actividades">¿Qué hacer?</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Himno">Himno</a></li>
                                    <li><a class="dropdown-item" href="https://munirc.maps.arcgis.com/home/index.html">Visor Geográfico</a></li>
                                    <li><a class="dropdown-item" href="https://muniriocuarto-my.sharepoint.com/personal/ti_muniriocuarto_go_cr1/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables%2F216%5FZonasHomog%C3%A9neas%2Epdf&parent=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables&ga=1">Zonas Homogéneas</a></li>
                                    <li><a class="dropdown-item" href="https://muniriocuarto-my.sharepoint.com/personal/ti_muniriocuarto_go_cr1/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables%2F216%5FZonas%5FAgropecuarias%5FPVA%20%2Epdf&parent=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables&ga=1">Zonas Agropecuarias</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Concejo Municipal</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Conformacion">Conformación</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Sesiones">Sesiones</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pagActual" aria-current="page" href="index.php?controlador=Web&metodo=Contacto">Contacto</a>
                            </li>
                        </ul>
                    </div>
              </div>
            </div>
        </nav>
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-md-6 order-md-1 order-2 showcase-img d-flex align-items-center justify-content-center">
                        <div class="card p-5 m-md-5 w-100">
                            <span class="lead mb-1">Si tiene algún consulta o necesita ayuda, no dude en escribirnos Haremos todo lo posible por darle respuesta a la brevedad.</span>
                            <div class="udDepartamento" id="consulta">
                                <p class="d-inline-flex gap-1">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between departamento"  data-bs-toggle="collapse" href="#collapseConsulta" role="button">
                                            <h4>Consultas</h4>
                                            <span><svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#f3aa16" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>                                            
                                        </div>
                                    </div>
                                </p>
                                <div class="collapse" id="collapseConsulta">
                                <div class="mb-2">
                                        <label for="" class="form-label">Identificación *</label>
                                        <input type="email" class="form-control" id="identificacionConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Nombre Completo *</label>
                                        <input type="email" class="form-control" id="nombreConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Telefono *</label>
                                        <input type="text" class="form-control" id="telefonoConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Correo *</label>
                                        <input type="text" class="form-control" id="correoConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Asunto *</label>
                                        <input type="text" class="form-control" id="asuntoConsulta">
                                    </div>                                
                                    <div class="mb-2">
                                        <label for="" class="form-label">Consulta *</label>
                                        <textarea name="" class="form-control" id="cuerpoConsulta"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Adjuntos</label>
                                        <input type="file" class="form-control"  name="adjuntos[]" multiple id="idAdjuntos">
                                    </div>
                                    <input type="hidden" id="tipoConsulta" value="2">
                                    <input type="hidden" value="0" id="idConsultado">
                                    <div class="mb-2 text-end">
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCaptcha" id="btnEnviarCaptcha" onclick="EnviarCaptcha();">
                                            <span>Enviar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="udDepartamento" id="denuncias">
                                <p class="d-inline-flex gap-1">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between departamento"  data-bs-toggle="collapse" href="#collapseDenuncias" role="button">
                                            <h4>Denuncias</h4>
                                            <span><svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#f3aa16" d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32L0 64 0 368 0 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 64.3-16.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-247.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L64 48l0-16z"/></svg></span>
                                        </div>
                                    </div>
                                </p>
                                <div class="collapse" id="collapseDenuncias">                                        
                                    <div class="mb-2">
                                        <label for="" class="form-label">Identificación *</label>
                                        <input type="email" class="form-control" id="identificacionConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Nombre Completo *</label>
                                        <input type="email" class="form-control" id="nombreConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Telefono *</label>
                                        <input type="text" class="form-control" id="telefonoConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Correo *</label>
                                        <input type="text" class="form-control" id="correoConsulta">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Asunto *</label>
                                        <input type="text" class="form-control" id="asuntoConsulta">
                                    </div>                                
                                    <div class="mb-2">
                                        <label for="" class="form-label">Consulta *</label>
                                        <textarea name="" class="form-control" id="cuerpoConsulta"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Adjuntos</label>
                                        <input type="file" class="form-control"  name="adjuntos[]" multiple id="idAdjuntos">
                                    </div>
                                    <input type="hidden" id="tipoConsulta" value="1">
                                    <input type="hidden" value="0" id="idConsultado">
                                    <div class="mb-2 text-end">
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCaptcha" id="btnEnviarCaptcha" onclick="EnviarCaptcha();">
                                            <span>Enviar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-md-2 order-1 my-auto showcase-text">
                        <h2>Contactenos!</h2>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                                400m Norte del Templo Católico Rio Cuarto, Alajuela, Costa Rica
                            </li>
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                                <a href="tel:+50640001600" class="linksContacto">4000 1600</a>
                            </li>
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <a href="mailto:consultas@muniriocuarto.go.cr" class="linksContacto">consultas@muniriocuarto.go.cr</a>
                            </li>
                        </ul>
                        <div class="rsIframeCont">
                            <iframe class="rsIframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.948169697563!2d-84.2143088526766!3d10.346029570340656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa089e9cbb4f8d9%3A0x9bb3964132b8b8c9!2sMunicipalidad%20de%20R%C3%ADo%20Cuarto!5e0!3m2!1ses-419!2scr!4v1737221591371!5m2!1ses-419!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <?php if ($consulta == NULL) {?>
                            <div class="card p-5 mt-1">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <h4>
                                        <?php 
                                            if($estadisticas != null){
                                                echo $estadisticas['Totales'];
                                            } else {
                                                echo '0';
                                            }
                                        ?>
                                        </h4>
                                        <p>Consultas Totales</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h4>
                                        <?php 
                                            if($estadisticas != null){
                                                echo $estadisticas['FechaHoy'];
                                            } else {
                                                echo '0';
                                            }
                                        ?>
                                        </h4>
                                        <p>Consultas Recibidas Hoy</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h4>
                                        <?php 
                                            if($estadisticas != null){
                                                echo $estadisticas['Pendientes'];
                                            } else {
                                                echo '0';
                                            }
                                        ?>
                                        </h4>
                                        <p>Pendientes de atención</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="text-center text-lg-start" style="background-color: #f3aa16;">
            <div class="container">
                <div class="row g-4 my-1 py-3 d-flex justify-content-between">
                    <!-- Company Info -->
                    <div class="col-lg-4 col-md-6">
                        <h5 class="mb-4">Sobre Río Cuarto</h5>
                        <p class="mb-4">Cantón número 82 del país, parte de la provincia de Alajuela <br>
                            Averigua más sobre <a href="" class="footer-link">nuestra historia</a>
                        </p>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-lg-4 col-md-6">
                        <h5 class="mb-4">Contáctenos!</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                                400m Norte del Templo Católico Rio Cuarto, Alajuela, Costa Rica
                            </li>
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                                <a href="tel:+50640001600" class="footer-link">4000 1600</a>
                            </li>
                            <li class="mb-3">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <a href="mailto:consultas@muniriocuarto.go.cr" class="footer-link">consultas@muniriocuarto.go.cr</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2024 Copyright: Municipalidad de Río Cuarto
            </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <div class="modal fade" id="modalCaptcha" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="titulo">Captcha</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-2" id="infoModal">
                                <label for="" class="form-label" id="catpchaInfo">Ingrese el siguiente código para enviar su consulta:</label>
                                <span class="h6" id="captchaText"></span>
                                <input type="email" class="form-control" id="captchaInput">
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" id="btnEnviarCorreo">
                            <span>Enviar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./Web/assets/js/correos.js"></script>
    </body>
</html>
