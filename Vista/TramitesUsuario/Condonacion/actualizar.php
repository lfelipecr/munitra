<style>
  #canvas {
    border: .5px solid black;
    cursor: crosshair;
  }

  .rojo {
    color: red;
  }
</style>
<main class="col-sm-12 bg-body-tertiary" id="main">
  <div class="container-fluid">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Actualizar Solicitud de Condonación</h1>
      <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <!--Aquí potencialmente puede ir el encargado de la solicitud-->
    <input type="hidden" id="idSolicitante" value="<?php echo $persona->getId(); ?>">
    <form action="index.php?controlador=Condonacion&metodo=Actualizar" id="frmCondonacion" method="post" enctype="multipart/form-data">
      <input type="hidden" id="idSolicitud" value="<?php echo $solicitud->getId(); ?>" name="idSolicitud">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row mt-3">
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
          <div class="col-12">
            <hr>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Representante Legal (*)</span><br>
            <input type="hidden" id="idRepresentante" name="idRepresentante">
            <input type="text" class="form-control" name="representante" id="txtRepresentante">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Identificación N° (*)</span><br>
            <input type="hidden" id="idIdentificacionRepresentante" name="idIdentificacionRepresentante">
            <input type="text" class="form-control" name="identificacionRepresentante" id="txtIdentificacionRepresentante">
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Dirección (*)</span><br>
            <input type="hidden" id="idDireccion" name="idDireccion">
            <input type="text" class="form-control" name="direccion" id="txtDireccion">
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Notificaciones (*)</span><br>
            <input type="hidden" id="idNotificaciones" name="idNotificaciones">
            <input type="text" class="form-control" name="notificaciones" id="txtNotificaciones">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Tipo de Solicitud (*)</span><br>
            <input type="hidden" id="idTipoSolicitud" name="idTipoSolicitud">
            <select name="tipoSolicitud" id="tipoSolicitud" class="form-control">
              <option selected value="Pago de contado" id="contadoOpcion">Pago de contado</option>
              <option value="Arreglo de pago" id="arregloOpcion">Arreglo de pago</option>
            </select>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Recibido por (*)</span><br>
            <input type="hidden" id="idRecibido" name="idRecibido">
            <input type="text" name="recibido" id="txtRecibido" class="form-control">
          </div>
          <div class="col-md-12 mt-md-3">
            <input type="hidden" id="idFecha" name="idFecha">
            <input type="hidden" class="form-control" name="fecha" id="fecha">
            <input type="hidden" id="idConsecutivo" name="idConsecutivo">
            <input type="hidden" class="form-control" name="consecutivo" id="consecutivo">
            <input type="hidden" id="idFuncionario" name="idFuncionario">
            <input type="hidden" id="funcionario" name="funcionario" value="">
            <input type="hidden" id="idTotalContado" name="idTotalContado">
            <input type="hidden" class="form-control" name="totalContado" id="totalContado">
            <input type="hidden" id="idMontoCondonarContado" name="idMontoCondonarContado">
            <input type="hidden" class="form-control" name="montoCondonarContado" id="montoCondonarContado">
            <input type="hidden" id="idFechaPago" name="idFechaPago">
            <input type="hidden" class="form-control" name="fechaPago" id="fechaPago">
            <input type="hidden" id="idTotalArreglo" name="idTotalArreglo">
            <input type="hidden" class="form-control" name="totalArreglo" id="totalArreglo">
            <input type="hidden" id="idMontoCondonarArreglo" name="idMontoCondonarArreglo">
            <input type="hidden" class="form-control" name="montoCondonarArreglo" id="montoCondonarArreglo">
            <input type="hidden" id="idPlazoMeses" name="idPlazoMeses">
            <input type="hidden" class="form-control" name="plazoMeses" id="plazoMeses">
            <input type="hidden" id="idFechaInicio" name="idFechaInicio">
            <input type="hidden" class="form-control" name="fechaInicio" id="fechaInicio">
            <input type="hidden" id="idCantidadCuotas" name="idCantidadCuotas">
            <input type="hidden" class="form-control" name="cantidadCuotas" id="cantidadCuotas">
            <input type="hidden" id="idAdelanto" name="idAdelanto">
            <input type="hidden" class="form-control" name="adelanto" id="adelanto">
            <input type="hidden" id="idPagoPorCuota" name="idPagoPorCuota">
            <input type="hidden" class="form-control" name="pagoPorCuota" id="pagoPorCuota">
            <input type="hidden" id="idResolucion" name="idResolucion">
            <select name="resolucion" id="resolucion" class="d-none">
              <option value="Aprobación">Aprobación</option>
              <option value="Denegatoria">Denegatoria</option>
              <option value="Prevención" id="opcionPrevencion">Prevención</option>
            </select>
            <input type="hidden" id="idPlazo" name="idPlazo">
            <input type="hidden" class="form-control" name="plazo" id="plazo">
            <input type="hidden" id="idFechaNotificacion" name="idFechaNotificacion">
            <input type="hidden" class="form-control" name="fechaNotificacion" id="fechaNotificacion">
            <input type="checkbox" id="cbxCumple" class="d-none">
            <input type="hidden" id="idCumple" name="idCumple">
            <input type="hidden" name="cumple" value="" id="valorCumple">
            <select name="estadoSolicitud" id="slEstado" class="d-none">
              <?php if ($solicitud->getEstadoSolicitud() == 1) { ?>
                <option value="1" selected>Aprobada</option>
                <option value="2">No Aprobada</option>
              <?php } else { ?>
                <option value="1">Aprobada</option>
                <option value="2" selected>No Aprobada</option>
              <?php } ?>
            </select>
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Actualizar +</span>
            </button>
            <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-danger mx-1">
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
<script src="./Vista/assets/js/condonaciones.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script src="./Vista/assets/js/bitacoraExterna.js"></script>