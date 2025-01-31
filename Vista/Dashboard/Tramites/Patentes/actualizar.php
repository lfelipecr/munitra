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
      <form action="index.php?controlador=Patente&metodo=Actualizar" id="frmPatente" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $id; ?>" name="idSolicitud">
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
                <span class="mb-3"> Los requisitos para la Solicitud de Patentes pueden ser descargados <a href="./repo/serverside/REQUISITOSPATENTECOMERCIAL.pdf" download>acá</a></span>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-md-3">
                <span class="mb-3">Adjunte los requisitos para la solicitud de patentes</span> <br>
                <input type="file" class="form-control"  name="requisitos">
                <input type="hidden" id="idAdjuntos" name="idAdjuntos">
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
              <button type="submit" class="btn btn-outline-warning mx-1">
                <span>Ingresar +</span>
              </button>
              <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-danger mx-1">
                <span>Cancelar x</span>
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="./Vista/assets/js/patentes.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>