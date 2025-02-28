<main class="col-sm-10 bg-body-tertiary" id="main">
  <div class="container-fluid">

    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Actualizar Noticia: <?php echo $noticia->getTitulo(); ?></h1>
      <a href="index.php?controlador=Blog&metodo=Noticias" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <input type="hidden" id="msg" value="<?php echo $msg; ?>">
    <form action="index.php?controlador=Noticia&metodo=Actualizar" id="frmNoticia" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $noticia->getId(); ?>">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row mt-3">
          <div class="col-12">
            <span class="mb-3">Titulo (*)</span>
            <input type="text" class="form-control mb-3" name="titulo" id="txtTitulo" value="<?php echo $noticia->getTitulo(); ?>">
          </div>
          <div class="col-12">
            <span class="mb-3">Descripción (*)</span>
            <div name="descripcionLarga" class="form-control" id="txtDescripcion" rows="5"><?php echo $noticia->getDescripcionLarga(); ?></div>
            <input type="hidden" name="descripcionLarga" id="valDescripcion" value="<?php echo $noticia->getDescripcionLarga(); ?>">
          </div>
          <div class="col-12 mt-md-3" style="padding-top: 3.5em">
            <span class="mb-3">Nueva Portada (jpg, png, jpeg)</span> <br>
            <input type="file" class="form-control" name="imagen">
          </div>
          <div class="col-12 mt-md-3">
            <span class="mb-3">Archivo adjunto</span> <br>
            <input type="file" class="form-control" name="adjunto">
          </div>
          <div class="col-12 mt-md-3">
            <span class="mb-3">Fecha (*)</span><br>
            <input type="date" class="form-control" value="<?php echo $noticia->getFecha(); ?>" name="fecha">
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <button type="submit" class="btn btn-outline-warning mx-1">
              <span>Ingresar +</span>
            </button>
            <a href="index.php?controlador=Blog&metodo=Noticias" class="btn btn-outline-danger mx-1">
              <span>Cancelar x</span>
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
<script src="./Vista/assets/js/noticias.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>