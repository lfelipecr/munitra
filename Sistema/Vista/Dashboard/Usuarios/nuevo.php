<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">

      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Nuevo Registro</h1>
        <a href="index.php?controlador=Usuario&metodo=Listado" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Usuario&metodo=Ingresar" id="frmPersona"  method="post">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <h4 class="border-bottom pb-2 mb-0">Datos de la Persona</h4>
          <div class="row mt-3">
            <div class="col-md-6">
              <span class="mb-3">Tipo de Identificacion (*)</span>
              <select name="tipoIdentificacion" id="txtTipoId" class="form-control mb-3">
                <option value="1">Cedula de Identidad</option>
                <option value="2">Pasaporte</option>
                <option value="3">Cédula de Residencia</option>
                <option value="4">Número Interno</option>
                <option value="5">Número Asegurado</option>
                <option value="6">DIMEX</option>
                <option value="7">NITE</option>
                <option value="8">DIDI</option>
              </select>
            </div>
            <div class="col-md-6">
              <span class="mb-3">Identificacion (*)</span>
              <input type="text" class="form-control mb-3" name="identificacion" id="txtIdentificacion">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Nombre (*)</span>
              <input type="text" class="form-control mb-3" name="nombre" id="txtNombre">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Primer Apellido (*)</span>
              <input type="text" class="form-control mb-3" name="apellido" id="txtApellido1">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Segundo Apellido</span>
              <input type="text" class="form-control mb-3" name="apellido" id="txtApellido2">
            </div>
            <div class="col-12">
              <span class="mb-3">Dirección (*)</span>
              <input type="text" class="form-control mb-3" name="direccion" id="txtDireccion">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Teléfono</span>
              <input type="number" class="form-control mb-3" name="telefono" id="txtTelefono">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Whatsapp</span>
              <input type="number" class="form-control mb-3" name="whatsapp" id="txtWhatsapp">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Correo (*)</span>
              <input type="text" class="form-control mb-3" name="correo" id="txtCorreo">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Situación</span>
              <input type="text" class="form-control mb-3" name="situacion" id="txtSituacion">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Monto Morosidad</span>
              <input type="number" class="form-control mb-3" name="montoMorosidad" id="txtMontoMorosidad">
            </div>
            <div class="col-md-6">
              <span class="mb-3">Monto Adeudado</span>
              <input type="number" class="form-control mb-3" name="montoAdeudado" id="txtMontoAdeudado">
            </div>
            <div class="col-6">
              <span class="mb-3">Consentimiento</span>
              <input type="text" class="form-control mb-3" name="consentimiento" id="txtConsentimiento">
            </div>
            <div class="col-6">
              <span class="mb-3">Propiedad Fuera</span>
              <input type="int" class="form-control mb-3" name="propiedadFuera" id="txtPropiedadFuera">
            </div>
            <div class="col-md-4">
              <span class="mb-3">Provincia (*)</span>
              <select name="provincia" class="form-control" id="slProvincia">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[0]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[0][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[0][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Cantón (*)</span>
              <select name="provincia" class="form-control" id="slCanton">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[1]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[1][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[1][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Distrito (*)</span>
              <select name="" class="form-control" id="slDistrito">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[2][$i]->getId();?>">
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
                <input type="text" class="form-control mb-3" name="nombreUsuario" id="txtNombreUsuario">
              </div>
              <div class="col-md-6">
                <span class="mb-3">Departamento (*)</span>
                <select name="depto" class="form-control" id="slDepto">
                  <?php for ($i = 0; $i < sizeof($deptos); $i++) {?>
                    <option value="<?php echo $deptos[$i]->getId();?>">
                      <span><?php echo $deptos[$i]->getDescripcion();?></span>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <span class="mb-3">Contraseña (*)</span>
                <input type="password" class="form-control mb-3" name="pass" id="txtPass1">
              </div>
              <div class="col-md-6">
                <span class="mb-3">Confirme su contraseña (*)</span>
                <input type="password" class="form-control mb-3" id="txtPass2">
              </div>
              <div class="col-12 mb-3">
                <span class="mb-3">Estado</span>
                <select name="estado" id="lsEstado" class="form-control">
                  <option value="">Activo</option>
                  <option value="">Inactivo</option>
                </select>
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