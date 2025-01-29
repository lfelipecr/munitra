<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">

      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Actualizar Registro: <?php echo $persona->getNombre()." ".$persona->getPrimerApellido()." ".$persona->getSegundoApellido();?></h1>
        <a href="index.php?controlador=Usuario&metodo=Listado" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Usuario&metodo=Actualizar" id="frmPersona"  method="post">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <h4 class="border-bottom pb-2 mb-0">Datos de la Persona</h4>
          <div class="row mt-3">
            <div class="col-md-6">
              <span class="mb-3">Tipo de Identificacion (*)</span>
              <select name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
                <option value="1" <?php if ($persona->getIdTipoIdentificacion()==1) {echo 'selected';}?>>Cedula de Identidad</option>
                <option value="2" <?php if ($persona->getIdTipoIdentificacion()==2) {echo 'selected';}?>>Pasaporte</option>
                <option value="3" <?php if ($persona->getIdTipoIdentificacion()==3) {echo 'selected';}?>>Cédula de Residencia</option>
                <option value="4" <?php if ($persona->getIdTipoIdentificacion()==4) {echo 'selected';}?>>Número Interno</option>
                <option value="5" <?php if ($persona->getIdTipoIdentificacion()==5) {echo 'selected';}?>>Número Asegurado</option>
                <option value="6" <?php if ($persona->getIdTipoIdentificacion()==6) {echo 'selected';}?>>DIMEX</option>
                <option value="7" <?php if ($persona->getIdTipoIdentificacion()==7) {echo 'selected';}?>>NITE</option>
                <option value="8" <?php if ($persona->getIdTipoIdentificacion()==8) {echo 'selected';}?>>DIDI</option>
              </select>
            </div>
            <input type="hidden" value="<?php echo $usuario->getId(); ?>" name="idUsuario">
            <input type="hidden" value="<?php echo $persona->getId(); ?>" name="idPersona">
            <div class="col-md-6">
              <span class="mb-3">Identificacion (*)</span>
              <input type="text" class="form-control mb-3" name="identificacion" id="txtIdentificacion" value="<?php echo $persona->getIdentificacion();?>">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Nombre (*)</span>
              <input type="text" class="form-control mb-3" name="nombre" id="txtNombre" value="<?php echo $persona->getNombre();?>">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Primer Apellido (*)</span>
              <input type="text" class="form-control mb-3" name="apellido1" id="txtApellido1" value="<?php echo $persona->getPrimerApellido();?>">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Segundo Apellido</span>
              <input type="text" class="form-control mb-3" name="apellido2" id="txtApellido2" value="<?php echo $persona->getSegundoApellido();?>">
            </div>
            <div class="col-12">
              <span class="mb-3">Dirección (*)</span>
              <input type="text" class="form-control mb-3" name="direccion" id="txtDireccion" value="<?php echo $persona->getDireccion();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Teléfono</span>
              <input type="number" class="form-control mb-3" name="telefono" id="txtTelefono" value="<?php echo $persona->getTelefono();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Whatsapp</span>
              <input type="number" class="form-control mb-3" name="whatsapp" id="txtWhatsapp" value="<?php echo $persona->getWhatsapp();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Correo (*)</span>
              <input type="text" class="form-control mb-3" name="correo" id="txtCorreo" value="<?php echo $persona->getCorreo();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Situación</span>
              <input type="text" class="form-control mb-3" name="situacion" id="txtSituacion" value="<?php echo $persona->getSituacion();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Monto Morosidad</span>
              <input type="number" class="form-control mb-3" name="montoMorosidad" id="txtMontoMorosidad" value="<?php echo $persona->getMontoMorosidad();?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Monto Adeudado</span>
              <input type="number" class="form-control mb-3" name="montoAdeudado" id="txtMontoAdeudado" value="<?php echo $persona->getMontoAdeudado();?>">
            </div>
            <div class="col-12">
              <span class="mb-3">Propiedad Fuera</span>
              <input type="number" class="form-control mb-3" name="propiedadFuera" id="txtPropiedadFuera" value="<?php echo $persona->getPropiedadFuera();?>">
            </div>
            <div class="col-12">
              <span class="mb-3">Consentimiento</span>
              <input type="checkbox" id="cbxConsentimiento" <?php if ($persona->getConsentimiento()){ echo 'checked'; }?> >
              <input type="hidden" name="consentimiento" value="" id="valorConsentimiento">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Provincia (*)</span>
              <select name="provincia" class="form-control" id="slProvincia">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[0]); $i++) {?>
                  <option <?php if ($persona->getIdProvincia()==$arrLocaciones[0][$i]->getId()) {echo 'selected';}?> value="<?php echo $arrLocaciones[0][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[0][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Cantón (*)</span>
              <select name="canton" class="form-control" id="slCanton">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[1]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[1][$i]->getId();?>"  <?php if ($persona->getIdCanton()==$arrLocaciones[1][$i]->getId()) {echo 'selected';}?>>
                    <span><?php echo $arrLocaciones[1][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Distrito (*)</span>
              <select name="distrito" class="form-control" id="slDistrito">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[2][$i]->getId();?>" <?php if ($persona->getIdDistrito()==$arrLocaciones[2][$i]->getId()) {echo 'selected';}?>>
                    <span><?php echo $arrLocaciones[2][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12 d-flex align-items-center mb-3 mt-2">
              <label class="mx-1 mb-1">Generar Usuario en Sistema</label>
              <input type="checkbox" id="cbxGenerarUsuario">
            </div>
            <hr class="formUsuario">
            <div class="row p-none formUsuario">
              <div class="col-12 my-md-3">
                <h6><strong>Datos de Usuario en Sistema</strong></h6>
              </div>
              <div class="col-md-6">
                <span class="mb-3">Nombre de Usuario (*)</span>
                <input type="text" class="form-control mb-3" name="nombreUsuario" id="txtNombreUsuario" value="<?php echo $usuario->getNombreUsuario();?>">
              </div>
              <div class="col-md-6">
                <span class="mb-3">Departamento (*)</span>
                <select name="depto" class="form-control" id="slDepto">
                  <?php for ($i = 0; $i < sizeof($deptos); $i++) {?>
                    <option value="<?php echo $deptos[$i]->getId();?>" <?php if ($usuario->getIdDepartamento()==$deptos[$i]->getId()) {echo 'selected';}?>>
                      <span><?php echo $deptos[$i]->getDescripcion();?></span>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-12 mb-3">
                <span class="mb-3">Estado</span>
                <select name="estado" id="lsEstado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
              <div class="col-12">
                <span class="mb-3">Responsable</span>
                <input type="checkbox" id="cbxResponsable" <?php if ($usuario->getResponsable()){ echo 'checked'; } ?>>
                <input type="hidden" name="responsable" value="" id="valorResponsable">
              </div>
            </div>
            <div class="col-12 py-2">
              <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
            </div>
            <div class="col-12 d-flex align-items-center mb-3">
              <button type="submit" class="btn btn-outline-warning mx-1">
                <span>Ingresar +</span>
              </button>
              <a href="index.php?controlador=Usuario&metodo=Listado" class="btn btn-outline-danger mx-1">
                <span>Cancelar x</span>
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="./Vista/assets/js/usuarios.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>