/*Departamento*/
DELIMITER //
CREATE PROCEDURE SpIngresarDepartamento(IN descripcion VARCHAR(200))
BEGIN
    INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO)
    VALUES (descripcion, false);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarDepartamentos()
BEGIN
    SELECT * FROM DEPARTAMENTO WHERE BORRADO = false;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarDepartamento(IN departamento_id INT, IN descripcion VARCHAR(200))
BEGIN
    UPDATE DEPARTAMENTO
    SET DESCRIPCION = descripcion
    WHERE ID = departamento_id AND BORRADO = false;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarDepartamento(IN departamento_id INT)
BEGIN
    UPDATE DEPARTAMENTO
    SET BORRADO = true
    WHERE ID = departamento_id AND BORRADO = false;
END //
DELIMITER ;

/*Persona*/
DELIMITER //
CREATE PROCEDURE SpIngresarPersona(
    IN id_tipo_identificacion INT, 
    IN identificacion VARCHAR(50),
    IN nombre VARCHAR(100), 
    IN primer_apellido VARCHAR(100),
    IN segundo_apellido VARCHAR(100),
    IN direccion VARCHAR(200),
    IN telefono VARCHAR(15),
    IN whatsapp VARCHAR(15),
    IN estado VARCHAR(100),
    IN correo VARCHAR(100),
    IN situacion VARCHAR(200),
    IN monto_morosidad FLOAT,
    IN monto_adeudado FLOAT,
    IN consentimiento BIT,
    IN fecha_consentimiento DATETIME,
    IN propiedad_fuera INT,
    IN id_distrito INT,
    IN id_canton INT,
    IN id_provincia INT,
    IN usuario_creacion INT)
BEGIN
    INSERT INTO PERSONA (
        ID_TIPO_IDENTIFICACION, IDENTIFICACION, NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, DIRECCION, 
        TELEFONO, WHATSAPP, ESTADO, CORREO, SITUACION, MONTO_MOROSIDAD, MONTO_ADEUDADO, CONSENTIMIENTO, 
        FECHA_CONSENTIMIENTO, PROPIEDAD_FUERA, FECHA_CREACION, FECHA_ACTUALIZACION, ID_DISTRITO, 
        ID_CANTON, ID_PROVINCIA, USUARIO_CREACION, BORRADO
    )
    VALUES (
        id_tipo_identificacion, identificacion, nombre, primer_apellido, segundo_apellido, direccion, 
        telefono, whatsapp, estado, correo, situacion, monto_morosidad, monto_adeudado, 
        consentimiento, fecha_consentimiento, propiedad_fuera, NOW(), NULL, id_distrito, 
        id_canton, id_provincia, usuario_creacion, false
    );
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarPersonas()
BEGIN
    SELECT * FROM PERSONA WHERE BORRADO = false;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarPersona(IN p_id INT)
BEGIN
    SELECT * FROM PERSONA WHERE ID = p_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarPersona(
    IN id_persona INT, 
    IN id_tipo_identificacion INT, 
    IN identificacion VARCHAR(50),
    IN nombre VARCHAR(100), 
    IN primer_apellido VARCHAR(100),
    IN segundo_apellido VARCHAR(100),
    IN direccion VARCHAR(200),
    IN telefono VARCHAR(15),
    IN whatsapp VARCHAR(15),
    IN estado VARCHAR(100),
    IN correo VARCHAR(100),
    IN situacion VARCHAR(200),
    IN monto_morosidad FLOAT,
    IN monto_adeudado FLOAT,
    IN consentimiento BIT,
    IN fecha_consentimiento DATETIME,
    IN propiedad_fuera INT,
    IN id_distrito INT,
    IN id_canton INT,
    IN id_provincia INT,
    IN usuario_actualizacion INT)
