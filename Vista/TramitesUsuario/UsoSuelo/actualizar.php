<main class="col-sm-12 bg-body-tertiary" id="main">
  <div class="container-fluid">

    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Actualizar Solicitud de Uso de Suelo</h1>
      <a href="index.php?controlador=Tramites&metodo=UsoSuelo" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <!--Aquí potencialmente puede ir el encargado de la solicitud-->
    <input type="hidden" id="idSolicitante" value="<?php echo $persona->getId(); ?>">
    <form action="index.php?controlador=Usosuelo&metodo=Actualizar" id="frmUsoSuelo" method="post" enctype="multipart/form-data">
      <input type="hidden" id="idSolicitud" value="<?php echo $solicitud->getId(); ?>" name="idSolicitud">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
          <div class="col-md-6">
            <span class="mb-3">Tipo de Identificacion (*)</span>
            <select disabled name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
              <option value="1" <?php if ($persona->getIdTipoIdentificacion() == 1) {
                                  echo 'selected';
                                } ?>>Cedula de Identidad</option>
              <option value="2" <?php if ($persona->getIdTipoIdentificacion() == 2) {
                                  echo 'selected';
                                } ?>>Pasaporte</option>
              <option value="3" <?php if ($persona->getIdTipoIdentificacion() == 3) {
                                  echo 'selected';
                                } ?>>Cédula de Residencia</option>
              <option value="4" <?php if ($persona->getIdTipoIdentificacion() == 4) {
                                  echo 'selected';
                                } ?>>Número Interno</option>
              <option value="5" <?php if ($persona->getIdTipoIdentificacion() == 5) {
                                  echo 'selected';
                                } ?>>Número Asegurado</option>
              <option value="6" <?php if ($persona->getIdTipoIdentificacion() == 6) {
                                  echo 'selected';
                                } ?>>DIMEX</option>
              <option value="7" <?php if ($persona->getIdTipoIdentificacion() == 7) {
                                  echo 'selected';
                                } ?>>NITE</option>
              <option value="8" <?php if ($persona->getIdTipoIdentificacion() == 8) {
                                  echo 'selected';
                                } ?>>DIDI</option>
            </select>
          </div>
          <input type="hidden" value="<?php echo $persona->getId(); ?>" name="idPersona">
          <div class="col-md-6">
            <span class="mb-3">Identificacion (*)</span>
            <input type="text" disabled class="form-control mb-3" name="identificacion" id="txtIdentificacion" value="<?php echo $persona->getIdentificacion(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Nombre (*)</span>
            <input type="text" disabled class="form-control mb-3" name="nombre" id="txtNombre" value="<?php echo $persona->getNombre(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Primer Apellido (*)</span>
            <input type="text" disabled class="form-control mb-3" name="apellido1" id="txtApellido1" value="<?php echo $persona->getPrimerApellido(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Segundo Apellido</span>
            <input type="text" disabled class="form-control mb-3" name="apellido2" id="txtApellido2" value="<?php echo $persona->getSegundoApellido(); ?>">
          </div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12 mt-md-3">
            <span class="mb-3">Distrito (*)</span><br>
            <input type="hidden" id="idDistrito" name="idDistrito">
            <select name="distrito" id="slDistrito" class="form-control">
              <?php for ($i = 0; $i < count($distritos); $i++) { ?>
                <?php if ($distritos[$i]->getIdCanton() == 36) { ?>
                  <option id="distrito<?php echo $distritos[$i]->getId(); ?>" value="<?php echo $distritos[$i]->getId(); ?>"><?php echo $distritos[$i]->getNombre(); ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Dirección de la propiedad (*)</span><br>
            <input type="text" class="form-control" name="direccionPropiedad" id="txtDireccionPropiedad">
            <input type="hidden" id="idDireccionPropiedad" name="idDireccionPropiedad">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Número de Finca (*)</span><br>
            <input type="number" class="form-control" name="finca" id="txtFinca">
            <input type="hidden" id="idFinca" name="idFinca">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Número de Plano (*)</span><br>
            <input type="number" class="form-control" name="plano" id="txtPlano">
            <input type="hidden" id="idPlano" name="idPlano">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Motivo de la solicitud de Uso de Suelo</span><br>
            <input type="hidden" id="idMotivoUso" name="idMotivoUso">
            <select name="motivoUso" id="slMotivoUso" class="form-control">
              <option value="Solicitud de Patente">Solicitud de Patente</option>
              <option value="Construcción Nueva">Construcción Nueva</option>
              <option value="Remodelación">Remodelación</option>
              <option value="Otros">Otros</option>
            </select>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Uso Solicitado</span><br>
            <input type="hidden" id="idUsoSolicitado" name="idUsoSolicitado">
            <input type="text" class="form-control" name="usoSolicitado" id="txtUsoSolicitado">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Plano Catastro</span><br>
            <input type="hidden" id="idPlanoCatastro" name="idPlanoCatastro">
            <input type="file" class="form-control" name="planoCatastro" id="txtPlanoCatastro">
          </div>
          <div class="col-12">
            <span class="mb-3">Uso de Suelo Digital</span>
            <input type="checkbox" id="cbxDigital">
            <input type="hidden" id="idDigital" name="idDigital">
            <input type="hidden" name="digital" value="" id="valorDigital">
          </div>
          <input type="hidden" name="estadoSolicitud" id="slEstado" value="1">
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Actualizar +</span>
            </button>
            <a href="index.php?controlador=Tramites&metodo=UsoSuelo" class="btn btn-outline-danger mx-1">
              <span>Cancelar x</span>
            </a>
          </div>
          <div class="col-12">
            <div class="card p-md-5 p-2">
              <div class="row" id="bitacora"></div>
              <hr>
              <div class="mb-2">
                <label for="" class="">Cuerpo *</label>
                <textarea name="cuerpoEmail" class="form-control" id="txtCuerpo"></textarea>
              </div>
              <div class="mb-2">
                <label for="" class="form-label">Adjuntos</label>
                <input type="file" class="form-control" name="adjuntos[]" multiple id="idAdjuntos">
              </div>
              <div class="mb-2 text-end">
                <a class="btn btn-warning" id="btnEnviarExterno">
                  <span>Enviar</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="modal fade" id="modalDocs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalBitacoraLabel">Adjuntos</h1>
          <button type="button" class="btn-close" id="btnCerrarAdjuntos"></button>
        </div>
        <div class="modal-body">
          <div class="row" id="docs"></div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="./Vista/assets/js/usosuelo.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script src="./Vista/assets/js/bitacoraExterna.js"></script>