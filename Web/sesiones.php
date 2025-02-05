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
        <link rel="icon" type="image/x-icon" href="assets/img/Municipalidad de Rio Cuarto.png" />
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
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Noticias">Noticias</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Actividades">¿Qué hacer?</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Himno">Himno</a></li>
                                    <li><a class="dropdown-item" href="https://munirc.maps.arcgis.com/home/index.html">Visor Geográfico</a></li>
                                    <li><a class="dropdown-item" href="https://muniriocuarto-my.sharepoint.com/personal/ti_muniriocuarto_go_cr1/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables%2F216%5FZonasHomog%C3%A9neas%2Epdf&parent=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables&ga=1">Zonas Homogéneas</a></li>
                                    <li><a class="dropdown-item" href="https://muniriocuarto-my.sharepoint.com/personal/ti_muniriocuarto_go_cr1/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables%2F216%5FZonas%5FAgropecuarias%5FPVA%20%2Epdf&parent=%2Fpersonal%2Fti%5Fmuniriocuarto%5Fgo%5Fcr1%2FDocuments%2FDescargables&ga=1">Zonas Agropecuarias</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle pagActual" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Concejo Municipal</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Conformacion">Conformación</a></li>
                                    <li><a class="dropdown-item pagActual" href="index.php?controlador=Web&metodo=Sesiones">Sesiones</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?controlador=Web&metodo=Contacto">Contacto</a>
                            </li>
                        </ul>
                    </div>
              </div>
            </div>
        </nav>
        <div class="container">
            <div class="row text-center mt-md-5 mt-4 mx-3">
                <h1>Sesiones</h1>
                <p>Noticias Relevantes sobre la Municipalidad</p>
                <div class="col-12 col-md-3 text-center d-flex justify-content-center">
                    <select name=""  class="form-control" id="">
                        <option value="">2024</option>
                        <option value="">2025</option>
                    </select>
                </div>
                <div class="col-md-9"></div>
            </div>
            <hr>
            <div class="row mb-3">
                
                <div class="col-md-4 text-center d-flex justify-content-center">
                    <div class="card my-1" style="width: 18rem;">
                        <div class="bgNoticiaNoPic"></div>
                        <!--<img src="..." class="card-img-top" alt="...">-->
                        <div class="card-body">
                          <h5 class="card-title mb-3">Sesión - Año</h5>
                          <a href="noticia.html" class="btn btn-outline-warning">Descargar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex justify-content-center">
                    <div class="card my-1" style="width: 18rem;">
                        <div class="bgNoticiaNoPic"></div>
                        <!--<img src="..." class="card-img-top" alt="...">-->
                        <div class="card-body">
                          <h5 class="card-title mb-3">Sesión - Año</h5>
                          <a href="noticia.html" class="btn btn-outline-warning">Descargar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex justify-content-center">
                    <div class="card my-1" style="width: 18rem;">
                        <div class="bgNoticiaNoPic"></div>
                        <!--<img src="..." class="card-img-top" alt="...">-->
                        <div class="card-body">
                          <h5 class="card-title mb-3">Sesión - Año</h5>
                          <a href="noticia.html" class="btn btn-outline-warning">Descargar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </body>
</html>
