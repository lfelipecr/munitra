<style>
  .bgNoticiaNoPic{
  background-color: var(--d-blue);
  height: 4em;
  box-shadow: var(bla);

}
</style>
<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="title">
        <h1 class="h2">Documentación Departamental - <?php echo $departamento->getDescripcion();?></h1>
        <div class="form-floating">
          <a href="index.php?controlador=Documentacion&metodo=Categorias" class="btn btn-outline-secondary">
            <span>Categorías</span>
          </a>
        </div>
        <a href="index.php?controlador=Documentacion&metodo=VIngresar" class="btn btn-outline-primary">
          <span>Agregar +</span>
        </a>
      </div>
      <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <div class="row" id="docs"></div>
  </div>
<script src="./Vista/assets/js/listadoDocsDepto.js"></script>
<script src="./Vista/assets/js/dashboardDependencia/misc.js"></script>
</main>