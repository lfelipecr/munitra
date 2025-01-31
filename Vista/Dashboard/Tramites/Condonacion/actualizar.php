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
        <h1 class="h2">Actualizar Solicitud de Condonación</h1>
        <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Condonacion&metodo=Actualizar" id="frmCondonacion" method="post" enctype="multipart/form-data">
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
            <div class="col-6 mt-md-3">
              <span class="mb-3">Representante Legal (*)</span><br>
              <input type="hidden" id="idRepresentante" name="idRepresentante">
              <input type="text" class="form-control" name="representante" id="txtRepresentante">
            </div>
            <div class="col-6 mt-md-3">
              <span class="mb-3">Identificación N° (*)</span><br>
              <input type="hidden" id="idIdentificacionRepresentante" name="idIdentificacionRepresentante">
              <input type="text" class="form-control" name="identificacionRepresentante" id="txtIdentificacionRepresentante">
            </div>
            <div class="col-md-12 mt-md-3">
              <span class="mb-3">Dirección (*)</span><br>
              <input type="hidden" id="idDireccion" name="idDireccion">
              <input type="text" class="form-control" name="direccion" id="txtDireccion">
            </div>
            <div class="col-md-12 mt-md-3">
              <span class="mb-3">Notificaciones (*)</span><br>
              <input type="hidden" id="idNotificaciones" name="idNotificaciones">
              <input type="text" class="form-control" name="notificaciones" id="txtNotificaciones">
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Tipo de Solicitud (*)</span><br>
              <input type="hidden" id="idTipoSolicitud" name="idTipoSolicitud">
              <select name="tipoSolicitud" id="tipoSolicitud" class="form-control">
                <option selected value="Pago de contado" id="contadoOpcion">Pago de contado</option>
                <option value="Arreglo de pago" id="arregloOpcion">Arreglo de pago</option>
              </select>
            </div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Recibido por (*)</span><br>
              <input type="hidden" id="idRecibido" name="idRecibido">
              <input type="text" name="recibido" id="txtRecibido" class="form-control">
            </div>
            <div class="col-md-12 mt-md-3 text-center">
              <span class="mb-3">Firma (*)</span><br>
              <canvas id="canvas" width="400" height="200"></canvas>
              <br>
              <input type="hidden" id="idFirma" name="idFirma">
              <input type="hidden" name="firma" id="firma">
              <button id="clear" class="btn btn-outline-danger">Limpiar</button>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 text-center">
                <span class="h4"><strong>Para uso interno de la administración tributaria</strong></span>
            </div>
            <div class="col-md-6 mt-md-3">
                <span class="mb-3">Fecha</span><br>  
                <input type="hidden" id="idFecha" name="idFecha">
                <input type="date" class="form-control" name="fecha" id="fecha">
            </div>
            <div class="col-md-6 mt-md-3">
                <span class="mb-3">Consecutivo</span><br>  
                <input type="hidden" id="idConsecutivo" name="idConsecutivo">
                <input type="text" class="form-control" name="consecutivo" id="consecutivo">
            </div>
            <div class="col-md-12 mt-md-3">
                <span class="mb-3">Funcionario</span><br>  
                <input type="hidden" id="idFuncionario" name="idFuncionario">
                <select name="funcionario" id="slFuncionarios" class="form-control">
                    <?php for ($i = 0; $i < count($personas); $i++) {?>
                    <option id="<?php echo $personas[$i]->getNombre()."_".$personas[$i]->getPrimerApellido()."_".$personas[$i]->getSegundoApellido(); ?>" value="<?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?>"><?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?></option>
                    <?php }?>
                </select>
            </div>
            <div id="pagoContado" class="row">
                <div class="col-md-12 mt-3">
                    <span><strong>Modalidad: Pago de Contado</strong></span>
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Total</span><br>  
                    <input type="hidden" id="idTotalContado" name="idTotalContado">
                    <input type="number" class="form-control" name="totalContado" id="totalContado">
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Monto a Condonar</span><br>  
                    <input type="hidden" id="idMontoCondonarContado" name="idMontoCondonarContado">
                    <input type="number" class="form-control" name="montoCondonarContado" id="montoCondonarContado">
                </div>
                <div class="col-md-12 mt-md-3">
                    <span class="mb-3">Fecha de pago</span><br>  
                    <input type="hidden" id="idFechaPago" name="idFechaPago">
                    <input type="date" class="form-control" name="fechaPago" id="fechaPago">
                </div>
            </div>
            <div id="pagoArreglo" class="row">
                <div class="col-md-12 mt-3">
                    <span><strong>Modalidad: Arreglo de Pago</strong></span>
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Total</span><br>  
                    <input type="hidden" id="idTotalArreglo" name="idTotalArreglo">
                    <input type="number" class="form-control" name="totalArreglo" id="totalArreglo">
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Monto a Condonar</span><br>  
                    <input type="hidden" id="idMontoCondonarArreglo" name="idMontoCondonarArreglo">
                    <input type="number" class="form-control" name="montoCondonarArreglo" id="montoCondonarArreglo">
                </div>
                <div class="col-md-4 mt-md-3">
                    <span class="mb-3">Plazo en meses</span><br>  
                    <input type="hidden" id="idPlazoMeses" name="idPlazoMeses">
                    <input type="number" class="form-control" name="plazoMeses" id="plazoMeses">
                </div>
                <div class="col-md-4 mt-md-3">
                    <span class="mb-3">Desde</span><br>  
                    <input type="hidden" id="idFechaInicio" name="idFechaInicio">
                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
                </div>
                <div class="col-md-4 mt-md-3">
                    <span class="mb-3">Cantidad de Cuotas</span><br>  
                    <input type="hidden" id="idCantidadCuotas" name="idCantidadCuotas">
                    <input type="number" class="form-control" name="cantidadCuotas" id="cantidadCuotas">
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Adelanto 20%</span><br>  
                    <input type="hidden" id="idAdelanto" name="idAdelanto">
                    <input type="number" class="form-control" name="adelanto" id="adelanto">
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Pago por Cuota</span><br>  
                    <input type="hidden" id="idPagoPorCuota" name="idPagoPorCuota">
                    <input type="number" class="form-control" name="pagoPorCuota" id="pagoPorCuota">
                </div>
            </div>
            <div class="col-md-12 mt-md-3">
                <span class="mb-3">Resolucion</span><br>  
                <input type="hidden" id="idResolucion" name="idResolucion">
                <select name="resolucion" id="resolucion" class="form-control">
                    <option value="Aprobación">Aprobación</option>
                    <option value="Denegatoria">Denegatoria</option>
                    <option value="Prevención" id="opcionPrevencion">Prevención</option>
                </select>
            </div>
            <div id="prevencion" class="row">
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Plazo (*)</span><br>  
                    <input type="hidden" id="idPlazo" name="idPlazo">
                    <input type="number" class="form-control" name="plazo" id="plazo">
                </div>
                <div class="col-md-6 mt-md-3">
                    <span class="mb-3">Fecha de Notificación (*)</span><br>  
                    <input type="hidden" id="idFechaNotificacion" name="idFechaNotificacion">
                    <input type="date" class="form-control" name="fechaNotificacion" id="fechaNotificacion">
                </div>
                <div class="col-md-12 mt-md-3 d-flex align-items-center">
                    <span class="mx-1">Cumple</span><br>
                    <input type="checkbox" id="cbxCumple">
                    <input type="hidden" id="idCumple" name="idCumple">
                    <input type="hidden" name="cumple" value="" id="valorCumple">
                </div>
            </div>
            <div class="col-12 mt-md-3"><hr></div>
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