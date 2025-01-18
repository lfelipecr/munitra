<!doctype html>
<html lang="es" data-bs-theme="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./Vista/assets/estilos.css">
    </head>
    <body>
        <div class="container-fluid w-100 bg-white">
            <div class="mt-5">
                <div class="text-end mb-2">
                  <a data-bs-toggle="modal" data-bs-target="#modalConf"><svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>    </a>
                </div>
                <div class="card p-5">
                  <h1 class="h3">Lista:</h1>
                  <div class="row">
                      <div class="col-6">
                          <div class="form-floating mb-3">
                              <input type="text" id="cedula" name="" class="form-control" placeholder="">
                              <label>Cédula</label>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-floating mb-3">
                            <input type="text" id="invitacion" name="" class="form-control" placeholder="">
                            <label>N° Ticket</label>
                          </div>
                      </div>
                      <div class="col-12 text-end">
                          <input type="hidden" id="data" value='<?php echo $datosJSON;?>'> 
                          <button id="buscar" class="btn-outline-danger btn">
                            <span class="p-1 px-5">Buscar</span>
                          </button>  
                          <div id="alerta" class="card mt-1 mb-3 p-3 alert alert-danger"></div>
                      </div>
                  </div>
                  <table class="table table-hover table-responsive">
                      <thead>
                          <td>ID Invitación</td>
                          <td>Cédula</td>
                          <td>Nombre Completo</td>
                      </thead>
                      <tbody id="cuerpoTabla">
                      </tbody>
                  </table>
                </div>
                <div class="card p-5 mt-1">
                  <div class="row mb-3">
                    <div class="col-6">
                      <h1 class="h3">No aceptados</h1>
                    </div>
                    <div class="col-6 text-end">
                      <button class="btn-outline-danger btn" onclick="Toggle();">
                        <span class="p-1 px-5">
                          +
                        </span>
                      </button>  
                    </div>
                  </div>
                  <div id="noAceptados">
                    <hr>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <td>ID Invitación</td>
                            <td>Cédula</td>
                            <td>Nombre Completo</td>
                            <td></td>
                        </thead>
                        <tbody id="cuerpoTablaNoAceptados">
                        </tbody>
                    </table>
                  </div>
                </div>
                
              </div>    
            </div>
        </div>
        </div>
        <div class="modal fade" id="modalConf" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Configurar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="index.php?controlador=Usuario&metodo=ModificarAforo" method="post">
                  <div class="form-floating mb-3">
                    <input type="text" id="" name="aforo" value="<?php echo $aforo;?>" class="form-control" placeholder="">
                    <label>Aforo</label>
                  </div>
                
              </div>
              <div class="modal-footer">
                  <button class="btn-outline-danger btn" type="submit">
                    <span class="p-1 px-2">Guardar</span>
                  </button>
                  </form>
                  <a href="index.php" class="btn-outline-warning btn">
                    <span class="p-1 px-2">Cerrar Sesión</span>
                  </a>
              </div>
            </div>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
        <script src="./Vista/js/lista.js"></script>
        <script>
          let toggle = true;
          $('#noAceptados').hide();
          function Toggle(){
            if (toggle)
              $('#noAceptados').show();
            else
              $('#noAceptados').hide();
            toggle = !toggle;
          }
        </script>
    </body>
</html>
