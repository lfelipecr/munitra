<link href="./Vista/assets/css/estilos.css" rel="stylesheet" />
<main class="col-sm-12 bg-body-tertiary" id="main">
    <div class="container-fluid px-md-5">
        <input type="hidden" id="usuario" value='<?php echo $usuario; ?>'>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
            <h1 class="h2">Trámites</h1>
            <a href="index.php?controlador=Tramites&metodo=InicioExterno" class="btn mt-1 btn-outline-secondary">
                <span><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="currentColor" d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                    </svg></span>
            </a>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <?php if ($estado == 5) { ?>
                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=IngresarCodigo';">
                        <h4>Verificar Cuenta - <a href="#" class="link-blog">Ir</a></h4>
                        <hr>
                        <p>Verifique su cuenta para que sus trámites entren en vigencia, ingresando el código enviado a su correo</p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 mb-3">
                <?php if ($estado == 3) { ?>
                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Credenciales';">
                        <h4>Ingrese sus Credenciales - <a href="#" class="link-blog">Ir</a></h4>
                        <hr>
                        <p>Verifique su cuenta para que sus trámites entren en vigencia, enviando una confirmación fotográfica de sus credenciales, su firma y un consentimiento</p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 mb-3 col-md-6">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Patentes';">
                    <h4>Solicitud de Patentes - <a href="#" class="link-blog">Ir</a></h4>
                    <hr>
                    <p>Formulario de solicitud de patentes</p>
                </div>
            </div>
            <div class="col-12 mb-3 col-md-6">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=UsoSuelo';">
                    <h4>Solicitud de Uso de Suelo - <a href="#" class="link-blog">Ir</a></h4>
                    <hr>
                    <p>Formulario de solicitud de uso de suelo</p>
                </div>
            </div>
            <div class="col-12 mb-3 col-md-6">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Visado';">
                    <h4>Solicitud de Visado - <a href="#" class="link-blog">Ir</a></h4>
                    <hr>
                    <p>Planifique sesiones y comparta documentos de relevancia para la población cantonal</p>
                </div>
            </div>
            <div class="col-12 mb-3 col-md-6">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Condonacion';">
                    <h4>Solicitud de Condonación - <a href="#" class="link-blog">Ir</a></h4>
                    <hr>
                    <p>Publique acontecimientos y proyectos municipales de valor para la población cantonal</p>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Declaraciones';">
                    <h4>Declaraciones - <a href="#" class="link-blog">Ir</a></h4>
                    <hr>
                    <p>Modifique la información sobre actividades cantonales y lugares de interés</p>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./Vista/assets/js/credenciales.js"></script>