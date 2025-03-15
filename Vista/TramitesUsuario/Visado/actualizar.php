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
      <h1 class="h2">Actualizar Solicitud de Visado</h1>
      <a href="index.php?controlador=Tramites&metodo=Visado" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <!--Aquí potencialmente puede ir el encargado de la solicitud-->
    <input type="hidden" id="idSolicitante" value="<?php echo $persona->getId(); ?>">
    <form action="index.php?controlador=Visado&metodo=Actualizar" id="frmVisado" method="post" enctype="multipart/form-data">
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
            <span class="mb-3">Dirección de plano a revisar (*)</span><br>
            <input type="hidden" id="idDireccionPropiedad" name="idDireccionPropiedad">
            <input type="text" class="form-control" id="direccionPropiedad" name="direccionPropiedad">
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
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Número de plano o presentación (*)</span><br>
            <input type="hidden" id="idNumeroPlano" name="idNumeroPlano">
            <input type="text" class="form-control" id="numeroPlano" name="numeroPlano">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Área del plano (*)</span><br>
            <input type="hidden" id="idAreaPlano" name="idAreaPlano">
            <input type="text" class="form-control" id="areaPlano" name="areaPlano">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Número de Finca (*)</span><br>
            <input type="hidden" id="idNumeroFinca" name="idNumeroFinca">
            <input type="text" class="form-control" id="numeroFinca" name="numeroFinca">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Área según Registro Público (*)</span><br>
            <input type="hidden" id="idAreaRegistroPublico" name="idAreaRegistroPublico">
            <input type="text" class="form-control" id="areaRegistroPublico" name="areaRegistroPublico">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Frente (*)</span><br>
            <input type="hidden" id="idFrente" name="idFrente">
            <input type="text" class="form-control" id="frente" name="frente">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Número de Contrato CFIA (*)</span><br>
            <input type="hidden" id="idNumeroContrato" name="idNumeroContrato">
            <input type="text" class="form-control" id="numeroContrato" name="numeroContrato">
          </div>
          <div class="col-12 mt-md-3 mb-3">
            <ol>
              <li>
                <span>Carta de disponibilidad de agua potable del acueducto de la localidad. (EN CASO DE PERTENECER A UN DISTRITO DEBERA SOLITARLO A LA OFICINA DE LA ASOCIACIÓN ADMINISTRADORA DEL ACUEDUCTO CORRESPONDIENTE, ESTE DEBE DE INDICAR EL NUMERO DE PLANO A VISAR Y NUMERO DE FINCA, NO SE ACEPTAN RECIBOS DE AGUA). <span class="rojo">(Obligatorio)</span></span>
              </li>
              <li>
                <span>Croquis a escala de la finca madre firmado por un profesional en topografía, indicando todos los detalles, parcelas resultantes del fraccionamiento con sus respectivos frentes, fondos y áreas.<span class="rojo">(Obligatorio)</span></span>
              </li>
              <li>
                <span>Copia de los plano respectivamente corregido.<span class="rojo">(Obligatorio)</span></span>
              </li>
              <li>
                <span>Copia de la minuta de rechazo del catastro y plano rechazado.<span class="rojo">(Obligatorio)</span></span>
              </li>
              <li><span>Si el plano a visar se encuentra frente a la red vial nacional, definida en el artículo N°1 de la Ley General de Caminos Públicos, deberá aportar original y tres copias con el alineamiento oficial del Ministerio de Obras Públicas y Transportes. Carta de certificación emitida por el MOPT en donde se indica el retiro de Ley para construir cercas y edificaciones.</span></li>
            </ol>
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Carta de Disponibilidad de Agua (*)</span><br>
            <input type="hidden" id="idCartaDisponibilidad" name="idCartaDisponibilidad">
            <input type="file" class="form-control" id="flCartaDisponibilidad" name="flCartaDisponibilidad">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Croquis (*)</span><br>
            <input type="hidden" id="idCroquis" name="idCroquis">
            <input type="file" class="form-control" id="flCroquis" name="flCroquis">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Plano Corregido (*)</span><br>
            <input type="hidden" id="idPlanoCorregido" name="idPlanoCorregido">
            <input type="file" class="form-control" id="flPlanoCorregido" name="flPlanoCorregido">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Copia de la minuta (*)</span><br>
            <input type="hidden" id="idMinuta" name="idMinuta">
            <input type="file" class="form-control" id="flMinuta" name="flMinuta">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Imágen de la Minuta</span><br>
            <input type="hidden" id="idImagenMinuta" name="idImagenMinuta">
            <input type="file" class="form-control" id="flImgMinuta" name="flImagenMinuta">
          </div>
          <div class="col-md-4 mt-md-3">
            <span class="mb-3">Carta de certificación MOPT</span><br>
            <input type="hidden" id="idCartaMOPT" name="idCartaMOPT">
            <input type="file" class="form-control" id="flCartaMOPT" name="flCartaMOPT">
          </div>
          <input type="hidden" name="estadoSolicitud" id="slEstado" value="1">
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Ingresar +</span>
            </button>
            <a href="index.php?controlador=Tramites&metodo=Visado" class="btn btn-outline-danger mx-1">
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
<script src="./Vista/assets/js/visado.js"></script>
<script src="./Vista/assets/js/firmas.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script src="./Vista/assets/js/bitacoraExterna.js"></script>