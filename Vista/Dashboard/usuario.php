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
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cambiarContraseña">
                    <span>Cambiar Contraseña</span>
                </button>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalFotoPerfil">
                    <span>Cambiar Foto</span>
                </button>
            </div>
        </div>
    </div>
  </main>
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
    </form>
</div>
<div class="modal fade" id="modalContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </form>
</div>
<script src="./Vista/assets/js/patentes.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>