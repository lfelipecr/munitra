<link href="./Vista/assets/css/estilos.css" rel="stylesheet" />
<main class="col-sm-12" id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
            <h1 class="h2">Mi Perfil</h1>
        </div>
        <div class="row text-center">
            <div class="col-12 mt-md-5">
                <h1 class="h3"><?php echo $persona->getNombre() . " " . $persona->getPrimerApellido() . " " . $persona->getSegundoApellido(); ?></h1>
                <input type="hidden" id="idPersona" value="<?php echo $persona->getId(); ?>">
            </div>
            <div class="col-12">
                <hr>
            </div>
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
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCedula">
                    <span>Copia de su Cédula</span>
                </button>
                <a href="index.php?controlador=Tramites&amp;metodo=InicioExterno" class="btn mt-1 btn-outline-secondary">
                    <span><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="currentColor" d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"></path>
                    </svg>
                </span>
            </a>
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
<div class="modal fade" id="modalCedula" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titulo">Copia de la Cédula</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2" id="infoModal">
          <div class="row">
            <div class="col-md-6 mt-md-4">
              <span class="mb-3">Cédula por delante <strong>(Opcional)</strong></span>
              <input type="file" class="form-control mb-3" name="cedulaFrontal" id="cedulaFrontal">
            </div>
            <div class="col-md-6 mt-md-4">
              <span class="mb-3">Cédula por detrás <strong>(Opcional)</strong></span>
              <input type="file" class="form-control mb-3" name="cedulaTrasera" id="cedulaTrasera">
            </div>
            <?php if ($persona->getCedulaFrontal() != null || $persona->getCedulaTrasera() != null) { ?>
              <div class="col-md-6">
                <a href="<?php echo $persona->getCedulaFrontal(); ?>" target="_blank" class="btn btn-secondary">
                  <span>Ver Cédula (Frente)</span>
                </a>
              </div>
              <div class="col-md-6">
                <a href="<?php echo $persona->getCedulaTrasera(); ?>" target="_blank" class="btn btn-secondary">
                  <span>Ver Cédula (Detrás)</span>
                </a>
              </div>
            <?php } else { ?>
              <div class="col-12">
                <span class="card p-3">Debe subir la copia de la cédula</span>
              </div>
            <?php } ?>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-warning" id="btnSubirCedula">
          <span>Enviar</span>
        </button>
      </div>
    </div>
  </div>
</div>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script>
    $('#cambiarContra').on('click', function() {
        $.ajax({
            url: "index.php?controlador=Login&metodo=GenerarCodigo",
            type: "GET",
            success: function(response) {
                if (response == '') {
                    $('#contenido').html('Ha ocurrido un error, intente nuevamente');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    });
    $('#enviarCodigo').on('click', function() {
        $.ajax({
            url: "index.php?controlador=Login&metodo=VerificarCodigo",
            type: "POST",
            data: {
                codigo: $('#codigo').val()
            },
            success: function(response) {
                if (response != '') {
                    if (response == '200') {
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
            error: function(xhr, status, error) {
                console.error("Error en la petición:", error);
            }
        });
    });
    $('#enviarContra').on('click', function() {
        if ($('#contra').val() == $('#contraConfir').val()) {
            $.ajax({
                url: "index.php?controlador=Login&metodo=CambiarContra",
                type: "POST",
                data: {
                    contra: $('#contra').val()
                },
                success: function(response) {
                    if (response != '') {
                        if (response == '200') {
                            $('#contraTag').html('Cambio de Contraseña Exitoso');
                        } else {
                            $('#contraTag').html('Ha ocurrido un error, intente nuevamente');
                        }
                    } else {
                        $('#contraTag').html('Ha ocurrido un error, intente nuevamente');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la petición:", error);
                }
            });
        } else {
            $('#contraTag').html('Ingrese su Contraseña. Las Contraseñas deben coincidir');
        }
    });
</script>
<script src="./Vista/assets/js/usuarios.js"></script>