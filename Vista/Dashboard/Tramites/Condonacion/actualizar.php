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
      <input type="hidden" id="idSolicitante" value="<?php echo $solicitud->getIdPersona();?>">
      <form action="index.php?controlador=Condonacion&metodo=Actualizar" id="frmCondonacion" method="post" enctype="multipart/form-data">
      <input type="hidden" id="idSolicitud" value="<?php echo $id; ?>" name="idSolicitud">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <div class="row mt-3">
            <div class="col-12">
              <span class="mb-3">Solicitante (*)</span>
              <select name="persona" id="slPersonas" class="form-control">
                <?php for ($i = 0; $i < count($personas); $i++) {
                  if ($personas[$i]->getId() == $solicitud->getIdPersona()){ ?>
                    <option selected value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?></option>
                  <?php } else {?>
                    <option value="<?php echo $personas[$i]->getId(); ?>"><?php echo $personas[$i]->getNombre()." ".$personas[$i]->getPrimerApellido()." ".$personas[$i]->getSegundoApellido(); ?></option>
                  <?php }?>
                <?php }?>
              </select>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-md-6 mt-md-3">
              <span class="mb-3">Representante Legal (*)</span><br>
              <input type="hidden" id="idRepresentante" name="idRepresentante">
              <input type="text" class="form-control" name="representante" id="txtRepresentante">
            </div>
            <div class="col-md-6 mt-md-3">
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
            <div class="col-12 mt-md-3 text-center">
              <span class="mb-3 embedTxt">Firma (*)</span><br>
              <img src="" class="img-fluid border rounded" id="firmaCredenciales" alt="">
              <br>
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
            <input type="hidden" id="idEstado" value="<?php echo $solicitud->getEstadoSolicitud() ?>">
            <div class="col-12 mt-md-3">
              <span class="mb-3">Estado de Solicitud</span><br>
              <select name="estadoSolicitud" id="slEstado" class="form-control">
                <option id="estado1" value="1">Nueva</option>
                <option id="estado2" value="2">En proceso</option>
                <option id="estado3" value="3">Prevención 1</option>
                <option id="estado4" value="4">Prevención 2</option>
                <option id="estado5" value="5">Aprobada</option>
                <option id="estado6" value="6">Rechazada</option>
                <option id="estado7" value="7">Cancelada</option>
                <option id="estado8" value="8">Retirada</option>
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
              <a href="index.php?controlador=Tramites&metodo=Condonacion" class="btn btn-outline-danger mx-1">
                <span>Cancelar x</span>
              </a>
              <a class="btn btn-outline-info mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalBitacora" onclick="CambiarFormulario(0)">
                <span><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
              </a>
              <a class="btn btn-outline-info mx-1" id="btnVer" data-bs-toggle="modal" data-bs-target="#modalBitacora" onclick="CambiarFormulario(1)">
                <span class="my-1">Interno <svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal fade" id="modalBitacora" tabindex="-1" aria-labelledby="modalBitacoraLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalBitacoraLabel">Bitácora de Solicitud</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row" id="bitacora"></div>
          </div>
          <div class="modal-footer d-block">
            <div class="mb-2">
              <label for="" class="form-label">Cuerpo *</label>
              <textarea name="cuerpoEmail" class="form-control" id="txtCuerpo"></textarea>
            </div>
            <div class="mb-2">
              <label for="" class="form-label">Adjuntos</label>
              <input type="file" class="form-control"  name="adjuntos[]" multiple id="idAjuntos">
            </div>
            <div class="mb-2 text-end">
                <a class="btn btn-warning" id="btnEnviarExterno">
                    <span>Enviar</span>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="./Vista/assets/js/condonaciones.js"></script>
  <script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
  <script src="./Vista/assets/js/visualizacionSolicitudes.js"></script>
  <script src="./Vista/assets/js/bitacoraInterna.js"></script>