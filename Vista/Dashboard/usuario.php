<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
            <h1 class="h2">Mi Perfil</h1>
            <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-secondary">
                <span>x</span>
            </a>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <img src="<?php echo $imagen->getUrlImagen() ?>" class="rounded-circle img-fluid w-25" alt="Imagen redondeada">
            </div>
            <div class="col-12 mt-md-5">
                <h1 class="h3"><?php echo $persona->getNombre()." ".$persona->getPrimerApellido()." ".$persona->getSegundoApellido(); ?></h1>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-md-4 mt-3">
                <span><strong>Identificacion:</strong></span>
                <span><?php echo $persona->getIdentificacion(); ?></span>
            </div>
            <div class="col-md-4 mt-3">
                <span><strong>Correo:</strong></span>
                <span><?php echo $persona->getCorreo(); ?></span>
            </div>
            <div class="col-md-4 mt-3">
                <span><strong>Dirección:</strong></span>
                <span><?php echo $persona->getDireccion(); ?></span>
            </div>
            <div class="col-md-4 mt-3">
                <span><strong>Telefono:</strong></span>
                <span><?php echo $persona->getTelefono(); ?></span>
            </div>
            <div class="col-md-4 mt-3">
                <span><strong>Whatsapp:</strong></span>
                <span><?php echo $persona->getWhatsapp(); ?></span>
            </div>
            <div class="col-md-4 mt-3">
                <span><strong>Activo desde:</strong></span>
                <span><?php echo $persona->getFechaCreacion(); ?></span>
            </div>
            <div class="col-12 mt-4">
                <button class="btn btn-outline-primary" id="cambiarContra" data-bs-toggle="modal" data-bs-target="#modalCodigo">
                    <span>Cambiar Contraseña</span>
                </button>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalFotoPerfil">
                    <span>Cambiar Foto</span>
                </button>
            </div>
        </div>
    </div>
  </main>
<div class="modal fade" id="modalContra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Codigo de Confirmación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="contraTag">Ingrese su Contraseña</span>
                <input type="password" class="form-control" id="contra">
                <span class="mt-2">Confirmar Contraseña</span>
                <input type="password" class="form-control" id="contraConfir">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-warning" id="enviarContra">Enviar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCodigo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Codigo de Confirmación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="contenido">Se ha enviado un código de confirmación a su correo electrónico, introduzca el código para verificar su identidad</span>
                <input type="text" class="form-control" name="" id="codigo">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-warning" id="enviarCodigo">Enviar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalFotoPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="index.php?controlador=Usuario&metodo=CambiarFotoPerfil" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto de Perfil (jpg, png, jpeg)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">            
                    <input type="file" class="form-control" name="foto">
                    <input type="hidden" name="idFoto" value="<?php echo $imagen->getId(); ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-warning">Subir</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script>
    $('#cambiarContra').on('click', function (){
        $.ajax({
            url: "index.php?controlador=Login&metodo=GenerarCodigo",
            type: "GET",
            success: function (response) {
                if (response == ''){
                    $('#contenido').html('Ha ocurrido un error, intente nuevamente');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    });
    $('#enviarCodigo').on('click', function (){
        $.ajax({
            url: "index.php?controlador=Login&metodo=VerificarCodigo",
            type: "POST",
            data: {codigo : $('#codigo').val()},
            success: function (response) {   
                if (response != ''){
                    if (response ==  '200'){
                        $('#contenido').html('Se ha enviado un código de confirmación a su correo electrónico, introduzca el código para verificar su identidad');
                        $('#modalContra').modal('show');
                        $('#modalCodigo').modal('hide');
                    } else {
                        $('#contenido').html('Ha ocurrido un error, intente nuevamente');
                    }
                } else {
                    $('#contenido').html('Ha ocurrido un error, intente nuevamente');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    });
    $('#enviarContra').on('click', function (){
        if ($('#contra').val() == $('#contraConfir').val()){
            $.ajax({
            url: "index.php?controlador=Login&metodo=CambiarContra",
            type: "POST",
            data: {contra : $('#contra').val()},
            success: function (response) {
                if (response != ''){
                    if (response ==  '200'){
                        $('#contraTag').html('Cambio de Contraseña Exitoso');
                    } else {
                        $('#contraTag').html('Ha ocurrido un error, intente nuevamente');
                    }
                } else {
                    $('#contraTag').html('Ha ocurrido un error, intente nuevamente');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
        } else {
            $('#contraTag').html('Ingrese su Contraseña. Las Contraseñas deben coincidir');
        }
    });
</script>