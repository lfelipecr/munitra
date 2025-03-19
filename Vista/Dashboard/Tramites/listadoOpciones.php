<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
            <h1 class="h2">Trámites</h1>
        </div>
        <div class="row">
            <?php if ($depto == 10 || $depto == DEPARTAMENTO_ADMINISTRADOR || $depto == DEPARAMENTO_PRUEBAS) { ?>
                <div class="col-12 mb-3 col-md-6">
                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Patentes';">
                        <h4>Solicitud de Patentes - <a href="#" class="link-blog">Ir</a></h4>
                        <hr>
                        <p>Formulario de solicitud de patentes</p>
                    </div>
                </div>
            <?php } ?>
            <?php if ($depto == 6 || $depto == DEPARTAMENTO_ADMINISTRADOR || $depto == DEPARAMENTO_PRUEBAS) { ?>
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
            <?php } ?>
            <?php if ($depto == 9 || $depto == DEPARTAMENTO_ADMINISTRADOR || $depto == DEPARAMENTO_PRUEBAS) { ?>
                <div class="col-12 mb-3 col-md-6">
                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Condonacion';">
                        <h4>Solicitud de Condonación - <a href="#" class="link-blog">Ir</a></h4>
                        <hr>
                        <p>Publique acontecimientos y proyectos municipales de valor para la población cantonal</p>
                    </div>
                </div>
            <?php } ?>
            <?php if ($depto == 9 || $depto == 6 || $depto == DEPARTAMENTO_ADMINISTRADOR || $depto == DEPARAMENTO_PRUEBAS) { ?>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card p-5 cardOpciones" onclick="window.location.href='index.php?controlador=Tramites&metodo=Declaraciones';">
                        <h4>Declaraciones - <a href="#" class="link-blog">Ir</a></h4>
                        <hr>
                        <p>Modifique la información sobre actividades cantonales y lugares de interés</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>