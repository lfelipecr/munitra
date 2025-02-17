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
            object-fit: contain !important;
        }
    </style>
</head>
<body>
    <header class="text-center">
        <img src="./Web/assets/img/headerpdf.png" class="img-fluid" alt="Imagen del pie de página">
    </header>
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12 text-center">
                <h6>SOLICITUD DE PATENTES</h6>
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
                            <td colspan="2">Tipo de Identificación: <span id="tipoId"></span></td>
                            <td>Cédula N°: <span id="numeroCedula"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Dirección: <span id="direccion"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Correo Electrónico: <span id="correo"></span></td>
                        </tr>
                        <tr>
                            <td>Nombre: <span id="nombre"></span></td>
                            <td>Primer Apellido: <span id="apellido1"></span></td>
                            <td>Segundo Apellido: <span id="apellido2"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Teléfono: <span id="telefono"></span></td>
                            <td>Whatsapp: <span id="whatsapp"></span></td>
                        </tr>
                        <tr>
                            <td>Provincia: <span id="provincia"></span></td>
                            <td>Cantón: <span id="canton"></span></td>
                            <td>Distrito: <span id="distrito"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3">PATENTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Uso de Patente: <span id="slUsoPatente"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Nombre de Fantasía: <span id="txtNombreFantasia"></span></td>
                            <td>Actividad Comercial: <span id="txtActvidadComercial"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Uso de Suelo: <span id="txtUsoSuelo"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Distrito: <span id="distrito"></span></td>
                            <td>Dirección exacta del local: <span id="txtDireccionExacta"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Área: <span id="txtArea"></span></td>
                            <td>Dimensiones: <span id="txtDimensiones"></span></td>
                        </tr>
                    </tbody>
                </table>
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
    <footer class="text-center">
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
                        case '2':
                            $('#slUsoPatente').html(datos[i][1]);
                            break;
                        case '3':
                            $('#txtNombreFantasia').html(datos[i][1]);
                            break;
                        case '4':
                            $('#txtActvidadComercial').html(datos[i][1]);
                            break;
                        case '5':
                            $('#txtUsoSuelo').html(datos[i][1]);
                            break;
                        case '6': 
                            $('#idDistrito').html(datos[i][0]);
                            $('#distrito'+datos[i][0]).attr('selected', '');
                            break;
                        case '7':
                            $('#txtDireccionExacta').html(datos[i][1]);
                            break;
                        case '8':
                            $('#txtArea').html(datos[i][1]);
                            break;
                        case '9':
                            $('#txtDimensiones').html(datos[i][1]);
                            break;
                    }
                }
            }
        }
        RenderizarDatosJSON();
    </script>
</body>
</html>
