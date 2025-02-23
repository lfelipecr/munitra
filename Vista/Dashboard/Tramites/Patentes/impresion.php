<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patentes RS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        #contenidoPDF {
            width: 794px;
            height: 1123px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
    </style>
</head>
<body id="contenidoPDF">
    <header>
        <img src="./Web/assets/img/headerpdf.png" class="img-fluid" alt="Imagen del pie de página">
    </header>
    <input type="hidden" id="jsonData" value='<?php echo $jsonData; ?>'>
    <div class="container-fluid">
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
                            <th colspan="3">PARA USO MUNICIPAL</th>
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
    <div class="col-12">
        <button onclick="mostrarPDFEnPagina()"></button>
        <iframe id="visorPDF" width="100%" height="500px"></iframe>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    
    <script>
        function RenderizarDatosJSON(){
            let datos = $('#jsonData').val();
            if (datos != ''){
                datos = JSON.parse(datos);
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
        async function mostrarPDFEnPagina() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: "portrait",
                unit: "px",
                format: [794, 1123] 
            });
            const elemento = document.getElementById("contenidoPDF");
            const canvas = await html2canvas(elemento, { 
                scale: 2, 
                backgroundColor: null,
                logging: false,
                useCORS: true
            });
            const imgData = canvas.toDataURL("image/png");
            const imgWidth = 794;  
            const imgHeight = (canvas.height * imgWidth) / canvas.width; 
            doc.addImage(imgData, "PNG", 0, 0, imgWidth, imgHeight);
            const pdfBlob = doc.output("blob");
            const pdfUrl = URL.createObjectURL(pdfBlob);
            document.getElementById("visorPDF").src = pdfUrl;
        }
        
        function mostrarPDFEnPagina1() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: "portrait",
                unit: "mm",
                format: "a4"
            });

            doc.html(document.body, {
                callback: function (doc) {
                    const pdfBlob = doc.output("blob");
                    const pdfUrl = URL.createObjectURL(pdfBlob);
                    document.getElementById("visorPDF").src = pdfUrl;
                },
                x: 10,
                y: 10,
                width: 180,
                windowWidth: 800
            });
        }
        RenderizarDatosJSON();
    </script>
</body>
</html>