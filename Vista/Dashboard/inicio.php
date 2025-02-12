<style>
.chat{
  transition: .35s ease;  
}
.chat:hover{
  border: 1px solid var(--d-blue);
  background-color: var(--d-blue);
  border-radius: 1em;
  padding: 1em;
  color: #FEFEFE;
  transition: .35s ease;
}
.departamento{
  border: 1px solid #FEFEFE;
  background-color: #FEFEFE;
  border-radius: 1em;
  padding: 1em;
  color: black;
  transition: .35s ease;
}
.departamento:hover{
  border: 1px solid var(--d-blue);
  background-color: var(--d-blue);
  color: #FEFEFE;
}
.iconDpto{
  width: 2em;
}
.udDepartamento{
  padding-left: .5em;
  padding-right: .5m;
}
</style>
<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
        <h1 class="h2">Inicio - Notificaciones</h1>
        <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
        <input type="hidden" id="idUsuario" value="<?php echo $idUsuario; ?>">
      </div>
      <div class="row mx-3">
        <div class="udDepartamento">
            <p class="d-inline-flex gap-1">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between departamento"  data-bs-toggle="collapse" href="#collapseNotiMuni" role="button">
                        <h4>Notificaciones Municipalidad</h4>
                    </div>
                </div>
            </p>
            <div class="collapse" id="collapseNotiMuni">
                <div class="card card-body">
                    <div class="row justify-content-between" id="listadoNotiMuni"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="row mx-3">
        <div class="udDepartamento">
            <p class="d-inline-flex gap-1">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between departamento"  data-bs-toggle="collapse" href="#collapseNotiPersona" role="button">
                        <h4>Notificaciones {PERSONA}</h4>
                    </div>
                </div>
            </p>
            <div class="collapse" id="collapseNotiPersona">
                <div class="card card-body">
                    <div class="row justify-content-between" id="listadoNotiPersona"></div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script src="./Vista/assets/js/correos.js"></script>
    <div class="modal fade" id="modalConversacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalBitacoraLabel">Consulta</h1>
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
            <div class="mb-2 text-end">
                <button type="submit" class="btn btn-warning">
                    <span>Enviar</span>
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>