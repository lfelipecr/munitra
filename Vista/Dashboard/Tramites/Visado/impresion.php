<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patentes RS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .subrayado{
            text-decoration: underline;
        }
        h6{
            margin-top: .5em;
            margin-bottom: .5em;
            font-weight: bold;
        }
        table {
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #2c3c8b !important;
            color: white !important;
            text-align: center;
        }
        footer img, header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <header>
        <img src="./Web/assets/img/headerpdf.png" class="img-fluid" alt="Imagen del pie de página">
    </header>
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12 text-center">
                <h6>SOLICITUD DE VISADO</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th colspan="3">SOLICITANTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Tipo de Identificación: <?php echo $tiposId[$persona->getIdTipoIdentificacion()];?></td>
                            <td>Cédula N°: <?php echo $persona->getIdentificacion();?></td>
                        </tr>
                        <tr>
                            <td colspan="3">Dirección: <?php echo $persona->getDireccion();?></td>
                        </tr>
                        <tr>
                            <td colspan="3">Correo Electrónico: <?php echo $persona->getCorreo();?></td>
                        </tr>
                        <tr>
                            <td>Nombre: <?php echo $persona->getNombre();?></td>
                            <td>Primer Apellido: <?php echo $persona->getPrimerApellido();?></td>
                            <td>Segundo Apellido: <?php echo $persona->getSegundoApellido();?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Teléfono: <?php echo $persona->getTelefono();?></td>
                            <td>Whatsapp: <?php echo $persona->getWhatsapp();?></td>
                        </tr>
                        <tr>
                            <td>Provincia: <?php echo $locaciones['provincia'];?></td>
                            <td>Cantón: <?php echo $locaciones['canton'];?></td>
                            <td>Distrito: <?php echo $locaciones['distrito'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3">SOLICITUD DE VISADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Dirección de plano a revisar: <span id="direccionPropiedad"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Distrito: <span id="distrito"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Número de plano o presentación: <span id="numeroPlano"></span></td>
                            <td>Área del plano: <span id="areaPlano"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Número de finca: <span id="numeroFinca"></span></td>
                            <td>Área según registro público: <span id="areaRegistroPublico"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Frente: <span id="frente"></span></td>
                            <td>Número de Contrato CFIA: <span id="numeroContrato"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex">
                <h6>Firma:</h6>
                <img src="" class="img-fluid card" alt="" id="firmaCredenciales">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3">PARA USO MUNICPAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Fecha:</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 50%;">Funcionario:</td>
                            <td style="width: 50%;">Firma:</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <img src="./Web/assets/img/footerpdf.png" alt="Imagen del pie de página">
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    
    <script>
        function RenderizarDatosJSON(){
            let datos = $('#jsonData').val();
            if (datos != ''){
                datos = JSON.parse(datos);
                console.log(datos);
                for (let i = 0; i < datos.length; i++)
                {
                    switch  (datos[i][4]){
                        case '18':
                            $('#direccionPropiedad').html(datos[i][1]);
                            break;
                        case '19':
                            let distrito = '';
                            switch (datos[i][1]){
                                case '172':
                                    distrito = 'Río Cuarto';
                                    break;
                                case '173':
                                    distrito = 'La Cuesta';
                                    break;
                                case '174':
                                    distrito = 'El Rosario';
                                    break;
                                default: 
                                    distrito = 'Externo - Codigo: '+datos[i][1];
                                    break;
                            }
                            $('#distrito').html(distrito);
                            break;
                        case '20':
                            $('#numeroPlano').html(datos[i][1]);
                            break;
                        case '21':
                            $('#areaPlano').html(datos[i][1]);
                            break;
                        case '22':
                            $('#numeroFinca').html(datos[i][1]);
                            break;
                        case '23':
                            $('#areaRegistroPublico').html(datos[i][1]);
                            break;
                        case '24':
                            $('#frente').html(datos[i][1]);
                            break;
                        case '25':
                            $('#numeroContrato').html(datos[i][1]);
                            break;
                        case '31':
                            document.getElementById('firmaCredenciales').src = datos[i][1];
                            break;
                    }         
                }
            }
        }
        RenderizarDatosJSON();
    </script>
</body>
</html>
