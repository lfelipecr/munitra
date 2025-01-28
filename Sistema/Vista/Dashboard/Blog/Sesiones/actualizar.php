<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">

      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Actualizar Sesión: <?php echo $sesion->getDescripcion();?></h1>
        <a href="index.php?controlador=Blog&metodo=Sesiones" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="msg" value="<?php echo $msg; ?>">
      <form action="index.php?controlador=Sesion&metodo=Actualizar" id="frmSesion" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $sesion->getId();?>" name="id">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <div class="row mt-3">
            <div class="col-12">
              <span class="mb-4">Descripcion (*)</span>
              <input type="text" class="form-control mb-3" name="descripcion" id="txtDescripcion" value="<?php echo $sesion->getDescripcion();?>">
            </div>
            <div class="col-12">
                <span class="mb-4">Fecha y Hora (*)</span>
                <input type="datetime-local" class="form-control" name="fechaSesion" id="ipFechaHora" value="<?php echo $sesion->getFecha();?>">
            </div>
            <div class="col-md-4">
                <span class="mb-4">Acta</span>
                <input type="file" class="form-control" name="acta" id="ipUrlActa">
            </div>
            <div class="col-md-4">
                <span class="mb-4">Agenda</span>
                <input type="file" class="form-control" name="agenda" id="ipUrlAgenda">
            </div>
            <div class="col-md-4">
                <span class="mb-4">Link Sesión</span>
                <input type="text" class="form-control" name="urlVideo" id="ipUrlVideo" value="<?php echo $sesion->getUrlVideo();?>">
            </div>
            <div class="col-12 mt-md-2">
              <span class="mb-3">Acta Aprobada</span>
              <input type="checkbox" id="cbxActa" <?php if ($sesion->getActaAprobada() == 1){ echo 'checked'; } ?>>
              <input type="hidden" name="valorActa" value="<?php echo $sesion->getActaAprobada();?>" id="valorActa">
            </div>
            <div class="col-12 py-2">
              <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
            </div>
            <div class="col-12 d-flex align-items-center mb-3">
              <button type="submit" class="btn btn-outline-warning mx-1">
                <span>Ingresar +</span>
              </button>
              <a href="index.php?controlador=Blog&metodo=Sesiones" class="btn btn-outline-danger mx-1">
                <span>Cancelar x</span>
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="./Vista/assets/js/sesiones.js"></script>