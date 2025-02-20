<style>
  #canvas {
    border: .5px solid black;
    cursor: crosshair;
  }
  .rojo{
    color: red;
  }
</style>
<main class="col-sm-12 bg-body-tertiary" id="main">
    <div class="container-fluid">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Nueva Solicitud de Visado</h1>
        <a href="index.php?controlador=Tramites&metodo=Visado" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="jsonData" value="">
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Visado&metodo=Ingresar" id="frmVisado" method="post" enctype="multipart/form-data">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
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
                  <option value="<?php echo $arrLocaciones[1][$i]->getId();?>" id="canton<?php echo $arrLocaciones[1][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[1][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <span class="mb-3">Distrito (*)</span>
              <select name="distritoPersona" class="form-control" id="slDistrito">
                <?php for ($i = 0; $i < sizeof($arrLocaciones[2]); $i++) {?>
                  <option value="<?php echo $arrLocaciones[2][$i]->getId();?>" id="distrito<?php echo $arrLocaciones[2][$i]->getId();?>">
                    <span><?php echo $arrLocaciones[2][$i]->getNombre();?></span>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Dirección de plano a revisar (*)</span><br>
              <input type="text" class="form-control" id="direccionPropiedad" name="direccionPropiedad">
            </div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Distrito (*)</span><br>
              <select name="distrito" id="slDistrito" class="form-control">
                <?php for ($i = 0; $i < count($distritos); $i++) { ?>
                    <?php if ($distritos[$i]->getIdCanton() == 36) {?>
                        <option value="<?php echo $distritos[$i]->getId(); ?>"><?php echo $distritos[$i]->getNombre(); ?></option>
                    <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Número de plano o presentación (*)</span><br>
              <input type="text" class="form-control" id="numeroPlano" name="numeroPlano">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Área del plano (*)</span><br>
              <input type="text" class="form-control" id="areaPlano" name="areaPlano">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Número de Finca (*)</span><br>
              <input type="text" class="form-control" id="numeroFinca" name="numeroFinca">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Área según Registro Público (*)</span><br>
              <input type="text" class="form-control" id="areaRegistroPublico" name="areaRegistroPublico">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Frente (*)</span><br>
              <input type="text" class="form-control" id="frente" name="frente">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Número de Contrato CFIA (*)</span><br>
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
                <li><span>Si el plano a visar se encuentra frente a la red vial nacional, definida en el artículo N°1 de la Ley General de Caminos Públicos, deberá aportar original y tres copias con el alineamiento oficial del Ministerio de Obras Públicas y Transportes. Carta de certificación emitida por el MOPT en donde se indica el retiro de Ley para construir cercas y  edificaciones.</span></li>
              </ol>
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Carta de Disponibilidad de Agua (*)</span><br>
              <input type="file" class="form-control" id="flCartaDisponibilidad" name="flCartaDisponibilidad">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Croquis (*)</span><br>
              <input type="file" class="form-control" id="flCroquis" name="flCroquis">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Plano Corregido (*)</span><br>
              <input type="file" class="form-control" id="flPlanoCorregido" name="flPlanoCorregido">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Copia de la minuta (*)</span><br>
              <input type="file" class="form-control" id="flMinuta" name="flMinuta">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Carta de certificación  MOPT</span><br>
              <input type="file" class="form-control" id="flCartaMOPT" name="flCartaMOPT">
            </div>
            <div class="col-12 mt-md-3 text-center">
              <span class="mb-3">Firma (*)</span><br>
              <canvas id="canvas" class="w-100 mx-auto" style="max-width: 300px;" height="200"></canvas>

              <br>
              <input type="hidden" name="firma" id="firma">
              <button id="clear" class="btn btn-outline-danger">Limpiar</button>
            </div>
            <input type="hidden" name="estadoSolicitud" id="slEstado" value="12">
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
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="./Vista/assets/js/visado.js"></script>
  <script src="./Vista/assets/js/firmas.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
  <script src="./Vista/assets/js/busquedaDinamicaCedula.js"></script>
  <script>
    $('#slCanton').select2();
    $('#slProvincia').select2();
    $('#slDistrito').select2();
  </script>