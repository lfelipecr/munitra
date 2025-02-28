<main class="col-sm-12 bg-body-tertiary" id="main">
  <div class="container-fluid">

    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Actualizar Patente</h1>
      <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <!--Aquí potencialmente puede ir el encargado de la solicitud-->
    <input type="hidden" id="idSolicitante" value="<?php echo $persona->getId(); ?>">
    <form action="index.php?controlador=Patente&metodo=Actualizar" id="frmPatente" method="post" enctype="multipart/form-data">
      <input type="hidden" id="idSolicitud" value="<?php echo $solicitud->getId(); ?>" name="idSolicitud">
      <div class="my-2 p-3 bg-body rounded shadow-sm">
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
          <div class="col-12 mt-md-2">
            <span class="mb-3">Los requisitos para la Solicitud de Patentes pueden ser descargados <a href="./repo/serverside/REQUISITOSPATENTECOMERCIAL.pdf" download>aquí</a></span>
          </div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12 mt-md-3">
            <span class="mb-3">Adjunte los requisitos para la solicitud de patentes</span> <br>
            <input type="file" class="form-control" name="requisitos[]" multiple>
            <input type="hidden" id="idRequisitos" name="idRequisitos">
          </div>
          <div class="col-12 mt-md-3">
            <span class="mb-3">Uso de Patente (*)</span><br>
            <select name="usoPatente" id="slUsoPatente" class="form-control">
              <option value="Transporte">Transporte</option>
              <option value="Comercial">Comercial</option>
            </select>
            <input type="hidden" id="idUsoPatentes" name="idUsoPatentes">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Nombre de Fantasía (*)</span><br>
            <input type="text" class="form-control" name="nombreFantasia" id="txtNombreFantasia">
            <input type="hidden" id="idNombreFantasia" name="idNombreFantasia">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Actividad Comercial (*)</span><br>
            <input type="text" class="form-control" name="actividadComercial" id="txtActvidadComercial">
            <input type="hidden" id="idActividadComercial" name="idActividadComercial">
          </div>
          <div class="col-12">
            <span class="mb-3">Cuenta con Uso de Suelo</span>
            <input type="checkbox" id="cbxUsoSuelo">
          </div>
          <div class="col-12 mt-md-3" id="usoSuelo">
            <span class="mb-3"> Número de uso de Suelo (*)</span><br>
            <input type="number" class="form-control" name="numeroUsoSuelo" id="txtUsoSuelo">
            <input type="hidden" id="idNumeroUsoSuelo" name="idNumeroUsoSuelo">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Distrito (*)</span><br>
            <input type="hidden" id="idDistrito" name="idDistrito">
            <select name="distrito" id="slDistrito" class="form-control">
              <?php for ($i = 0; $i < count($distritos); $i++) { ?>
                <?php if ($distritos[$i]->getIdCanton() == '36') { ?>
                  <option id="<?php echo "distrito" . $distritos[$i]->getId(); ?>" value="<?php echo $distritos[$i]->getId(); ?>"><?php echo $distritos[$i]->getNombre(); ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Dirección exacta del local (*)</span><br>
            <input type="hidden" id="idDireccionExacta" name="idDireccionExacta">
            <input type="text" class="form-control" name="direccionExacta" id="txtDireccionExacta">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Área (*)</span><br>
            <input type="hidden" id="idArea" name="idArea">
            <input type="text" class="form-control" name="area" id="txtArea">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Dimensiones (*)</span><br>
            <input type="hidden" id="idDimensiones" name="idDimensiones">
            <input type="text" class="form-control" name="dimensiones" id="txtDimensiones">
          </div>
          <input type="hidden" name="estadoSolicitud" id="slEstado" value="2">
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Ingresar +</span>
            </button>
            <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-danger mx-1">
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
<script src="./Vista/assets/js/patentes.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script src="./Vista/assets/js/bitacoraExterna.js"></script>