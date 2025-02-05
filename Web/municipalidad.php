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
                                <a class="nav-link dropdown-toggle pagActual" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Nosotros</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item pagActual" href="index.php?controlador=Web&metodo=Municipalidad">La Municipalidad</a></li>
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
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Concejo Municipal</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Conformacion">Conformación</a></li>
                                    <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Sesiones">Sesiones</a></li>
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
                <h1>La Municipalidad</h1>
                <p>La municipalidad es el gobierno local de cada cantón de Costa Rica, siendo este su ámbito de acción. Cada municipalidad es una persona jurídica estatal con patrimonio propio encargada de la administración de los intereses y servicios locales, entre otras atribuciones. La Constitución Política le otorga autonomía política, financiera y administrativa en su actuar con el fin de que pueda levar a cabo sus funciones y satisfacer el interés de sus administrados de forma eficiente y eficaz.</p>
            </div>
            <div class="row mt-md-1 mt-2 mx-3">
                <p class="d-inline-flex gap-1">
                    <a class="collap-link" data-bs-toggle="collapse" href="#sabermas" role="button">
                       Saber más
                    </a>
                </p>
                <div class="collapse" id="sabermas">
                    <div class="card card-body">
                        Las funciones que desempeña la municipalidad se orientan a la satisfacción de las necesidades de las personas que habitan en el cantón, dentro de estas se encuentran: 
                        <ul>
                            <li>Dictar los reglamentos autónomos de organización y servicio, así como cualquier otra disposición que autorice el ordenamiento jurídico; </li>
                            <li>Acordar sus presupuestos y ejecutarlos</li>
                            <li>Administrar y prestar los servicios públicos municipales, aprobar las tasas, los precios y las contribuciones municipales, y proponer los proyectos de tarifas de impuestos municipales</li>
                            <li>Percibir y administrar, en su carácter de administración tributaria, los tributos y demás ingresos municipales</li>
                            <li>Concertar, con personas o entidades nacionales o extranjeras, pactos, convenios o contratos necesarios para el cumplimiento de sus funciones</li>
                            <li>Convocar al municipio a consultas populares</li>
                            <li>Promover un desarrollo local participativo e inclusivo, que contemple la diversidad de las necesidades y los intereses de la población</li>
                            <li>Impulsar políticas públicas locales para la promoción de los derechos y la ciudadanía de las mujeres, en favor de la igualdad y la equidad de género.</li>
                        </ul>
                        La Municipalidad de Río Cuarto es la de más reciente creación del país, creada el 20 de mayo de 2017 mediante la Ley de Creación del Cantón XVI Río Cuarto de la provincia de Alajuela, Ley N°. 9440. 
                    </div>
                </div>
            </div>
            <section class="features-icons text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                                <div class="features-icons-icon d-flex">
                                    <svg style="width: 5em;" class="m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M224 32L64 32C46.3 32 32 46.3 32 64l0 64c0 17.7 14.3 32 32 32l377.4 0c4.2 0 8.3-1.7 11.3-4.7l48-48c6.2-6.2 6.2-16.4 0-22.6l-48-48c-3-3-7.1-4.7-11.3-4.7L288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32zM480 256c0-17.7-14.3-32-32-32l-160 0 0-32-64 0 0 32L70.6 224c-4.2 0-8.3 1.7-11.3 4.7l-48 48c-6.2 6.2-6.2 16.4 0 22.6l48 48c3 3 7.1 4.7 11.3 4.7L448 352c17.7 0 32-14.3 32-32l0-64zM288 480l0-96-64 0 0 96c0 17.7 14.3 32 32 32s32-14.3 32-32z"/></svg>
                                </div>
                                <h3>Misión</h3>
                                <p class="lead mb-0">Río Cuarto es un cantón que combina el territorio urbano rural y cuya principal fortaleza son sus habitantes que trabajan en el día a día para lograr un mejor lugar para vivir y trabajar”</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                                <div class="features-icons-icon d-flex">
                                    <svg style="width: 5em;" class="m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z"/></svg>
                                </div>
                                <h3>Visión</h3>
                                <p class="lead mb-0">Río Cuarto es un cantón universal y próspero con un desarrollo equilibrado e integrado </p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                                <div class="features-icons-icon d-flex">
                                    <svg style="width: 5em;" class="m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0f1a4f" d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8l0 378.1C394 378 431.1 230.1 432 141.4L256 66.8s0 0 0 0z"/></svg>
                                </div>
                                <h3>Valores</h3>
                                <p class="lead mb-0">
                                    <div class="row">
                                        <div class="col-md-6 d-block">
                                            <p class="lead">Compromiso</p>
                                            <p class="lead">Responsabilidad</p>
                                            <p class="lead">Paz</p>
                                            <p class="lead">Equidad</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="lead">Honestidad</p>
                                            <p class="lead">Igualdad</p>
                                            <p class="lead">Respeto</p>
                                            <p class="lead">Solidaridad</p>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
