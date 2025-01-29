<style>
  #canvas {
    border: .5px solid black;
    cursor: crosshair;
  }
  .rojo{
    color: red;
  }
</style>
<main class="col-sm-10 bg-body-tertiary" id="main">
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
            <div class="col-4 mt-md-3">
              <span class="mb-3">Número de plano o presentación (*)</span><br>
              <input type="text" class="form-control" id="numeroPlano" name="numeroPlano">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Área del plano (*)</span><br>
              <input type="text" class="form-control" id="areaPlano" name="areaPlano">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Número de Finca (*)</span><br>
              <input type="text" class="form-control" id="numeroFinca" name="numeroFinca">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Área según Registro Público (*)</span><br>
              <input type="text" class="form-control" id="areaRegistroPublico" name="areaRegistroPublico">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Frente (*)</span><br>
              <input type="text" class="form-control" id="frente" name="frente">
            </div>
            <div class="col-4 mt-md-3">
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
            <div class="col-4 mt-md-3">
              <span class="mb-3">Carta de Disponibilidad de Agua (*)</span><br>
              <input type="file" class="form-control" id="flCartaDisponibilidad" name="flCartaDisponibilidad">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Croquis (*)</span><br>
              <input type="file" class="form-control" id="flCroquis" name="flCroquis">
            </div>
            <div class="col-4 mt-md-3">
              <span class="mb-3">Plano Corregido (*)</span><br>
              <input type="file" class="form-control" id="flPlanoCorregido" name="flPlanoCorregido">
            </div>
            <div class="col-6 mt-md-3">
              <span class="mb-3">Copia de la minuta (*)</span><br>
              <input type="file" class="form-control" id="flMinuta" name="flMinuta">
            </div>
            <div class="col-6 mt-md-3">
              <span class="mb-3">Carta de certificación  MOPT</span><br>
              <input type="file" class="form-control" id="flCartaMOPT" name="flCartaMOPT">
            </div>
            <div class="col-12 mt-md-3 text-center">
              <span class="mb-3">Firma (*)</span><br>
              <canvas id="canvas" width="400" height="200"></canvas>
              <br>
              <input type="hidden" name="firma" id="firma">
              <button id="clear" class="btn btn-outline-danger">Limpiar</button>
            </div>
            <div class="col-12 mt-md-3">
              <span class="mb-3">Estado de Solicitud</span><br>
              <select name="estadoSolicitud" id="slEstado" class="form-control">
                <option value="1">Aprobada</option>
                <option value="2">No Aprobada</option>
              </select>
            </div>   
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
