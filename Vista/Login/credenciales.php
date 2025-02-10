<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipalidad de Río Cuarto</title>
    <link rel="icon" type="image/x-icon" href="./Vista/assets/img/icon.png" />
    <style>
        body{
            background-color: #0f1a4f !important;
        }
        .btn-outline-warning{
            color: #272a2e;
            border-color: #f3aa17;
        }
        .btn-outline-warning:hover{
            background-color: #f3aa17;
            color: #f3aa17;
        }
        #canvas {
            border: .5px solid black;
            cursor: crosshair;
        }
        .rojo{
            color: red;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid d-flex justify-content-center all pt-md-5 mt-5">
        <div class="card p-5">
            <div class="text-center p-md-5 p-1">
                <h4 class="h3">Confirmar Cuenta</h4>
                <div class="mx-1">
                    <img src="./Vista/assets/img/icon.png" class="img-fluid" alt="">
                </div>
                <hr>
                <form action="index.php?controlador=Login&metodo=IngresarCredenciales" method="post" id="frmIngresar" enctype="multipart/form-data">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>">
                    <div class="row justify-content-center mb-3 mt-1">
                        <div class="col-md-12 mt-md-3 text-center">
                            <span class="mb-3">Para validar su cuenta, debe firmar el consentimiento informado (Descargue <a href="./repo/serverside/ConsentimientoInformadoEditable.pdf" download="" style="text-decoration: none;">aquí</a> *)</span>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <div class="col-md-12 mt-md-3 text-center">
                            <span class="mb-3">Firma (*)</span><br>
                            <canvas id="canvas" class="w-100 mx-auto" style="max-width: 300px;" height="200"></canvas>

                            <br>
                            <input type="hidden" name="firma" id="firma">
                            <button id="clear" class="btn btn-outline-danger mt-1">Limpiar</button>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3 mt-1">
                        <div class="col-md-12 mt-md-3 text-center row">
                            <span class="mb-3">Acepta los <a href="#" data-bs-toggle="modal" data-bs-target="#terminosYCondiciones" style="text-decoration: none;">términos y condiciones</a> (*)</span><br>
                            <input type="checkbox" id="cbxTerminos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <button class="btn-outline-warning btn w-100" type="submit">
                                <span class="p-1 px-md-5 p-1">Ingresar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="terminosYCondiciones" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Términos y Condiciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>I.-Información general: me encuentro informado(a) sobre los alcances de la Ley
                    de Protección de la Persona Frente al Tratamiento de sus Datos Personales y de
                    la Agencia de Protección de Datos conocida por sus siglas PRODHAB, publicado
                    en el Diario Oficial La Gaceta número 170 el día 5 de setiembre de 2011, de
                    conformidad con la ley anterior autorizo a Municipalidad de Río Cuarto, titular de
                    la cédula jurídica número 3-014-795871, en adelante conocida como LA
                    AUTORIZADA, para que lleve a cabo gestiones como emisión de cualquier acto
                    administrativo, gestiones de cobro, notificaciones, usos del suelo, permisos de
                    construcción, visados municipales, declaraciones, avalúos, peritajes, patentes y
                    demás licencias, permisos y trámites ligados a los servicios que brinda la
                    Municipalidad. Además, soy consciente de la existencia de una base de datos
                    perteneciente a LA AUTORIZADA, la cual se utiliza para realizar las gestiones
                    supra descritas.
                    II.-Utilización de datos personales: La información que contiene la base de datos
                    de LA AUTORIZADA, sobre mi persona de uso restringido podrán ser utilizados
                    para las gestiones descritas en el punto I.
                    III.-Consultas: Expresamente autorizo que mi información sea consultada por los
                    colaboradores de LA AUTORIZADA, Unidades Estratégicas y demás
                    dependencias.
                    IV.-Entrega de datos: La entrega de la información es de carácter facultativo,
                    voluntario y libre de cualquier tipo de coacción o amenaza.
                    V.-Información necesaria: La no entrega de la información solicitada por LA
                    AUTORIZADA, sus Unidades Estratégicas, oficinas o cualquier dependencia
                    podría ocasionar el rechazo de mi solicitud o afectación de la provisión de los
                    servicios municipales requeridos. Así mismo, he sido informado(a) que para laprestación de los servicios o eventualmente una gestión de cobro judicial es
                    necesario realizar la tercerización de labores con proveedores o abogados
                    externos contratados por LA AUTORIZADA, por lo que autorizo que mi
                    información sea compartida con dichos agentes.
                    VI.-Encargado de la base de datos. El encargado oficial del manejo responsable
                    de la base de datos será únicamente la Municipalidad de Río Cuarto, excluyendo
                    auditoría externa, agencias y convenios, los mismos dan fe de que mi información
                    será tratada confidencialmente para uso interno ya que LA AUTORIZADA
                    asignará usuarios y claves de acceso para sus colaboradores.
                    VII.-Actualización de datos. De conformidad con la Ley de Protección de Datos
                    Frente al Tratamiento de sus Datos Personales es mi derecho rectificar, adicionar,
                    modificar, actualizar o eliminar mis datos personales presentándome en
                    cualquiera de las oficinas de LA AUTORIZADA.
                    VIII.-Envío de notificaciones. Consiento a LA AUTORIZADA para enviar
                    notificaciones o comunicaciones ya sea por medio de llamadas telefónicas,
                    correo electrónico, mensaje de texto o cualquier medio electrónico disponible.
                    IX.-Consulta. LA AUTORIZADA podrá realizar cualquier tipo de consulta de mi
                    información en cualquier tipo de base de datos ya sea pública o privada y podrán
                    acceder, copiar, transmitir, recopilar o almacenar información relativa a mis datos
                    personales, incluyendo, pero no limitando la información de uso restringido de
                    acuerdo a lo que autorizo en este documento.
                    Por todo lo anterior voluntariamente y en pleno uso de mis facultades mentales
                    autorizo a la Municipalidad de Río Cuarto, para que acceda y consulte mi
                    información personal brindada por mi persona a LA AUTORIZADA, Unidades
                    Estratégicas, Oficinas y realice las notificaciones o comunicaciones que considere
                    pertinentes.
                </p>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="./Vista/assets/js/firmas.js"></script>
    <script>
       $('#frmIngresar').on('submit', function (){
            let dataURL = canvas.toDataURL("image/png");
            $("#firma").val(dataURL);

            if ($('#fotoUrl').val() == ''){
                return false;
            }
            if (!$('#cbxTerminos').prop('checked')){
                return false;
            }
            return true;
       })
    </script>
</body>
</html>