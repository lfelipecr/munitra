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
      <h1 class="h2">Nueva Solicitud de Condonación</h1>
      <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="jsonData" value="">
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <form action="index.php?controlador=Condonacion&metodo=Ingresar" id="frmCondonacion" method="post" enctype="multipart/form-data">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row mt-3">
          <div class="col-12">
            <span class="mb-3">Solicitante (*)</span>
            <select name="persona" id="slPersonas" class="form-control">
              <?php for ($i = 0; $i < count($personas); $i++) { ?>
                <option value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre() . " " . $personas[$i]->getPrimerApellido() . " " . $personas[$i]->getSegundoApellido()." (".$personas[$i]->getIdentificacion().")"; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Representante Legal (*)</span><br>
            <input type="text" class="form-control" name="representante" id="txtRepresentante">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Identificación N° (*)</span><br>
            <input type="text" class="form-control" name="identificacionRepresentante" id="txtIdentificacionRepresentante">
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Dirección (*)</span><br>
            <input type="text" class="form-control" name="direccion" id="txtDireccion">
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Notificaciones (*)</span><br>
            <input type="text" class="form-control" name="notificaciones" id="txtNotificaciones">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Tipo de Solicitud (*)</span><br>
            <select name="tipoSolicitud" id="tipoSolicitud" class="form-control">
              <option selected value="Pago de contado" id="contadoOpcion">Pago de contado</option>
              <option value="Arreglo de pago" id="arregloOpcion">Arreglo de pago</option>
            </select>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Recibido por (*)</span><br>
            <input type="text" name="recibido" id="txtRecibido" class="form-control">
          </div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12 text-center">
            <span class="h4"><strong>Para uso interno de la administración tributaria</strong></span>
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Fecha</span><br>
            <input type="date" class="form-control" name="fecha" id="fecha">
          </div>
          <div class="col-md-6 mt-md-3">
            <span class="mb-3">Consecutivo</span><br>
            <input type="text" class="form-control" name="consecutivo" id="consecutivo">
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Funcionario</span><br>
            <select name="funcionario" id="slFuncionarios" class="form-control">
              <?php for ($i = 0; $i < count($personas); $i++) { ?>
                <option value="<?php echo $personas[$i]->getNombre() . " " . $personas[$i]->getPrimerApellido() . " " . $personas[$i]->getSegundoApellido(); ?>"><?php echo $personas[$i]->getNombre() . " " . $personas[$i]->getPrimerApellido() . " " . $personas[$i]->getSegundoApellido(); ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="pagoContado" class="row">
            <div class="col-md-12 mt-3">
              <span><strong>Modalidad: Pago de Contado</strong></span>
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Total</span><br>
              <input type="number" class="form-control" name="totalContado" id="totalContado">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Monto a Condonar</span><br>
              <input type="number" class="form-control" name="montoCondonarContado" id="montoCondonarContado">
            </div>
            <div class="col-md-12 mt-md-3">
              <span class="mb-3">Fecha de pago</span><br>
              <input type="date" class="form-control" name="fechaPago" id="fechaPago">
            </div>
          </div>
          <div id="pagoArreglo" class="row">
            <div class="col-md-12 mt-3">
              <span><strong>Modalidad: Arreglo de Pago</strong></span>
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Total</span><br>
              <input type="number" class="form-control" name="totalArreglo" id="totalArreglo">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Monto a Condonar</span><br>
              <input type="number" class="form-control" name="montoCondonarArreglo" id="montoCondonarArreglo">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Plazo en meses</span><br>
              <input type="number" class="form-control" name="plazoMeses" id="plazoMeses">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Desde</span><br>
              <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
            </div>
            <div class="col-md-4 mt-md-3">
              <span class="mb-3">Cantidad de Cuotas</span><br>
              <input type="number" class="form-control" name="cantidadCuotas" id="cantidadCuotas">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Adelanto 20%</span><br>
              <input type="number" class="form-control" name="adelanto" id="adelanto">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Pago por Cuota</span><br>
              <input type="number" class="form-control" name="pagoPorCuota" id="pagoPorCuota">
            </div>
          </div>
          <div class="col-md-12 mt-md-3">
            <span class="mb-3">Resolucion</span><br>
            <select name="resolucion" id="resolucion" class="form-control">
              <option value="Aprobación">Aprobación</option>
              <option value="Denegatoria">Denegatoria</option>
              <option value="Prevención" id="opcionPrevencion">Prevención</option>
            </select>
          </div>
          <div id="prevencion" class="row">
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Plazo (*)</span><br>
              <input type="number" class="form-control" name="plazo" id="plazo">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Fecha de Notificación (*)</span><br>
              <input type="date" class="form-control" name="fechaNotificacion" id="fechaNotificacion">
            </div>
            <div class="col-md-12 mt-md-3 d-flex align-items-center">
              <span class="mx-1">Cumple</span><br>
              <input type="checkbox" id="cbxCumple">
              <input type="hidden" name="cumple" value="" id="valorCumple">
            </div>
          </div>
          <div class="col-12 mt-md-3">
            <hr>
          </div>
          <div class="col-12 mt-md-1">
            <span class="mb-3">Estado de Solicitud</span><br>
            <select name="estadoSolicitud" id="slEstado" class="form-control">
              <option value="1">Nueva</option>
              <option value="2">En proceso</option>
              <option value="3">Prevención 1</option>
              <option value="4">Prevención 2</option>
              <option value="5">Aprobada</option>
              <option value="6">Rechazada</option>
              <option value="7">Cancelada</option>
              <option value="8">Retirada</option>
            </select>
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Ingresar +</span>
            </button>
            <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-danger mx-1">
              <span>Cancelar x</span>
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
<script src="./Vista/assets/js/condonaciones.js"></script>
<script src="./Vista/assets/js/firmas.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>