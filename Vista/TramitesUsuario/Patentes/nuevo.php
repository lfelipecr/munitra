<main class="col-sm-12 bg-body-tertiary" id="main">
    <div class="container-fluid">

      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Nueva Solicitud de Patente</h1>
        <a href="index.php?controlador=Tramites&metodo=Patentes" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="jsonData" value="">
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Patente&metodo=Ingresar" id="frmPatente" method="post" enctype="multipart/form-data">
        <div class="my-2 p-3 bg-body rounded shadow-sm">
          <div class="row">
            <div class="col-md-6">
              <span class="mb-3">Tipo de Identificacion (*)</span>
              <select name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
                <option value="1" id="tipo1">Cedula de Identidad</option>
                <option value="2" id="tipo2">Pasaporte</option>
                <option value="3" id="tipo3">Cédula de Residencia</option>
                <option value="4" id="tipo4">Número Interno</option>
                <option value="5" id="tipo5">Número Asegurado</option>
                <option value="6" id="tipo6">DIMEX</option>
                <option value="7" id="tipo7">NITE</option>
                <option value="8" id="tipo8">DIDI</option>
              </select>
            </div>
            <div class="col-md-6">
              <span class="mb-3">Identificacion (*)</span>
              <input type="text" class="form-control mb-3" name="identificacion" id="txtIdentificacion">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Nombre (*)</span>
              <input type="text" class="form-control dataPersona mb-3" name="nombre" id="txtNombre">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Primer Apellido (*)</span>
              <input type="text" class="form-control dataPersona mb-3" name="apellido1" id="txtApellido1">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Segundo Apellido</span>
              <input type="text" class="form-control dataPersona mb-3" name="apellido2" id="txtApellido2">
            </div>
            <div class="col-12">
              <span class="mb-3">Dirección (*)</span>
              <input type="text" class="form-control dataPersona mb-3" name="direccion" id="txtDireccion">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Teléfono</span>
              <input type="number" class="form-control dataPersona mb-3" name="telefono" id="txtTelefono">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Whatsapp</span>
              <input type="number" class="form-control dataPersona mb-3" name="whatsapp" id="txtWhatsapp">
            </div>
            <div class="col-md-12">
              <span class="mb-3">Correo (*)</span>
              <input type="text" class="form-control dataPersona mb-3" name="correo" id="txtCorreo">
            </div>
            <div class="col-12">
              <input type="hidden" class="form-control mb-3" name="situacion" id="txtSituacion">
              <input type="hidden" class="form-control mb-3" name="montoMorosidad" id="txtMontoMorosidad">
              <input type="hidden" class="form-control mb-3" name="montoAdeudado" id="txtMontoAdeudado">
              <input type="hidden" class="form-control mb-3" name="propiedadFuera" id="txtPropiedadFuera">
              <input type="hidden" name="consentimiento" value="0" id="valorConsentimiento">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Provincia (*)</span>
              <select name="provincia" class="form-control" id="slProvincia">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[0]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[0][$i]->getId();?>" id="provincia<?php echo $arrLocaciones[0][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[0][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Cantón (*)</span>
              <select name="canton" class="form-control" id="slCanton">
                  <?php for ($i = 0; $i < sizeof($arrLocaciones[1]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[1][$i]->getId();?>" id="canton<?php echo $arrLocaciones[1][$i]->getId();?>" data-provinciaCanton="<?php echo $arrLocaciones[1][$i]->getIdProvincia();?>" class="cantones">
                      <span><?php echo $arrLocaciones[1][$i]->getNombre();?></span>
                  </option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Distrito (*)</span>
              <select name="distrito" class="form-control" id="">
                  <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[2][$i]->getId();?>" id="distrito<?php echo $arrLocaciones[2][$i]->getId();?>" data-provinciaDistrito="<?php echo $arrLocaciones[2][$i]->getIdProvincia();?>" data-canton="<?php echo $arrLocaciones[2][$i]->getIdCanton();?>" class="distritos">
                      <span><?php echo $arrLocaciones[2][$i]->getNombre();?></span>
                  </option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-12 mt-md-3">
                <span class="mb-3"> Los requisitos para la Solicitud de Patentes pueden ser descargados <a href="./repo/serverside/REQUISITOSPATENTECOMERCIAL.pdf" download>aquí</a></span>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-md-3">
                <span class="mb-3">Adjunte los requisitos para la solicitud de patentes</span> <br>
                <input type="file" class="form-control"  name="requisitos[]" multiple>
            </div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Uso de Patente (*)</span><br>
              <select name="usoPatente" id="slUsoPatente" class="form-control">
                <option value="Transporte">Transporte</option>
                <option value="Comercial">Comercial</option>
              </select>
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Nombre de Fantasía (*)</span><br>
              <input type="text" class="form-control" name="nombreFantasia" id="txtNombreFantasia">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Actividad Comercial (*)</span><br>
              <input type="text" class="form-control" name="actividadComercial" id="txtActvidadComercial">
            </div>
            <div class="col-12">
              <span class="mb-3">Cuenta con Uso de Suelo</span>
              <input type="checkbox" id="cbxUsoSuelo">
            </div>
            <div class="col-12 mt-md-3" id="usoSuelo">
              <span class="mb-3"> Número de uso de Suelo (*)</span><br>
              <input type="number" class="form-control" name="numeroUsoSuelo" id="txtUsoSuelo">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Distrito (*)</span><br>
              <select name="distrito" id="slDistrito" class="form-control">
                <?php for ($i = 0; $i < count($distritos); $i++) { ?>
                  <?php if ($distritos[$i]->getIdCanton() == '36') {?>
                    <option value="<?php echo $distritos[$i]->getId(); ?>"><?php echo $distritos[$i]->getNombre(); ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Dirección exacta del local (*)</span><br>
              <input type="text" class="form-control" name="direccionExacta" id="txtDireccionExacta">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Área (*)</span><br>
              <input type="text" class="form-control" name="area" id="txtArea">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Dimensiones (*)</span><br>
              <input type="text" class="form-control" name="dimensiones" id="txtDimensiones">
            </div>
            <input type="hidden" name="estadoSolicitud" id="slEstado" value="1">
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
  <script src="./Vista/assets/js/busquedaDinamicaCedula.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/locaciones.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>