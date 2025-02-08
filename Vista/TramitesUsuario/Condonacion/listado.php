<main class="col-sm-12 bg-body-tertiary" id="main">
    <div class="container-fluid">
    <div class="d-block d-md-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
        <h1 class="h2">Solicitudes de Condonación</h1>
        <div class="form-floating">
          <input type="text" class="form-control" placeholder="" id="txtBusqueda">
          <label>Buscar <svg style="width: 12px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></label>
        </div>
        <div class="text-end">
          <a href="index.php?controlador=Tramites&metodo=ListadoTramites" class="btn mt-1 btn-outline-secondary">
            <span>Ir a Trámites</span>
          </a>
          <a href="index.php?controlador=Condonacion&metodo=VIngresar" class="btn mt-1 btn-outline-primary">
            <span>Agregar +</span>
          </a>
        </div>
      </div>
      <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
      <input type="hidden" id="controlador" value="Condonacion">
      <input type="hidden" id="idUsuario" value='<?php echo $idUsuario; ?>'>
      <div class="row" id="tbodyListadoPersonas"></div>
    </div>
    <form action="index.php?controlador=Bitacora&metodo=EnviarEmail" id="frmEmail" method="post">
      <input type="hidden" name="idSolicitante" value="" id="idSolicitante">
      <div class="modal fade" id="modalBitacora" tabindex="-1" aria-labelledby="modalBitacoraLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalBitacoraLabel">Bitácora de Solicitud</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-2">
                  <label for="" class="form-label">Asunto *</label>
                  <input type="text" class="form-control" id="txtAsunto" name="asuntoEmail">
              </div>
              <div class="mb-2">
                  <label for="" class="form-label">Cuerpo *</label>
                  <textarea name="cuerpoEmail" class="form-control" id="txtCuerpo"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <div class="mb-2 text-end">
                  <button type="submit" class="btn btn-warning">
                      <span>Enviar</span>
                  </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <script src="./Vista/assets/js/listadoSolicitudesUsuario.js"></script>
    <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
  </main>
