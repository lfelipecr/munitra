<main class="col-sm-10 bg-body-tertiary" id="main">
    <div class="container-fluid">

      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        id="title">
        <h1 class="h2">Categorías</h1>
        <a href="index.php?controlador=Documentacion&metodo=Listado" class="btn btn-outline-secondary">
          <span>x</span>
        </a>
      </div>
      <input type="hidden" id="tipos" value="<?php echo $tipos; ?>">
      <form action="index.php?controlador=Documentacion&metodo=CrearCategoria" id="frmDoc" method="post" enctype="multipart/form-data">
        <div class="p-3 bg-body rounded shadow-sm">
          <div class="row mt-3">
            <div class="col-12">
              <span class="mb-2">Descripcion (*)</span>
              <input type="text" class="form-control mb-3" name="descripcion" id="descripcion">
            </div>            
            <div class="col-12 py-2">
              <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
            </div>
            <div class="col-12 d-flex align-items-center mb-3">
              <button type="submit" class="btn btn-outline-warning mx-1">
                <span>Agregar +</span>
              </button>
            </div>
            <hr>
            <div class="col-md-12 my-3">
                <?php if ($tipos!= null) {?>
                    <table class="table table-responsive">
                        <thead>
                            <th>Descripción</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                                for ($i = 0 ; $i < count($tipos); $i++) {?>
                                <tr>
                                    <td><?php echo $tipos[$i]->getDescripcion(); ?></td>
                                    <td class="text-end">
                                        <a href="index.php?controlador=Documentacion&metodo=EliminarCategoria&id=<?php echo $tipos[$i]->getId(); ?>" class="btn btn-outline-danger"><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {?>
                    <p class="text-center">No hay categorías</p>
                <?php } ?>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script>
    $(document).ready(function(){
        $('#alerta').hide();
        return false;
    });
    $('#frmDoc').on('submit', function (){
        let descripcion = $('#descripcion').val();
        console.log(descripcion)
        if (descripcion != ''){
            return true;
        }
        $('#alerta').show();
        $('#alerta').html('Debe añadir una descripcion')
        return false;
    });
  </script>