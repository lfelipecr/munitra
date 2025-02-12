<main class="col-sm-10 bg-body-tertiary" id="main">
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
      <form action="index.php?controlador=Usosuelo&metodo=Actualizar" id="frmUsoSuelo" method="post" enctype="multipart/form-data">
      <input type="hidden" value="<?php echo $id; ?>" name="idSolicitud">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <div class="row mt-3">
            <div class="col-12">
              <span class="mb-3">Solicitante (*)</span>
              <select name="persona" id="slPersonas" class="form-control">
                <?php for ($i = 0; $i < count($personas); $i++) {?>
                  <option value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?></option>
                  <?php }?>
              </select>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Distrito (*)</span><br>
              <input type="hidden" id="idDistrito" name="idDistrito">
              <select name="distrito" id="slDistrito" class="form-control">
                <?php for ($i = 0; $i < count($distritos); $i++) { ?>
                    <?php if ($distritos[$i]->getIdCanton() == 36) {?>
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
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="./Vista/assets/js/usosuelo.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
  <script src="./Vista/assets/js/visualizacionSolicitudes.js"></script>