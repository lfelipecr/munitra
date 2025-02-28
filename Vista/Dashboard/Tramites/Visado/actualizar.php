<style>
  #canvas {
    border: .5px solid black;
    cursor: crosshair;
  }

  .rojo {
    color: red;
  }
</style>
<main class="col-sm-10 bg-body-tertiary" id="main">
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
    <form action="index.php?controlador=Visado&metodo=Actualizar" id="frmVisado" method="post" enctype="multipart/form-data">
      <input type="hidden" id="idSolicitud" value="<?php echo $id; ?>" name="idSolicitud">
      <input type="hidden" id="idSolicitante" value="<?php echo $solicitud->getIdPersona(); ?>">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row mt-3">
          <div class="col-12">
            <span class="mb-3">Solicitante (*)</span>
            <select name="persona" id="slPersonas" class="form-control">
              <?php for ($i = 0; $i < count($personas); $i++) {
                if ($personas[$i]->getId() == $solicitud->getIdPersona()) { ?>
                  <option selected value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre() . " " . $personas[$i]->getPrimerApellido() . " " . $personas[$i]->getSegundoApellido(); ?></option>
                <?php } else { ?>
                  <option value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre() . " " . $personas[$i]->getPrimerApellido() . " " . $personas[$i]->getSegundoApellido(); ?></option>
                <?php } ?>
              <?php } ?>
            </select>
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
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Copia de la minuta (*)</span><br>
            <input type="hidden" id="idMinuta" name="idMinuta">
            <input type="file" class="form-control" id="flMinuta" name="flMinuta">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Carta de certificación MOPT</span><br>
            <input type="hidden" id="idCartaMOPT" name="idCartaMOPT">
            <input type="file" class="form-control" id="flCartaMOPT" name="flCartaMOPT">
          </div>
          <div class="col-12 mt-md-3 text-center">
            <span class="mb-3 embedTxt">Firma (*)</span><br>
            <img src="" class="img-fluid border rounded" id="firmaCredenciales" alt="">
            <br>
          </div>
          <div class="col-12 mt-md-3" id="requisitosEmbed"></div>
          <input type="hidden" id="idEstado" value="<?php echo $solicitud->getEstadoSolicitud() ?>">
          <div class="col-12 mt-md-3">
            <span class="mb-3">Estado de Solicitud</span><br>
            <select name="estadoSolicitud" id="slEstado" class="form-control">
              <option id="estado1" value="1">Nueva</option>
              <option id="estado2" value="2">En proceso</option>
              <option id="estado3" value="3">Prevención 1</option>
              <option id="estado4" value="4">Prevención 2</option>
              <option id="estado5" value="5">Aprobada</option>
              <option id="estado6" value="6">Rechazada</option>
              <option id="estado7" value="7">Cancelada</option>
              <option id="estado8" value="8">Retirada</option>
            </select>
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1" id="btnAct">
              <span>Ingresar +</span>
            </button>
            <a class="btn btn-outline-info mx-1" id="btnVer">
              <span>Visualizar</span>
            </a>
            <a class="btn btn-outline-warning mx-1" id="btnModi">
              <span>Modificar</span>
            </a>
            <a href="index.php?controlador=Tramites&metodo=Visado" class="btn btn-outline-danger mx-1">
              <span>Cancelar x</span>
            </a>
            <a class="btn btn-outline-success mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalBitacora" onclick="CambiarFormulario(0)">
              <span>Notificación <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg></span>
            </a>
            <a class="btn btn-outline-success mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalBitacora" onclick="CambiarFormulario(1)">
              <span class="my-1">Bitácora <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg></span>
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="modal fade" id="modalBitacora" tabindex="-1" aria-labelledby="modalBitacoraLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalBitacoraLabel">Bitácora de Solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row" id="bitacora"></div>
        </div>
        <div class="modal-footer d-block">
          <div class="mb-2">
            <label for="" class="form-label">Cuerpo *</label>
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
<script src="./Vista/assets/js/visualizacionSolicitudes.js"></script>
<script src="./Vista/assets/js/bitacoraInterna.js"></script>