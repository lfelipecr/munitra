<main class="col-sm-10 bg-body-tertiary" id="main">
  <div class="container-fluid">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
      id="title">
      <h1 class="h2">Banners</h1>
      <a href="index.php?controlador=Blog&metodo=Index" class="btn btn-outline-secondary">
        <span>x</span>
      </a>
    </div>
    <div>
      <div class="p-3 bg-body rounded shadow-sm">
        <div class="row mt-3">
          <div class="col-12">
            <span class="mb-2">Descripción (*)</span>
            <input type="text" class="form-control mb-3" name="descripcion" id="descripcion">
          </div>
          <div class="col-12">
            <span class="mb-2">Banner (*)</span>
            <input type="file" class="form-control mb-3" name="banner" id="banner">
          </div>
          <div class="col-12 py-2">
            <div class="alert alert-danger mt-1" role="alert" id="alerta"></div>
          </div>
          <div class="col-12 d-flex align-items-center mb-3">
            <a id="btnEnviar" type="submit" class="btn btn-outline-warning mx-1">
              <span>Agregar +</span>
            </a>
          </div>
          <hr>
          <div class="col-md-12 my-3">
            <?php if ($listado != null) { ?>
              <table class="table table-responsive">
                <thead>
                  <th>Descripción</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php while ($fila = $listado->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $fila['DESCRIPCION'] ?></td>
                      <td class="text-end">
                        <a href="index.php?controlador=Blog&metodo=ActivarBanner&id=<?php echo $fila['ID'] ?>" class="<?php echo ($fila['ACTIVO'] == '0') ? 'btn btn-warning' : 'btn btn-outline-success'; ?>"><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="currentColor" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 224c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z" />
                          </svg></a>
                        <a href="index.php?controlador=Blog&metodo=EliminarBanner&id=<?php echo $fila['ID'] ?>" class="btn btn-outline-danger"><svg style="width: 1em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="currentColor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                          </svg></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } else { ?>
              <p class="text-center">No hay categorías</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function() {
    $('#alerta').hide();
    return false;
  });
  $('#btnEnviar').on('click', function() {
    let descripcion = $('#descripcion').val();
    if (descripcion != '') {
      let formData = new FormData();
      let archivos = document.getElementById("banner").files;
      formData.append('descripcion', descripcion);
      formData.append('banner', archivos[0]);
      $.ajax({
        url: "index.php?controlador=Blog&metodo=NuevoBanner",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response != 'Ok') {
            $('#alerta').show();
            $('#alerta').html(response);
          }
        },
        error: function(xhr, status, error) {
          console.error("Error en la petición:", error);
        }
      }).then(function() {
        location.reload();
      });

    } else {
      $('#alerta').show();
      $('#alerta').html('Debe añadir una descripcion');
    }
  });
</script>