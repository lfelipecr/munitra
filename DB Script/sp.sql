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
    IN correo VARCHAR(20),
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
CREATE PROCEDURE SpActualizarPersona(
    IN id INT, 
    IN id_tipo_identificacion INT, 
    IN identificacion VARCHAR(50),
    IN nombre VARCHAR(100), 
    IN primer_apellido VARCHAR(100),
    IN segundo_apellido VARCHAR(100),
    IN direccion VARCHAR(200),
    IN telefono VARCHAR(15),
    IN whatsapp VARCHAR(15),
    IN estado VARCHAR(100),
    IN correo VARCHAR(20),
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
        FECHA_CONSENTIMIENTO = fecha_consentimiento, 
        PROPIEDAD_FUERA = propiedad_fuera, 
        FECHA_ACTUALIZACION = NOW(), 
        ID_DISTRITO = id_distrito, 
        ID_CANTON = id_canton, 
        ID_PROVINCIA = id_provincia,
        USUARIO_CREACION = usuario_actualizacion
    WHERE ID = id AND BORRADO = false;
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
    IN pass VARCHAR(200),
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
        PASS = pass,
        RESPONSABLE = responsable,
        ID_PERSONA = id_persona,
        ID_DEPARTAMENTO = id_departamento,
        ID_ESTADO = id_estado,
        FECHA_ACTUALIZACION = NOW()
    WHERE ID = id_usuario AND BORRADO = 0;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodosUsuarios()
BEGIN
    SELECT 
        u.ID AS ID_USUARIO,
        u.NOMBRE_USUARIO,
        u.CORREO,
        u.PASS,
        u.RESPONSABLE,
        u.BORRADO,
        p.ID AS ID_PERSONA,
        p.NOMBRE AS NOMBRE_PERSONA,
        p.PRIMER_APELLIDO,
        p.SEGUNDO_APELLIDO,
        p.DIRECCION,
        p.TELEFONO,
        p.WHATSAPP,
        p.ESTADO AS ESTADO_PERSONA,
        p.MONTO_MOROSIDAD,
        p.MONTO_ADEUDADO,
        p.CONSENTIMIENTO,
        p.FECHA_CONSENTIMIENTO,
        p.FECHA_CREACION AS FECHA_CREACION_PERSONA,
        p.FECHA_ACTUALIZACION AS FECHA_ACTUALIZACION_PERSONA,
        d.ID AS ID_DEPARTAMENTO,
        d.DESCRIPCION AS DESCRIPCION_DEPARTAMENTO,
        e.ID AS ID_ESTADO_USUARIO,
        e.DESCRIPCION AS ESTADO_USUARIO
    FROM USUARIO u
    INNER JOIN PERSONA p ON u.ID_PERSONA = p.ID
    INNER JOIN DEPARTAMENTO d ON u.ID_DEPARTAMENTO = d.ID
    INNER JOIN ESTADO_USUARIO e ON u.ID_ESTADO = e.ID
    WHERE u.BORRADO = 0;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarCredenciales(IN correo VARCHAR(100), IN pass VARCHAR(200))
BEGIN
    SELECT * FROM USUARIO WHERE CORREO = correo AND PASS = pass;
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
    IN id_persona INT,
    IN id_usuario INT,
    IN estado_solicitud INT,
    IN tipo_solicitud INT
)
BEGIN
    INSERT INTO SOLICITUD (FECHA, ID_PERSONA, ID_USUARIO, ESTADO_SOLICITUD, TIPO_SOLICITUD)
    VALUES (NOW(), id_persona, id_usuario, estado_solicitud, tipo_solicitud);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpActualizarSolicitud(
    IN id_solicitud INT,
    IN fecha DATETIME,
    IN id_persona INT,
    IN id_usuario INT,
    IN estado_solicitud INT,
    IN tipo_solicitud INT
)
BEGIN
    UPDATE SOLICITUD
    SET FECHA = fecha,
        ID_PERSONA = id_persona,
        ID_USUARIO = id_usuario,
        ESTADO_SOLICITUD = estado_solicitud,
        TIPO_SOLICITUD = tipo_solicitud
    WHERE ID = id_solicitud;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpEliminarSolicitud(
    IN id_solicitud INT
)
BEGIN
    DELETE FROM SOLICITUD WHERE ID = id_solicitud;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE SpConsultarTodasSolicitudes()
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
        TS.DESCRIPCION AS TIPO_SOLICITUD_DESCRIPCION
    FROM SOLICITUD S
    INNER JOIN PERSONA P ON S.ID_PERSONA = P.ID
    INNER JOIN USUARIO U ON S.ID_USUARIO = U.ID
    INNER JOIN ESTADO_SOLICITUD ES ON S.ESTADO_SOLICITUD = ES.ID
    INNER JOIN TIPO_SOLICITUD TS ON S.TIPO_SOLICITUD = TS.ID;
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
    IN ID_SOLICITUD INT
)
BEGIN
    SELECT 
        ds.ID AS DETALLE_ID, 
        ds.CAMPO_REQUISITO, 
        ds.ADJUNTO_REQUISITO, 
        ds.CUMPLE, 
        ts.ID AS TIPO_REQUISITO_ID,
        ts.DESCRIPCION AS TIPO_REQUISITO_DESCRIPCION,
        ts.FORMATO_CAMPO,
        ts.TIPO_CONTROL
    FROM DETALLE_SOLICITUD ds
    INNER JOIN TIPO_REQUISITO ts ON ds.TIPO_REQUISITO = ts.ID
    WHERE ds.ID_SOLICITUD = ID_SOLICITUD;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE SpActualizarDetalleSolicitud (
    IN ID INT,
    IN CAMPO_REQUISITO VARCHAR(200),
    IN ADJUNTO_REQUISITO VARCHAR(200),
    IN CUMPLE BIT,
    IN ID_SOLICITUD INT,
    IN TIPO_REQUISITO INT
)
BEGIN
    UPDATE DETALLE_SOLICITUD
    SET CAMPO_REQUISITO = CAMPO_REQUISITO,
        ADJUNTO_REQUISITO = ADJUNTO_REQUISITO,
        CUMPLE = CUMPLE,
        ID_SOLICITUD = ID_SOLICITUD,
        TIPO_REQUISITO = TIPO_REQUISITO
    WHERE ID = ID;
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
