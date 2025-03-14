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
    <link href="./Web/css/styles.css" rel="stylesheet" />
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
                                <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Municipalidad">La Municipalidad</a></li>
                                <li><a class="dropdown-item" href="index.php?controlador=Web&metodo=Alcaldia">Alcaldía</a></li>
                                <li><a class="dropdown-item pagActual" href="index.php?controlador=Web&metodo=Departamentos">Departamentos</a></li>
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
                            <a class="nav-link" aria-current="page" href="index.php?controlador=Web&metodo=Contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
        <input type="hidden" id="tramites" value='<?php echo $tiposSolicitud; ?>'>
        <input type="hidden" id="deptos" value='<?php echo $deptos; ?>'>
        <section class="testimonials text-center">
            <div class="container">
                <h2 class="mb-4">Departamentos</h2>
                <hr class="mb-4">
                <div class="listadoDeptos">
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseAlcaldia" role="button">
                                <h4>Alcaldía</h4>
                                <span><svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#f3aa16" d="M240.1 4.2c9.8-5.6 21.9-5.6 31.8 0l171.8 98.1L448 104l0 .9 47.9 27.4c12.6 7.2 18.8 22 15.1 36s-16.4 23.8-30.9 23.8L32 192c-14.5 0-27.2-9.8-30.9-23.8s2.5-28.8 15.1-36L64 104.9l0-.9 4.4-1.6L240.1 4.2zM64 224l64 0 0 192 40 0 0-192 64 0 0 192 48 0 0-192 64 0 0 192 40 0 0-192 64 0 0 196.3c.6 .3 1.2 .7 1.8 1.1l48 32c11.7 7.8 17 22.4 12.9 35.9S494.1 512 480 512L32 512c-14.1 0-26.5-9.2-30.6-22.7s1.1-28.1 12.9-35.9l48-32c.6-.4 1.2-.7 1.8-1.1L64 224z" />
                                    </svg></span>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseAlcaldia">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseProveeduria" role="button">
                                <h4>Proveeduría</h4>
                                <span><svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#f3aa16" d="M192 0c-41.8 0-77.4 26.7-90.5 64L64 64C28.7 64 0 92.7 0 128L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64l-37.5 0C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM72 272a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm104-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM72 368a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm88 0c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z" />
                                    </svg></span>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseProveeduria">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseDptoLegal" role="button">
                                <h4>Departamento Legal</h4>
                                <span><svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#f3aa16" d="M384 32l128 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L398.4 96c-5.2 25.8-22.9 47.1-46.4 57.3L352 448l160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-192 0-192 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l160 0 0-294.7c-23.5-10.3-41.2-31.6-46.4-57.3L128 96c-17.7 0-32-14.3-32-32s14.3-32 32-32l128 0c14.6-19.4 37.8-32 64-32s49.4 12.6 64 32zm55.6 288l144.9 0L512 195.8 439.6 320zM512 416c-62.9 0-115.2-34-126-78.9c-2.6-11 1-22.3 6.7-32.1l95.2-163.2c5-8.6 14.2-13.8 24.1-13.8s19.1 5.3 24.1 13.8l95.2 163.2c5.7 9.8 9.3 21.1 6.7 32.1C627.2 382 574.9 416 512 416zM126.8 195.8L54.4 320l144.9 0L126.8 195.8zM.9 337.1c-2.6-11 1-22.3 6.7-32.1l95.2-163.2c5-8.6 14.2-13.8 24.1-13.8s19.1 5.3 24.1 13.8l95.2 163.2c5.7 9.8 9.3 21.1 6.7 32.1C242 382 189.7 416 126.8 416S11.7 382 .9 337.1z" />
                                    </svg></span>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseDptoLegal">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseCtrlUrbano" role="button">
                                <h4> Control Urbano</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M320 0a40 40 0 1 1 0 80 40 40 0 1 1 0-80zm44.7 164.3L375.8 253c1.6 13.2-7.7 25.1-20.8 26.8s-25.1-7.7-26.8-20.8l-4.4-35-7.6 0-4.4 35c-1.6 13.2-13.6 22.5-26.8 20.8s-22.5-13.6-20.8-26.8l11.1-88.8L255.5 181c-10.1 8.6-25.3 7.3-33.8-2.8s-7.3-25.3 2.8-33.8l27.9-23.6C271.3 104.8 295.3 96 320 96s48.7 8.8 67.6 24.7l27.9 23.6c10.1 8.6 11.4 23.7 2.8 33.8s-23.7 11.4-33.8 2.8l-19.8-16.7zM40 64c22.1 0 40 17.9 40 40l0 40 0 80 0 40.2c0 17 6.7 33.3 18.7 45.3l51.1 51.1c8.3 8.3 21.3 9.6 31 3.1c12.9-8.6 14.7-26.9 3.7-37.8l-15.2-15.2-32-32c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l32 32 15.2 15.2c0 0 0 0 0 0l25.3 25.3c21 21 32.8 49.5 32.8 79.2l0 78.9c0 26.5-21.5 48-48 48l-66.7 0c-17 0-33.3-6.7-45.3-18.7L28.1 393.4C10.1 375.4 0 351 0 325.5L0 224l0-64 0-56C0 81.9 17.9 64 40 64zm560 0c22.1 0 40 17.9 40 40l0 56 0 64 0 101.5c0 25.5-10.1 49.9-28.1 67.9L512 493.3c-12 12-28.3 18.7-45.3 18.7L400 512c-26.5 0-48-21.5-48-48l0-78.9c0-29.7 11.8-58.2 32.8-79.2l25.3-25.3c0 0 0 0 0 0l15.2-15.2 32-32c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-32 32-15.2 15.2c-11 11-9.2 29.2 3.7 37.8c9.7 6.5 22.7 5.2 31-3.1l51.1-51.1c12-12 18.7-28.3 18.7-45.3l0-40.2 0-80 0-40c0-22.1 17.9-40 40-40z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseCtrlUrbano">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseCatastroValoracion" role="button">
                                <h4> Catastro y Valoración</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zm-312 8l0 64c0 13.3 10.7 24 24 24s24-10.7 24-24l0-64c0-13.3-10.7-24-24-24s-24 10.7-24 24zm80-96l0 160c0 13.3 10.7 24 24 24s24-10.7 24-24l0-160c0-13.3-10.7-24-24-24s-24 10.7-24 24zm80 64l0 96c0 13.3 10.7 24 24 24s24-10.7 24-24l0-96c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseCatastroValoracion">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto6"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseUdTecVial" role="button">
                                <h4> Unidad Técnica de Gestión Vial </h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M213.2 32L288 32l0 64c0 17.7 14.3 32 32 32s32-14.3 32-32l0-64 74.8 0c27.1 0 51.3 17.1 60.3 42.6l42.7 120.6c-10.9-2.1-22.2-3.2-33.8-3.2c-59.5 0-112.1 29.6-144 74.8l0-42.8c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32c2.3 0 4.6-.3 6.8-.7c-4.5 15.5-6.8 31.8-6.8 48.7c0 5.4 .2 10.7 .7 16l-.7 0c-17.7 0-32 14.3-32 32l0 64L86.6 480C56.5 480 32 455.5 32 425.4c0-6.2 1.1-12.4 3.1-18.2L152.9 74.6C162 49.1 186.1 32 213.2 32zM352 368a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm211.3-43.3c-6.2-6.2-16.4-6.2-22.6 0L480 385.4l-28.7-28.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l40 40c6.2 6.2 16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseUdTecVial">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto7"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseFinancieraTrib" role="button">
                                <h4>Dirección Financiera y Tributaria</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M312 24l0 10.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3s0 0 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8l0 10.6c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-11.4c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2L264 24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L192 512 32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l36.8 0 44.9-36c22.7-18.2 50.9-28 80-28l78.3 0 16 0 64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l120.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384c0 0 0 0 0 0l-.9 0c.3 0 .6 0 .9 0z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseFinancieraTrib">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto8"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapsePlataforma" role="button">
                                <h4>Plataforma</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapsePlataforma">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto9"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapsePatentes" role="button">
                                <h4>Patentes</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5L0 80C0 53.5 21.5 32 48 32l149.5 0c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapsePatentes">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto10"></div>
                            </div>
                        </div>
                    </div>
                    <div class="udDepartamento">
                        <p class="d-inline-flex gap-1">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between departamento" data-bs-toggle="collapse" href="#collapseSecretaria" role="button">
                                <h4> Secretaría del Concejo</h4>
                                <svg class="iconDpto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#f3aa16" d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                </svg>
                            </div>
                        </div>
                        </p>
                        <div class="collapse" id="collapseSecretaria">
                            <div class="card card-body">
                                <div class="row justify-content-between" id="listadoDepto11"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal de Contacto-->
    <div class="modal fade" id="modalContacto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Comunicarse con <span id="nombreComunicar"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <input type="file" class="form-control" name="adjuntos[]" multiple id="idAdjuntos">
                    </div>
                    <input type="hidden" value="0" id="idConsultado">
                    <input type="hidden" id="tipoConsulta" value="1">
                    <div class="mb-2 text-end">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCaptcha" id="btnEnviarCaptcha">
                            <span>Enviar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="modalDocs" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Documentos Departamentales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="docs">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTramites" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Trámites Departamentales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="tramitesModal">
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
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#0f1a4f" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                            </svg>
                            400m Norte del Templo Católico Rio Cuarto, Alajuela, Costa Rica
                        </li>
                        <li class="mb-3">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#0f1a4f" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                            </svg>
                            <a href="tel:+50640001600" class="footer-link">4000 1600</a>
                        </li>
                        <li class="mb-3">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#0f1a4f" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                            </svg>
                            <a href="mailto:consultas@muniriocuarto.go.cr" class="footer-link">consultas@muniriocuarto.go.cr</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright: Municipalidad de Río Cuarto
            <hr class="mx-5">Desarrollado por <a style="text-decoration: none; color:#0f1a4f" target="_blank" href="https://xalachi.com/">Xalachi</a>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./Web/assets/js/conformaciones.js"></script>
        <script src="./Web/assets/js/correos.js"></script>
        <script src="js/scripts.js"></script>
</body>

</html>