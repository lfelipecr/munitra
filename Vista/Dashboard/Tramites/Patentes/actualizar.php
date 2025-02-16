<main class="col-sm-10 bg-body-tertiary" id="main">
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
      <input type="hidden" id="idSolicitante" value="<?php echo $solicitud->getIdPersona();?>">
      <form action="index.php?controlador=Patente&metodo=Actualizar" id="frmPatente" method="post" enctype="multipart/form-data">
        <input type="hidden" id="idSolicitud" value="<?php echo $id; ?>" name="idSolicitud">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <div class="row mt-3">
            <div class="col-12">
              <span class="mb-3">Solicitante (*)</span>
              <select name="persona" id="slPersonas" class="form-control">
                <?php for ($i = 0; $i < count($personas); $i++) {?>
                  <option <?php if ($personas[$i]->getId() == $solicitud->getIdPersona()) { echo 'selected'; } ?> id="" value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?></option>
                  <?php }?>
              </select>
            </div>
            <div class="col-12 mt-md-3">
                <span class="mb-3"> Los requisitos para la Solicitud de Patentes pueden ser descargados <a href="./repo/serverside/REQUISITOSPATENTECOMERCIAL.pdf" download>aquí</a></span>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Adjunte los requisitos para la solicitud de patentes</span> <br>
              <input type="file" class="form-control"  name="requisitos[]" multiple>
              <input type="hidden" id="idAdjuntos" name="idAdjuntos">
              <hr>
              <div class="text-center" id="requisitosEmbed"></div>
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
                  <option id="<?php echo "distrito".$distritos[$i]->getId(); ?>" value="<?php echo $distritos[$i]->getId(); ?>"><?php echo $distritos[$i]->getNombre(); ?></option>
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
            <div class="col-12 mt-md-3">
              <span class="mb-3">Estado de Solicitud</span><br>
              <select name="estadoSolicitud" id="slEstado" class="form-control">
                <?php if ($solicitud->getEstadoSolicitud() == 1) { ?>
                    <option value="1" selected>Aprobada</option>
                    <option value="2">No Aprobada</option>
                <?php } else { ?>
                    <option value="1">Aprobada</option>
                    <option value="2" selected>No Aprobada</option>
                <?php }?>
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
              <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-danger mx-1">
                <span>Cancelar x</span>
              </a>
              <a class="btn btn-outline-info mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalBitacora" onclick="CambiarFormulario()">
                <span><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
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
            <div class="mb-2 text-end">
                <a class="btn btn-warning" id="btnEnviarExterno">
                    <span>Enviar</span>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="./Vista/assets/js/patentes.js"></script>
  <script src="./Vista/assets/js/bitacoraInterna.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
  <script src="./Vista/assets/js/visualizacionSolicitudes.js"></script>