BEGIN
    UPDATE PERSONA
    SET 
        ID_TIPO_IDENTIFICACION = id_tipo_identificacion, 
        IDENTIFICACION = identificacion, 
        NOMBRE = nombre, 
        PRIMER_APELLIDO = primer_apellido,
        SEGUNDO_APELLIDO = segundo_apellido, 
        DIRECCION = direccion, 
        TELEFONO = telefono, 
        WHATSAPP = whatsapp, 
        ESTADO = estado, 
        CORREO = correo, 
        SITUACION = situacion, 
        MONTO_MOROSIDAD = monto_morosidad, 
        MONTO_ADEUDADO = monto_adeudado, 
        CONSENTIMIENTO = consentimiento, 
        PROPIEDAD_FUERA = propiedad_fuera, 
        FECHA_ACTUALIZACION = NOW(), 
        ID_DISTRITO = id_distrito, 
        ID_CANTON = id_canton, 
        ID_PROVINCIA = id_provincia,
        USUARIO_CREACION = usuario_actualizacion
    WHERE ID = id_persona;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarPersona(IN p_id INT)
BEGIN
    UPDATE PERSONA
    SET BORRADO = true
    WHERE ID = p_id AND BORRADO = false;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpUltimoIDPersona (OUT ultimo_id INT)
BEGIN
    -- Obtener el ID del último registro ingresado en la tabla PERSONA
    SELECT MAX(ID) INTO ultimo_id
    FROM PERSONA;
END //
DELIMITER ;

/*Usuario*/
DELIMITER //
CREATE PROCEDURE SpInsertarUsuario(
    IN nombre_usuario VARCHAR(100),
    IN correo VARCHAR(100),
    IN pass VARCHAR(200),
    IN responsable BIT,
    IN id_persona INT,
    IN id_departamento INT,
    IN id_estado INT
)
BEGIN
    INSERT INTO USUARIO (NOMBRE_USUARIO, CORREO, PASS, RESPONSABLE, ID_PERSONA, ID_DEPARTAMENTO, ID_ESTADO, BORRADO)
    VALUES (nombre_usuario, correo, pass, responsable, id_persona, id_departamento, id_estado, 0);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarUsuario(
    IN id_usuario INT,
    IN nombre_usuario VARCHAR(100),
    IN correo VARCHAR(100),
    IN responsable BIT,
    IN id_persona INT,
    IN id_departamento INT,
    IN id_estado INT
)
BEGIN
    UPDATE USUARIO
    SET 
        NOMBRE_USUARIO = nombre_usuario,
        CORREO = correo,
        RESPONSABLE = responsable,
        ID_PERSONA = id_persona,
        ID_DEPARTAMENTO = id_departamento,
        ID_ESTADO = id_estado
    WHERE ID = id_usuario AND BORRADO = 0;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosUsuarios()
BEGIN
    SELECT p.*, u.ID AS UsuarioID, u.NOMBRE_USUARIO, u.CORREO, u.RESPONSABLE, u.PASS, u.ID_DEPARTAMENTO, u.ID_ESTADO FROM PERSONA p LEFT JOIN USUARIO u ON p.ID = u.ID_PERSONA; 
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarCredenciales(IN p_correo VARCHAR(100))
BEGIN
    SELECT * FROM USUARIO WHERE CORREO = p_correo;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarUsuario(IN p_id INT)
BEGIN
    SELECT * FROM USUARIO WHERE ID = p_id;
END //
DELIMITER ;

/*Tipo Solicitud*/
DELIMITER //
CREATE PROCEDURE SpIngresarTipoSolicitud(
    IN descripcion VARCHAR(30),
    IN id_departamento INT
)
BEGIN
    INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO)
    VALUES (descripcion, id_departamento, false);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarTipoSolicitud(
    IN id_tipo_solicitud INT,
    IN descripcion VARCHAR(30),
    IN id_departamento INT
)
BEGIN
    UPDATE TIPO_SOLICITUD
    SET DESCRIPCION = descripcion,
        ID_DEPARTAMENTO = id_departamento
    WHERE ID = id_tipo_solicitud AND BORRADO = 0;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarTipoSolicitud(
    IN id_tipo_solicitud INT
)
BEGIN
    UPDATE TIPO_SOLICITUD
    SET BORRADO = 1
    WHERE ID = id_tipo_solicitud;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosTiposSolicitudes()
BEGIN
    SELECT 
        t.ID AS ID_TIPO_SOLICITUD,
        t.DESCRIPCION AS DESCRIPCION_TIPO_SOLICITUD,
        t.BORRADO,
        d.ID AS ID_DEPARTAMENTO,
        d.DESCRIPCION AS DESCRIPCION_DEPARTAMENTO
    FROM TIPO_SOLICITUD t
    INNER JOIN DEPARTAMENTO d ON t.ID_DEPARTAMENTO = d.ID
    WHERE t.BORRADO = 0;
