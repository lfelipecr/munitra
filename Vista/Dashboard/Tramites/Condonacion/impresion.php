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
        .checkbox {
            width: 16px;
            margin-right: .5em;
            height: 16px;
            border: 2px solid black;
            display: inline-block;
            cursor: pointer;
            position: relative;
        }

        .checkbox.checked::after {
            content: "";
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
        <img src="./Web/assets/img/headerpdf.png" alt="Imagen del pie de página">
    </header>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12 text-center">
                <h6>FORMULARIO ÚNICO CONDONACIÓN LEY N°. 10026</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th colspan="3">DATOS DE LA  PERSONA CONTRIBUYENTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Nombre: <span id="nombre"></span></td>
                            <td>Cédula N°: <span id="numeroCedula"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Representante Legal: <span id="representante"></span></td>
                            <td>Cédula N°: <span id="numeroCedulaRepre"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Dirección: <span id="direccion"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Notificaciones: <span id="pagoContado" style="padding-right: 5em;padding-left: 3.5em;"><div class="checkbox"></div>Pago  de Contado</span> <span><div class="checkbox"></div>Arreglo de Pago</span> </td>
                        </tr>
                        <tr>
                            <td colspan="2">Firma: <span id="firma"></span></td>
                            <td>Fecha: <span id="fecha"></span></td>
                        </tr>
                        <tr>
                            <td style="height: 8em;" colspan="2">Recibido por: <span id="recibido"></span></td>
                            <td style="height: 8em;" class="d-flex justify-content-center align-items-center">Sello</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3">PARA  USO INTERNO DE LA ADMINISTRACIÓN TRIBUTARIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="1" width="70%">Fecha: <span id="fecha"></span> <hr> Funcionario(a): <span id="funcionario"></span></td>
                            <td width="30%"><br> Consecutivo: <span id="consecutivo"></span></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><h6>MODALIDAD: PAGO DE CONTADO</h6></td>
                        </tr>
                        <tr>
                            <td>Total: ₡ <span id="total"></span></td>
                            <td>Monto a condonar: ₡ <span id="montoCondonar"></span></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><h6>MODALIDAD: ARREGLO DE PAGO</h6></td>
                        </tr>
                        <tr>
                            <td>Total: ₡ <span id="totalAP"></span></td>
                            <td>Monto a condonar: ₡ <span id="montoCondonarAP"></span></td>
                        </tr>
                        <tr>
                            <td width="70%">Plazo: <span id="plazo"></span> meses. Del <span id="fechaDesde"></span> hasta <span id="fechaHasta"></span></td>
                            <td width="30%">Cantidad de Cuotas <span id="cantidadCuotas"></span></td>
                        </tr>
                        <tr>
                            <td width="50%">Adelanto 20%: <span id="adelanto20"></span></td>
                            <td width="50%">Pago por cuota: ₡<span id="pagoCuota"></span></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><h6>RESOLUCIÓN</h6></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><div class="checkbox mx-2"></div><span>Aprobación</span><div class="checkbox mx-2"></div><span>Denegatoria</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="checkbox"></div><span>Prevención.</span> Plazo: <span id="plazo"></span> Fecha de Notificación <span id="fechaNotificacion"></span><span style="margin-left: 35em;">Cumple:</span><div class="checkbox mx-2"></div><span>Sí</span><div class="checkbox mx-1"></div><span>No</span></td>
                        </tr>
                        <tr>
                            <td style="height: 8em;" colspan="">Firma: <span id="firmaMuni"></span></td>
                            <td style="height: 8em;" class="d-flex justify-content-center align-items-center">Sello</td>
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
                for (let i = 0; i < datos.length; i++)
                {
                    switch  (datos[i][4]){
                    case '32':
                        $('#txtRepresentante').html(datos[i][1]);
                        break;
                    case '33':
                        $('#txtIdentificacionRepresentante').html(datos[i][1]);
                        break;
                    case '34':
                        $('#txtDireccion').html(datos[i][1]);
                        break;
                    case '35':
                        $('#txtNotificaciones').html(datos[i][1]);
                        break;
                    case '36':
                        $('#tipoSolicitud').html(datos[i][1]);
                        break;
                    case '37':
                        $('#idFirma').html(datos[i][0]);
                        break;
                    case '38':
                        $('#txtRecibido').html(datos[i][1]);
                        break;
                    case '39':
                        $('#fecha').html(datos[i][1]);
                        break;
                    case '40':
                        id = datos[i][1].replaceAll(' ','_');
                        $('#idFuncionario').html(datos[i][0]);
                        $('#'+id).attr('selected', '');
                        break;
                    case '41':
                        $('#consecutivo').html(datos[i][1]);
                        break;
                    case '42':
                        $('#totalContado').html(datos[i][1]);
                        break;
                    case '43':
                        $('#montoCondonarContado').html(datos[i][1]);
                        break;
                    case '44':
                        $('#fechaPago').html(datos[i][1]);
                        break;
                    case '45':
                        $('#totalArreglo').html(datos[i][1]);
                        break;
                    case '46':
                        $('#montoCondonarArreglo').html(datos[i][1]);
                        break;
                    case '47':
                        $('#fechaInicio').html(datos[i][1]);
                        break;
                    case '48':
                        $('#plazoMeses').html(datos[i][1]);
                        break;
                    case '49':
                        $('#cantidadCuotas').html(datos[i][1]);
                        break;
                    case '50':
                        $('#adelanto').html(datos[i][1]);
                        break;
                    case '51':
                        $('#pagoPorCuota').html(datos[i][1]);
                        break;
                    case '52':
                        $('#resolucion').html(datos[i][1]);
                        break;
                    case '53':
                        $('#plazo').html(datos[i][1]);
                        break;
                    case '54':
                        $('#fechaNotificacion').html(datos[i][1]);
                        break;
                    case '55':
                        $('#valorCumple').html(datos[i][1]);
                        break;
                }
                }
            }
        }
        RenderizarDatosJSON();
    </script>
</body>
</html>