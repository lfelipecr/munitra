<main class="col-sm-10 bg-body-tertiary" id="main">
  <div class="container-fluid">

    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Actualizar Registro: <?php echo $persona->getNombre() . " " . $persona->getPrimerApellido() . " " . $persona->getSegundoApellido(); ?></h1>
      <a href="index.php?controlador=Usuario&metodo=Listado" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <form action="index.php?controlador=Usuario&metodo=Actualizar" id="frmPersona" method="post">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Datos de la Persona</h4>
        <div class="row mt-3">
          <div class="col-md-6">
            <span class="mb-3">Tipo de Identificacion (*)</span>
            <select name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
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
          <input type="hidden" value="<?php echo $usuario->getId(); ?>" name="idUsuario">
          <input type="hidden" value="<?php echo $persona->getId(); ?>" name="idPersona" id="idPersona">
          <div class="col-md-6">
            <span class="mb-3">Identificacion (*)</span>
            <input type="text" class="form-control mb-3" name="identificacion" id="txtIdentificacion" value="<?php echo $persona->getIdentificacion(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Nombre (*)</span>
            <input type="text" class="form-control mb-3" name="nombre" id="txtNombre" value="<?php echo $persona->getNombre(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Primer Apellido (*)</span>
            <input type="text" class="form-control mb-3" name="apellido1" id="txtApellido1" value="<?php echo $persona->getPrimerApellido(); ?>">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Segundo Apellido</span>
            <input type="text" class="form-control mb-3" name="apellido2" id="txtApellido2" value="<?php echo $persona->getSegundoApellido(); ?>">
          </div>
          <div class="col-12">
            <span class="mb-3">Dirección (*)</span>
            <input type="text" class="form-control mb-3" name="direccion" id="txtDireccion" value="<?php echo $persona->getDireccion(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Teléfono</span>
            <input type="number" class="form-control mb-3" name="telefono" id="txtTelefono" value="<?php echo $persona->getTelefono(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Whatsapp</span>
            <input type="number" class="form-control mb-3" name="whatsapp" id="txtWhatsapp" value="<?php echo $persona->getWhatsapp(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Correo (*)</span>
            <input type="text" class="form-control mb-3" name="correo" id="txtCorreo" value="<?php echo $persona->getCorreo(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Situación</span>
            <input type="text" class="form-control mb-3" name="situacion" id="txtSituacion" value="<?php echo $persona->getSituacion(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Monto Morosidad</span>
            <input type="number" class="form-control mb-3" name="montoMorosidad" id="txtMontoMorosidad" value="<?php echo $persona->getMontoMorosidad(); ?>">
          </div>
          <div class="col-md-6">
            <span class="mb-3">Monto Adeudado</span>
            <input type="number" class="form-control mb-3" name="montoAdeudado" id="txtMontoAdeudado" value="<?php echo $persona->getMontoAdeudado(); ?>">
          </div>
          <div class="col-12">
            <span class="mb-3">Propiedad Fuera</span>
            <input type="number" class="form-control mb-3" name="propiedadFuera" id="txtPropiedadFuera" value="<?php echo $persona->getPropiedadFuera(); ?>">
          </div>
          <div class="col-12">
            <span class="mb-3">Consentimiento</span>
            <input type="checkbox" id="cbxConsentimiento" <?php if ($persona->getConsentimiento()) {
                                                            echo 'checked';
                                                          } ?>>
            <input type="hidden" name="consentimiento" value="" id="valorConsentimiento">
          </div>
          <div class="col-md-4">
            <span class="mb-3">Provincia (*)</span>
            <select name="provincia" class="form-control" id="slProvincia">
              <?php for ($i = 0; $i < sizeof($arrLocaciones[0]); $i++) { ?>
                <option <?php if ($persona->getIdProvincia() == $arrLocaciones[0][$i]->getId()) {
                          echo 'selected';
                        } ?> value="<?php echo $arrLocaciones[0][$i]->getId(); ?>">
                  <span><?php echo $arrLocaciones[0][$i]->getNombre(); ?></span>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <span class="mb-3">Cantón (*)</span>
            <select name="canton" class="form-control" id="slCanton">
              <?php for ($i = 0; $i < sizeof($arrLocaciones[1]); $i++) { ?>
                <option <?php if ($persona->getIdCanton() == $arrLocaciones[1][$i]->getId()) {
                          echo 'selected';
                        } ?> value="<?php echo $arrLocaciones[1][$i]->getId(); ?>" data-provinciaCanton="<?php echo $arrLocaciones[1][$i]->getIdProvincia(); ?>" class="cantones">
                  <span><?php echo $arrLocaciones[1][$i]->getNombre(); ?></span>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <span class="mb-3">Distrito (*)</span>
            <select name="distrito" class="form-control" id="slDistrito">
              <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) { ?>
                <option <?php if ($persona->getIdDistrito() == $arrLocaciones[2][$i]->getId()) {
                          echo 'selected';
                        } ?> value="<?php echo $arrLocaciones[2][$i]->getId(); ?>" data-provinciaDistrito="<?php echo $arrLocaciones[2][$i]->getIdProvincia(); ?>" data-canton="<?php echo $arrLocaciones[2][$i]->getIdCanton(); ?>" class="distritos">
                  <span><?php echo $arrLocaciones[2][$i]->getNombre(); ?></span>
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
              <span class="mb-3">Descripción de Usuario (*)</span>
              <input type="text" class="form-control mb-3" name="nombreUsuario" id="txtNombreUsuario" value="<?php echo $usuario->getNombreUsuario(); ?>">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Departamento (*)</span>
              <select name="depto" class="form-control" id="slDepto">
                <?php for ($i = 0; $i < sizeof($deptos); $i++) { ?>
                  <option value="<?php echo $deptos[$i]->getId(); ?>" <?php if ($usuario->getIdDepartamento() == $deptos[$i]->getId()) {
                                                                        echo 'selected';
                                                                      } ?>>
                    <span><?php echo $deptos[$i]->getDescripcion(); ?></span>
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
              <input type="checkbox" id="cbxResponsable" <?php if ($usuario->getResponsable()) {
                                                            echo 'checked';
                                                          } ?>>
              <input type="hidden" name="responsable" value="" id="valorResponsable">
            </div>
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Guardar +</span>
            </button>
            <a href="index.php?controlador=Usuario&metodo=Listado" class="btn btn-outline-danger mx-1">
              <span>Cancelar x</span>
            </a>
            <a class="btn btn-outline-success mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalCedula">
              <span>Cédula <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg></span>
            </a>
            <?php if ($credenciales) { ?>
              <a class="btn btn-outline-success mx-1" id="btnVer" href="index.php?controlador=Usuario&metodo=VerCredenciales&id=<?php echo $persona->getId();?>">
                <span>Credenciales <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path fill='currentColor' d="M0 96l576 0c0-35.3-28.7-64-64-64L64 32C28.7 32 0 60.7 0 96zm0 32L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-288L0 128zM64 405.3c0-29.5 23.9-53.3 53.3-53.3l117.3 0c29.5 0 53.3 23.9 53.3 53.3c0 5.9-4.8 10.7-10.7 10.7L74.7 416c-5.9 0-10.7-4.8-10.7-10.7zM176 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm176 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z" />
                  </svg></span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
<div class="modal fade" id="modalCedula" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titulo">Copia de la Cédula</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2" id="infoModal">
          <div class="row">
            <div class="col-md-6 mt-md-4">
              <span class="mb-3">Cédula por delante <strong>(Opcional)</strong></span>
              <input type="file" class="form-control mb-3" name="cedulaFrontal" id="cedulaFrontal">
            </div>
            <div class="col-md-6 mt-md-4">
              <span class="mb-3">Cédula por detrás <strong>(Opcional)</strong></span>
              <input type="file" class="form-control mb-3" name="cedulaTrasera" id="cedulaTrasera">
            </div>
            <?php if ($persona->getCedulaFrontal() != null || $persona->getCedulaTrasera() != null) { ?>
              <div class="col-md-6">
                <a href="<?php echo $persona->getCedulaFrontal(); ?>" target="_blank" class="btn btn-secondary">
                  <span>Ver Cédula (Frente)</span>
                </a>
              </div>
              <div class="col-md-6">
                <a href="<?php echo $persona->getCedulaTrasera(); ?>" target="_blank" class="btn btn-secondary">
                  <span>Ver Cédula (Detrás)</span>
                </a>
              </div>
            <?php } else { ?>
              <div class="col-12">
                <span class="card p-3">Debe subir la copia de la cédula</span>
              </div>
            <?php } ?>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-warning" id="btnSubirCedula">
          <span>Enviar</span>
        </button>
      </div>
    </div>
  </div>
</div>
<script src="./Vista/assets/js/usuarios.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/locaciones.js"></script>