END //
DELIMITER ;

/*Tipo Campo*/
DELIMITER //
CREATE PROCEDURE SpIngresarTipoCampo(
    IN descripcion VARCHAR(30),
    IN formato_campo VARCHAR(50),
    IN tipo_control VARCHAR(50)
)
BEGIN
    INSERT INTO TIPO_CAMPO (DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
    VALUES (descripcion, formato_campo, tipo_control);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarTipoCampo(
    IN id_tipo_campo INT,
    IN descripcion VARCHAR(30),
    IN formato_campo VARCHAR(50),
    IN tipo_control VARCHAR(50)
)
BEGIN
    UPDATE TIPO_CAMPO
    SET DESCRIPCION = descripcion,
        FORMATO_CAMPO = formato_campo,
        TIPO_CONTROL = tipo_control
    WHERE ID = id_tipo_campo;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarTipoCampo(
    IN id_tipo_campo INT
)
BEGIN
    DELETE FROM TIPO_CAMPO WHERE ID = id_tipo_campo;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosTiposCampos()
BEGIN
    SELECT ID, DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL
    FROM TIPO_CAMPO;
END //
DELIMITER ;

/*Tipo de Requisito*/
DELIMITER //
CREATE PROCEDURE SpIngresarTipoRequisito(
    IN descripcion VARCHAR(30),
    IN id_tipo_campo INT
)
BEGIN
    INSERT INTO TIPO_REQUISITO (DESCRIPCION, ID_TIPO_CAMPO)
    VALUES (descripcion, id_tipo_campo);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarTipoRequisito(
    IN id_tipo_requisito INT,
    IN descripcion VARCHAR(30),
    IN id_tipo_campo INT
)
BEGIN
    UPDATE TIPO_REQUISITO
    SET DESCRIPCION = descripcion,
        ID_TIPO_CAMPO = id_tipo_campo
    WHERE ID = id_tipo_requisito;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarTipoRequisito(
    IN id_tipo_requisito INT
)
BEGIN
    DELETE FROM TIPO_REQUISITO WHERE ID = id_tipo_requisito;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosTiposRequisitos()
BEGIN
    SELECT ID, DESCRIPCION, ID_TIPO_CAMPO
    FROM TIPO_REQUISITO;
END //
DELIMITER ;

/*Requisito Tipo Solicitud*/
DELIMITER //
CREATE PROCEDURE SpIngresarRequisitoTipoSolicitud(
    IN descripcion VARCHAR(30),
    IN requerido BIT,
    IN adjunto BIT,
    IN tipo_solicitud INT,
    IN tipo_requisito INT
)
BEGIN
    INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
    VALUES (descripcion, requerido, adjunto, tipo_solicitud, tipo_requisito, false);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarRequisitoTipoSolicitud(
    IN id_requisito_tipo_solicitud INT,
    IN descripcion VARCHAR(30),
    IN requerido BIT,
    IN adjunto BIT,
    IN tipo_solicitud INT,
    IN tipo_requisito INT
)
BEGIN
    UPDATE REQUISITO_TIPO_SOLICITUD
    SET DESCRIPCION = descripcion,
        REQUERIDO = requerido,
        ADJUNTO = adjunto,
        TIPO_SOLICITUD = tipo_solicitud,
        TIPO_REQUISITO = tipo_requisito
    WHERE ID = id_requisito_tipo_solicitud;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarRequisitoTipoSolicitud(
    IN id_requisito_tipo_solicitud INT
)
BEGIN
    DELETE FROM REQUISITO_TIPO_SOLICITUD WHERE ID = id_requisito_tipo_solicitud;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosRequisitosTipoSolicitud()
BEGIN
    SELECT ID, DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO
    FROM REQUISITO_TIPO_SOLICITUD;
END //
DELIMITER ;

/*Solicitud*/
DELIMITER //

CREATE PROCEDURE SpIngresarSolicitud(
    IN idPersona INT, 
    IN idUsuario INT,
    IN estadoSolicitud INT,
    IN tipoSolicitud INT
)
BEGIN
    INSERT INTO SOLICITUD (FECHA, ID_PERSONA, ID_USUARIO, ESTADO_SOLICITUD, TIPO_SOLICITUD)
    VALUES (NOW(), idPersona, idUsuario, estadoSolicitud, tipoSolicitud);
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarSolicitud(IN s_id INT, IN estado INT)
BEGIN
    UPDATE SOLICITUD
    SET ESTADO_SOLICITUD = estado,
    FECHA = NOW()
    WHERE ID = s_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarSolicitud(
    IN s_id INT
)
BEGIN
    DELETE FROM SOLICITUD WHERE ID = s_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodasSolicitudes(IN idTipo INT)
BEGIN
    SELECT 
        S.ID, 
        S.FECHA, 
        S.ESTADO_SOLICITUD, 
        S.TIPO_SOLICITUD,
        P.NOMBRE AS PERSONA_NOMBRE, 
        P.PRIMER_APELLIDO AS PERSONA_APELLIDO, 
        U.NOMBRE_USUARIO AS USUARIO_NOMBRE, 
        ES.DESCRIPCION AS ESTADO_SOLICITUD_DESCRIPCION, 
        TS.DESCRIPCION AS TIPO_SOLICITUD_DESCRIPCION,
        P.ID AS PERSONA_ID
    FROM SOLICITUD S
    INNER JOIN PERSONA P ON S.ID_PERSONA = P.ID
    INNER JOIN USUARIO U ON S.ID_USUARIO = U.ID
    INNER JOIN ESTADO_SOLICITUD ES ON S.ESTADO_SOLICITUD = ES.ID
    INNER JOIN TIPO_SOLICITUD TS ON S.TIPO_SOLICITUD = TS.ID
    WHERE S.TIPO_SOLICITUD = idTipo;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodasSolicitudesUsuario(IN idTipo INT, IN idPersona INT)
BEGIN
    SELECT 
        S.ID, 
        S.FECHA, 
        S.ESTADO_SOLICITUD, 
        S.TIPO_SOLICITUD,
        P.NOMBRE AS PERSONA_NOMBRE, 
        P.PRIMER_APELLIDO AS PERSONA_APELLIDO, 
        U.NOMBRE_USUARIO AS USUARIO_NOMBRE, 
        ES.DESCRIPCION AS ESTADO_SOLICITUD_DESCRIPCION, 
        TS.DESCRIPCION AS TIPO_SOLICITUD_DESCRIPCION,
        P.ID AS PERSONA_ID
    FROM SOLICITUD S
    INNER JOIN PERSONA P ON S.ID_PERSONA = P.ID
    INNER JOIN USUARIO U ON S.ID_USUARIO = U.ID
    INNER JOIN ESTADO_SOLICITUD ES ON S.ESTADO_SOLICITUD = ES.ID
    INNER JOIN TIPO_SOLICITUD TS ON S.TIPO_SOLICITUD = TS.ID
    WHERE S.TIPO_SOLICITUD = idTipo AND S.ID_PERSONA = idPersona;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE SpConsultarSolicitudPorID(
    IN id_solicitud INT
)
BEGIN
    SELECT 
        S.ID, 
        S.FECHA, 
        S.ESTADO_SOLICITUD, 
        S.TIPO_SOLICITUD,
        P.ID AS PERSONA_ID,
        P.NOMBRE AS PERSONA_NOMBRE, 
        P.PRIMER_APELLIDO AS PERSONA_APELLIDO, 
        U.NOMBRE_USUARIO AS USUARIO_NOMBRE, 
        ES.DESCRIPCION AS ESTADO_SOLICITUD_DESCRIPCION, 
        TS.DESCRIPCION AS TIPO_SOLICITUD_DESCRIPCION
    FROM SOLICITUD S
    INNER JOIN PERSONA P ON S.ID_PERSONA = P.ID
    INNER JOIN USUARIO U ON S.ID_USUARIO = U.ID
    INNER JOIN ESTADO_SOLICITUD ES ON S.ESTADO_SOLICITUD = ES.ID
    INNER JOIN TIPO_SOLICITUD TS ON S.TIPO_SOLICITUD = TS.ID
    WHERE S.ID = id_solicitud;
END //
DELIMITER ;

/*Detalles de Solicitud*/
DELIMITER //
CREATE PROCEDURE SpIngresarDetalleSolicitud (
    IN CAMPO_REQUISITO VARCHAR(200),
    IN ADJUNTO_REQUISITO VARCHAR(200),
    IN CUMPLE BIT,
    IN ID_SOLICITUD INT,
    IN TIPO_REQUISITO INT
)
BEGIN
    INSERT INTO DETALLE_SOLICITUD (CAMPO_REQUISITO, ADJUNTO_REQUISITO, CUMPLE, ID_SOLICITUD, TIPO_REQUISITO)
    VALUES (CAMPO_REQUISITO, ADJUNTO_REQUISITO, CUMPLE, ID_SOLICITUD, TIPO_REQUISITO);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpBuscarDetallesPorSolicitud (
    IN idSolicitud INT
)
BEGIN
    SELECT ds.ID AS DetalleSolicitudID, ds.CAMPO_REQUISITO AS CampoRequisito, ds.ADJUNTO_REQUISITO AS AdjuntoRequisito, ds.CUMPLE AS Cumple, tr.ID AS TipoRequisitoID, tr.DESCRIPCION AS TipoRequisitoDescripcion, tc.ID AS TipoCampoID, tc.DESCRIPCION AS TipoCampoDescripcion, tc.FORMATO_CAMPO AS FormatoCampo, tc.TIPO_CONTROL AS TipoControl, rts.ID AS RequisitoTipoSolicitudID, rts.DESCRIPCION AS RequisitoDescripcion, rts.REQUERIDO AS Requerido, rts.ADJUNTO AS Adjunto FROM DETALLE_SOLICITUD ds INNER JOIN TIPO_REQUISITO tr ON ds.TIPO_REQUISITO = tr.ID INNER JOIN TIPO_CAMPO tc ON tr.ID_TIPO_CAMPO = tc.ID INNER JOIN REQUISITO_TIPO_SOLICITUD rts ON tr.ID = rts.TIPO_REQUISITO WHERE ds.ID_SOLICITUD = idSolicitud; 
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE SpActualizarDetalleSolicitud (
    IN s_id INT,
    IN campoRequisito VARCHAR(200),
    IN s_cumple BIT
)
BEGIN
    UPDATE DETALLE_SOLICITUD
    SET CAMPO_REQUISITO = campoRequisito,
        CUMPLE = s_cumple
    WHERE ID = s_id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE SpEliminarDetalleSolicitud (
    IN ID INT
)
BEGIN
    DELETE FROM DETALLE_SOLICITUD WHERE ID = ID;
END //
DELIMITER ;

/*Noticia*/
DELIMITER //
CREATE PROCEDURE SpIngresarNoticia(
    IN idUsuario INT,
    IN n_titulo VARCHAR (100),
    IN n_descripcionLarga VARCHAR(1000),
    IN n_urlAdjunto VARCHAR (200),
    IN urlImagen VARCHAR(200)
)
BEGIN
    INSERT INTO NOTICIA (ID_USUARIO, TITULO, DESCRIPCION_LARGA, URL_IMAGEN, INHABILITADA, URL_ADJUNTO) 
    VALUES (idUsuario, n_titulo, n_descripcionLarga, urlImagen, 0, n_urlAdjunto);
END //
DELIMITER ;
--CALL SpIngresarNoticia(6, 'Noticia de Prueba', 'blablablablablablablabla', '');
DELIMITER //
CREATE PROCEDURE SpBuscarNoticias()
BEGIN
SELECT 
    NOTICIA.ID AS NOTICIA_ID,
    NOTICIA.TITULO AS NOTICIA_TITULO,
    NOTICIA.DESCRIPCION_LARGA AS NOTICIA_DESCRIPCION,
    NOTICIA.URL_IMAGEN AS NOTICIA_URL_IMAGEN,
    USUARIO.ID AS USUARIO_ID,
    USUARIO.NOMBRE_USUARIO AS USUARIO_NOMBRE,
    USUARIO.CORREO AS USUARIO_CORREO,
    PERSONA.ID AS PERSONA_ID,
    PERSONA.NOMBRE AS PERSONA_NOMBRE,
    PERSONA.PRIMER_APELLIDO AS PERSONA_PRIMER_APELLIDO,
    PERSONA.SEGUNDO_APELLIDO AS PERSONA_SEGUNDO_APELLIDO
FROM 
    NOTICIA
INNER JOIN 
    USUARIO ON NOTICIA.ID_USUARIO = USUARIO.ID
INNER JOIN 
    PERSONA ON USUARIO.ID_PERSONA = PERSONA.ID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpBuscarNoticia(IN n_id INT)
BEGIN
    SELECT * FROM NOTICIA WHERE ID = n_id
END //
DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpActualizarNoticia(
    IN idNoti INT,
    IN n_titulo VARCHAR(100),
    IN n_descripcionLarga VARCHAR(1000),
    IN urlImagen VARCHAR(200),
    IN urlAdjunto VARCHAR(200)
)
BEGIN
    IF urlImagen = '' AND urlAdjunto = '' THEN
        UPDATE NOTICIA
        SET TITULO = n_titulo,
            DESCRIPCION_LARGA = n_descripcionLarga
        WHERE ID = idNoti;
    ELSEIF urlImagen = '' THEN
        UPDATE NOTICIA
        SET TITULO = n_titulo,
            DESCRIPCION_LARGA = n_descripcionLarga,
            URL_ADJUNTO = urlAdjunto
        WHERE ID = idNoti;
    ELSEIF urlAdjunto = '' THEN
        UPDATE NOTICIA
        SET TITULO = n_titulo,
            DESCRIPCION_LARGA = n_descripcionLarga,
            URL_IMAGEN = urlImagen
        WHERE ID = idNoti;
    ELSE
        UPDATE NOTICIA
        SET TITULO = n_titulo,
            DESCRIPCION_LARGA = n_descripcionLarga,
            URL_IMAGEN = urlImagen,
            URL_ADJUNTO = urlAdjunto
        WHERE ID = idNoti;
    END IF;
    
END //

DELIMITER ;

/*Sesiones*/
DELIMITER //

CREATE PROCEDURE SpIngresarSesion(
    IN s_fecha DATETIME,
    IN s_descrip VARCHAR(100),
    IN s_aprobada BIT,
    IN urlActa VARCHAR(200),
    IN urlAgenda VARCHAR(200),
    IN urlVideo VARCHAR(200)
)
BEGIN
    INSERT INTO SESION (FECHA, DESCRIPCION, ACTA_APROBADA, URL_ACTA, URL_AGENDA, URL_VIDEO)
    VALUES (s_fecha, s_descrip, s_aprobada, urlActa, urlAgenda, urlVideo);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpActualizarSesion(
    IN s_id INT,
    IN s_fecha DATETIME,
    IN s_descrip VARCHAR(100),
    IN s_aprobada BIT,
    IN urlActa VARCHAR(200),
    IN urlAgenda VARCHAR(200),
    IN urlVideo VARCHAR(200)
)
BEGIN
    UPDATE SESION
    SET 
        FECHA = s_fecha,
        DESCRIPCION = s_descrip,
        ACTA_APROBADA = s_aprobada
    WHERE ID = s_id;

    IF urlActa <> '' THEN
        UPDATE SESION
        SET URL_ACTA = urlActa
        WHERE ID = s_id;
    END IF;

    IF urlAgenda <> '' THEN
        UPDATE SESION
        SET URL_AGENDA = urlAgenda
        WHERE ID = s_id;
    END IF;

    IF urlVideo <> '' THEN
        UPDATE SESION
        SET URL_VIDEO = urlVideo
        WHERE ID = s_id;
    END IF;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE SpBuscarSesiones()
BEGIN
    SELECT * FROM SESION;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpBuscarSesion(IN s_id INT)
BEGIN
    SELECT * FROM SESION WHERE ID = s_id;
END //

DELIMITER ;

/*Bitacoras de Solicitud*/
DELIMITER //

CREATE PROCEDURE SpIngresarBitacora(
    IN idSolicitud INT, 
    IN idUsuario INT, 
    IN idEstado INT,
    IN b_nota VARCHAR (200),
    IN b_detalle VARCHAR (1000)
)
BEGIN
    INSERT INTO BITACORA_SOLICITUD (ID_SOLICITUD, ID_USUARIO,
    ID_ESTADO, FECHA, NOTA, DETALLE)
    VALUES (idSolicitud, idUsuario, idEstado, NOW(), b_nota, b_detalle);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE UsuariosDepartamento()
BEGIN
    SELECT DISTINCT
        P.ID AS ID_PERSONA,
        P.NOMBRE,
        P.PRIMER_APELLIDO,
        P.SEGUNDO_APELLIDO,
        P.DIRECCION,
        P.TELEFONO,
        P.WHATSAPP,
        P.ESTADO,
        P.CORREO AS CORREO_PERSONA,
        P.SITUACION,
        P.MONTO_MOROSIDAD,
        P.MONTO_ADEUDADO,
        P.FECHA_CREACION AS FECHA_CREACION_PERSONA,
        U.ID AS ID_USUARIO,
        U.NOMBRE_USUARIO,
        U.CORREO AS CORREO_USUARIO,
        U.RESPONSABLE,
        U.ID_DEPARTAMENTO,
        D.DESCRIPCION AS DEPARTAMENTO,
        U.ID_ESTADO,
        U.BORRADO AS BORRADO_USUARIO,
        (SELECT URL_IMAGEN FROM IMAGEN_USUARIO I WHERE I.ID_USUARIO = P.ID LIMIT 1) AS URL_IMAGEN,
        C.ID AS ID_CONCEJO,
        C.TESTIMONIO
    FROM PERSONA P
    INNER JOIN USUARIO U ON P.ID = U.ID_PERSONA
    INNER JOIN DEPARTAMENTO D ON U.ID_DEPARTAMENTO = D.ID
    LEFT JOIN CONCEJO C ON U.ID = C.ID_USUARIO; 
END //

DELIMITER ;

/*Credenciales*/
DELIMITER //

CREATE PROCEDURE SpIngresarCredenciales(IN idUsuario INT,
IN codigoCred VARCHAR(20), IN urlImagen VARCHAR(1000), IN urlFirma VARCHAR(100), IN urlConsentimiento VARCHAR(1000))
BEGIN
    INSERT INTO CREDENCIALES (ID_USUARIO, CODIGO, URL_IMAGEN, FIRMA, URL_CONSENTIMIENTO)
    VALUES (idUsuario, codigoCred, urlImagen, urlFirma, urlConsentimiento);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpActualizarCredenciales(IN idCred INT,
IN codigoCred VARCHAR(20), IN urlImagen VARCHAR(1000), IN urlFirma VARCHAR(100), IN urlConsentimiento VARCHAR(1000))
BEGIN
    IF codigoCred = '' THEN
        UPDATE CREDENCIALES 
        SET CODIGO = codigoCred,
        URL_IMAGEN = urlImagen,
        URL_CONSENTIMIENTO = urlConsentimiento,
        FIRMA = urlFirma
        WHERE ID = idCred;    
    ELSE
        UPDATE CREDENCIALES SET CODIGO = codigoCred WHERE ID = idCred;
    END IF;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpBuscarCredenciales(IN idUsuario INT)
BEGIN
    SELECT 
    P.ID AS ID_PERSONA,
    P.NOMBRE,
    P.PRIMER_APELLIDO,
    P.SEGUNDO_APELLIDO,
    P.IDENTIFICACION,
    P.TELEFONO,
    P.WHATSAPP,
    P.ESTADO,
    P.CORREO AS CORREO_PERSONA,
    P.SITUACION,
    P.MONTO_MOROSIDAD,
    P.MONTO_ADEUDADO,
    P.FECHA_CREACION AS FECHA_CREACION_PERSONA,
    U.ID AS ID_USUARIO,
    U.NOMBRE_USUARIO,
    U.CORREO AS CORREO_USUARIO,
    U.RESPONSABLE,
    U.ID_DEPARTAMENTO,
    U.ID_ESTADO,
    U.BORRADO AS BORRADO_USUARIO,
    C.ID AS ID_CREDENCIAL,
    C.CODIGO,
    C.URL_IMAGEN AS URL_IMAGEN_CREDENCIAL,
    C.FIRMA,
    C.URL_CONSENTIMIENTO
    FROM PERSONA P
    INNER JOIN USUARIO U ON P.ID = U.ID_PERSONA
    INNER JOIN CREDENCIALES C ON U.ID = C.ID_USUARIO
    WHERE U.ID_PERSONA = idUsuario;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE SpValidarCodigo(IN codigoValidar VARCHAR(100))
BEGIN
    SELECT * FROM CREDENCIALES WHERE CODIGO = codigoValidar;
END //

DELIMITER ;