CREATE DATABASE MUNITRA;
USE MUNITRA;

CREATE TABLE PROVINCIA (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR(10) NOT NULL
);
CREATE TABLE CANTON (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR (30) NOT NULL,
    ID_PROVINCIA INT NOT NULL,
    FOREIGN KEY (ID_PROVINCIA) REFERENCES PROVINCIA (ID)
);
CREATE TABLE DISTRITO (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR (30) NOT NULL,
    ID_PROVINCIA INT NOT NULL,
    ID_CANTON INT NOT NULL,
    FOREIGN KEY (ID_PROVINCIA) REFERENCES PROVINCIA (ID),
    FOREIGN KEY (ID_CANTON) REFERENCES CANTON (ID)
);
CREATE TABLE BARRIO (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR (30) NOT NULL,
    ID_PROVINCIA INT NOT NULL,
    ID_CANTON INT NOT NULL,
    ID_DISTRITO INT NOT NULL,
    FOREIGN KEY (ID_PROVINCIA) REFERENCES PROVINCIA (ID),
    FOREIGN KEY (ID_CANTON) REFERENCES CANTON (ID),
    FOREIGN KEY (ID_DISTRITO) REFERENCES DISTRITO (ID)
);
CREATE TABLE DEPARTAMENTO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR(200) NOT NULL UNIQUE,
    BORRADO BIT NOT NULL
);
CREATE TABLE TIPO_IDENTIFICACION (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL UNIQUE
);
CREATE TABLE PERSONA (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_TIPO_IDENTIFICACION INT NOT NULL,
    IDENTIFICACION VARCHAR(50) NOT NULL UNIQUE,
    NOMBRE VARCHAR (100) NOT NULL,
    PRIMER_APELLIDO VARCHAR(100) NOT NULL,
    SEGUNDO_APELLIDO VARCHAR(100),
    DIRECCION VARCHAR(200) NOT NULL UNIQUE,
    TELEFONO VARCHAR (15),
    WHATSAPP VARCHAR(15),
    ESTADO VARCHAR (100),
    CORREO VARCHAR(20) UNIQUE,
    SITUACION VARCHAR(200),
    MONTO_MOROSIDAD FLOAT,
    MONTO_ADEUDADO FLOAT,
    CONSENTIMIENTO BIT,
    FECHA_CONSENTIMIENTO DATETIME,
    PROPIEDAD_FUERA INT,
    FECHA_CREACION DATETIME NOT NULL,
    FECHA_ACTUALIZACION DATETIME,
    ID_DISTRITO INT NOT NULL,
    ID_CANTON INT NOT NULL,
    ID_PROVINCIA INT NOT NULL,
    USUARIO_CREACION INT,
    BORRADO BIT NOT NULL,
    FOREIGN KEY (ID_TIPO_IDENTIFICACION) REFERENCES TIPO_IDENTIFICACION(ID),
    FOREIGN KEY (ID_DISTRITO) REFERENCES DISTRITO (ID),
    FOREIGN KEY (ID_CANTON) REFERENCES CANTON (ID),
    FOREIGN KEY (ID_PROVINCIA) REFERENCES PROVINCIA (ID)
);
CREATE TABLE ESTADO_USUARIO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR(15)
);
CREATE TABLE USUARIO (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOMBRE_USUARIO VARCHAR (100) UNIQUE,
    CORREO VARCHAR(100) NOT NULL UNIQUE,
    PASS VARCHAR(200) NOT NULL,
    INFO_ADICIONAL VARCHAR(200),
    RESPONSABLE BIT NOT NULL,
    ID_PERSONA INT NOT NULL UNIQUE,
    ID_DEPARTAMENTO INT NOT NULL,
    ID_ESTADO INT NOT NULL,
    BORRADO BIT NOT NULL,
    FOREIGN KEY (ID_PERSONA) REFERENCES PERSONA(ID),
    FOREIGN KEY (ID_DEPARTAMENTO) REFERENCES DEPARTAMENTO (ID),
    FOREIGN KEY (ID_ESTADO) REFERENCES ESTADO_USUARIO (ID)
);
/*Solicitudes*/
CREATE TABLE TIPO_SOLICITUD (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL,
    ID_DEPARTAMENTO INT NOT NULL,
    BORRADO BIT NOT NULL,
    FOREIGN KEY (ID_DEPARTAMENTO) REFERENCES DEPARTAMENTO (ID)
);
CREATE TABLE ESTADO_SOLICITUD(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL,
    PREFIJO VARCHAR (30),
    ULTIMO_NUMERO INT
);
CREATE TABLE TIPO_CAMPO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL,
    FORMATO_CAMPO VARCHAR(50),
    TIPO_CONTROL VARCHAR(50)
);
CREATE TABLE TIPO_REQUISITO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL,
    ID_TIPO_CAMPO INT NOT NULL,
    FOREIGN KEY (ID_TIPO_CAMPO) REFERENCES TIPO_CAMPO (ID)
);
CREATE TABLE REQUISITO_TIPO_SOLICITUD(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (30) NOT NULL,
    REQUERIDO BIT NOT NULL,
    ADJUNTO BIT NOT NULL,
    TIPO_SOLICITUD INT NOT NULL,
    TIPO_REQUISITO INT NOT NULL,
    BORRADO BIT NOT NULL,
    FOREIGN KEY (TIPO_SOLICITUD) REFERENCES TIPO_SOLICITUD (ID),
    FOREIGN KEY (TIPO_REQUISITO) REFERENCES TIPO_REQUISITO (ID)
);
CREATE TABLE SOLICITUD(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FECHA DATETIME,
    ID_PERSONA INT NOT NULL,
    ID_USUARIO INT NOT NULL,
    ESTADO_SOLICITUD INT NOT NULL,
    TIPO_SOLICITUD INT NOT NULL,
    FOREIGN KEY (ID_PERSONA) REFERENCES PERSONA (ID),
    FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO (ID),
    FOREIGN KEY (ESTADO_SOLICITUD) REFERENCES ESTADO_SOLICITUD (ID),
    FOREIGN KEY (TIPO_SOLICITUD) REFERENCES TIPO_SOLICITUD (ID)
);
CREATE TABLE DETALLE_SOLICITUD(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CAMPO_REQUISITO VARCHAR(200),
    ADJUNTO_REQUISITO VARCHAR (1000),
    CUMPLE BIT,
    ID_SOLICITUD INT NOT NULL,
    TIPO_REQUISITO INT NOT NULL,
    FOREIGN KEY (ID_SOLICITUD) REFERENCES SOLICITUD(ID),
    FOREIGN KEY (TIPO_REQUISITO) REFERENCES TIPO_REQUISITO(ID)
);
CREATE TABLE SESION (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FECHA DATETIME NOT NULL,
    DESCRIPCION VARCHAR(200) NOT NULL,
    ACTA_APROBADA BIT NOT NULL,
    URL_ACTA VARCHAR (200),
    URL_AGENDA VARCHAR (200),
    URL_VIDEO VARCHAR (200),
);
CREATE TABLE NOTICIA (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    TITULO VARCHAR (100) NOT NULL,
    DESCRIPCION_LARGA VARCHAR(1000) NOT NULL,
    URL_IMAGEN VARCHAR(200), 
    INHABILITADA BIT NOT NULL,
);
CREATE TABLE BITACORA_SOLICITUD (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_SOLICITUD INT NOT NULL,
    ID_USUARIO INT NOT NULL,
    ID_ESTADO INT NOT NULL,
    FECHA DATETIME NOT NULL,
    NOTA VARCHAR (200),
    DETALLE VARCHAR (1000),
    FOREIGN KEY (ID_SOLICITUD) REFERENCES SOLICITUD(ID),
    FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID),
    FOREIGN KEY (ID_ESTADO) REFERENCES ESTADO_SOLICITUD (ID)
);
CREATE TABLE IMAGEN_USUARIO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    URL_IMAGEN VARCHAR (2000),
    FOREIGN KEY (ID_USUARIO) REFERENCES PERSONA(ID)
);
CREATE TABLE CREDENCIALES(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    CODIGO VARCHAR (20),
    URL_IMAGEN VARCHAR(1000),
    FIRMA VARCHAR(100),
    FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID)
);
CREATE TABLE CONCEJO(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    TESTIMONIO VARCHAR (2000),
    ID_USUARIO INT NOT NULL,
    FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID)
);
CREATE TABLE PARAMETROS(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPCION VARCHAR (300),
    VALOR VARCHAR (300)
);
/*SMTP*/
INSERT INTO PARAMETROS (DESCRIPCION, VALOR) VALUES ('host', 'smtp.zeptomail.com');
INSERT INTO PARAMETROS (DESCRIPCION, VALOR) VALUES ('user', 'emailapikey');
INSERT INTO PARAMETROS (DESCRIPCION, VALOR) VALUES ('key', 'wSsVR61z/EHwB6t9z2f8c+w9yg5WDw/3EE112Vqh6iWpGqvC/cc7lk2aAgOvSfkcFGRtF2ASpO56nBkD1TVc2dR/ng1VCiiF9mqRe1U4J3x17qnvhDzNV2hclxqPKY4Pzwxrm2VgGsEj+g==');
INSERT INTO PARAMETROS (DESCRIPCION, VALOR) VALUES ('from', 'noreply@muniriocuarto.go.cr');
/*Tipos de Identificación*/
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('Cédula de identidad');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('Pasaporte');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('Cédula de residencia');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('Número interno');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('Número asegurado');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('DIMEX');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('NITE');
INSERT INTO TIPO_IDENTIFICACION (DESCRIPCION) VALUES ('DIDI');

/*Departamentos*/
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Externo', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Alcaldía', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Proveeduría', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Departamento Legal', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Control Urbano', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Catastro y Valoración', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Unidad Técnica de Gestión Vial', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Dirección Financiera y Tributaria', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Plataforma', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Patentes', 0);
INSERT INTO DEPARTAMENTO (DESCRIPCION, BORRADO) VALUES ('Secretaría del Concejo', 0);

/*Estado Usuario*/
INSERT INTO ESTADO_USUARIO (DESCRIPCION) VALUES ('Activo');
INSERT INTO ESTADO_USUARIO (DESCRIPCION) VALUES ('Inactivo');
INSERT INTO ESTADO_USUARIO (DESCRIPCION) VALUES ('Sin Registrar');
INSERT INTO ESTADO_USUARIO (DESCRIPCION) VALUES ('Por Confirmar');

/*Estado Solicitud*/
INSERT INTO ESTADO_SOLICITUD (DESCRIPCION) VALUES ('Aprobada');
INSERT INTO ESTADO_SOLICITUD (DESCRIPCION) VALUES ('No aprobada');

/*Tipos de Solicitud*/
INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO) VALUES ('Solicitud de Patentes', 2, 0);
INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO) VALUES ('Solicitud de Uso de Suelo', 2, 0);
INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO) VALUES ('Solicitud de Visado', 2, 0);
INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO) VALUES ('Solicitud Condonación Ley 10026', 2, 0);
INSERT INTO TIPO_SOLICITUD (DESCRIPCION, ID_DEPARTAMENTO, BORRADO) VALUES ('Declaraciones', 2, 0);

/*Solicitud de Patentes*/

/*Adjuntos requisito*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Requisitos para Solicitud de Patentes', 'file', 'file');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (1, 'requisito patente');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Requisitos para Solicitud de Patentes',0, 1, 1, 1, 0);

/*Uso de Patente*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Uso de Patente', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (2, 'uso patente');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO) VALUES ('Uso de Patente',0, 1, 1, 2, 0); 

/*Nombre de Fantasia*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Nombre de Fantasia', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (3, 'nombre fantasia');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Nombre de Fantasia',0, 1, 1, 3, 0);

/*Actividad Comercial*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Actividad Comercial', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (4, 'actividad comercial');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Actividad Comercial',0, 1, 1, 4, 0);

/*Cuenta con Uso de Suelo*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Cuenta con Uso de Suelo', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (5, 'uso suelo');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Cuenta con Uso de Suelo',0, 1, 1, 5, 0);

/*Distrito*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Distrito', 'int', 'fk');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (6, 'distrito');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Distrito',0, 1, 1, 6, 0);

/*Direccion Exacta*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL) 
VALUES ('Direccion Exacta', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (7, 'Direccion Exacta');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Direccion Exacta',0, 1, 1, 7, 0);

/*Área*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Área', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (8, 'Área');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Área',0, 1, 1, 8, 0);

/*Dimensiones*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Dimensiones', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (9, 'Dimensiones');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Dimensiones',0, 1, 1, 9, 0);

/*Solicitud de Uso de Suelo*/

/*Distrito*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Distrito', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (10, 'Distrito');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Distrito',0, 1, 1, 10, 0);

/*Direccion Propiedad*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Direccion Propiedad', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (11, 'Direccion Propiedad');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Direccion Propiedad',0, 1, 1, 11, 0);

/*Numero de Finca*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Numero de Finca', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (12, 'Numero de Finca');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Numero de Finca',0, 1, 1, 12, 0);

/*Numero de Plano*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Numero de Plano', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (13, 'Numero de Plano');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Numero de Plano',0, 1, 1, 13, 0);

/*Motivo*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Motivo', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (14, 'Motivo');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Motivo',0, 1, 1, 14, 0);

/*Uso Solicitado*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Uso Solicitado', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (15, 'Uso Solicitado');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Uso Solicitado',0, 1, 1, 15, 0);

/*Plano Catastro*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Plano Catastro', 'file', 'file');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (16, 'Plano Catastro');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Plano Catastro',0, 1, 1, 16, 0);

/*Uso de Suelo Digital*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Uso de Suelo Digital', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (17, 'Uso de Suelo Digital');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Uso de Suelo Digital',0, 1, 1, 17, 0);

/*Solicitud de Visado*/

/*Direccion de plano a revisar*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Direccion de plano a revisar', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (18, 'Direccion de plano a revisar');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Direccion de plano a revisar',0, 1, 1, 18, 0);

/*Distrito*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Distrito', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (19, 'Distrito');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Distrito',0, 1, 1, 19, 0);

/*Número de Plano o Presentación*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Número de Plano o Presentación', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (20, 'Número de Plano o Presentación');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Número de Plano o Presentación',0, 1, 1, 20, 0);

/*Área del Plano*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Área del Plano', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (21, 'Área del Plano');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Área del Plano',0, 1, 1, 21, 0);

/*Número de Finca*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Número de Finca', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (22, 'Número de Finca');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Número de Finca',0, 1, 1, 22, 0);

/*Área según Registro Público*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Área según Registro Público', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (23, 'Área según Registro Público');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Área según Registro Público',0, 1, 1, 23, 0);

/*Frente*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Frente', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (24, 'Frente');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Frente',0, 1, 1, 24, 0);

/*Número de Contrato CFIA*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Número de Contrato CFIA', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (25, 'Número de Contrato CFIA');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Número de Contrato CFIA',0, 1, 1, 25, 0);

/*Carta de Disponibilidad de Agua*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Carta de Disponibilidad de Agua', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (26, 'Carta de Disponibilidad de Agua');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Carta de Disponibilidad de Agua',0, 1, 1, 26, 0);

/*Croquis*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Croquis', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (27, 'Croquis');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Croquis',0, 1, 1, 27, 0);

/*Plano Corregido*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Plano Corregido', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (28, 'Plano Corregido');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Plano Corregido',0, 1, 1, 28, 0);

/*Copia de la Minuta*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Copia de la Minuta', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (29, 'Copia de la Minuta');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Copia de la Minuta',0, 1, 1, 29, 0);

/*Carta de Certificación MOPT*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Carta de Certificación MOPT', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (30, 'Carta de Certificación MOPT');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Carta de Certificación MOPT',0, 1, 1, 30, 0);

/*Firma*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Firma', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (31, 'Firma');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Firma',0, 1, 1, 31, 0);

/*Solicitud de condonación*/

/*Representante Legal*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Representante Legal', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (32, 'Representante Legal');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Representante Legal',0, 1, 1, 32, 0);

/*Identificación del Representante*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Identificación del Representante', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (33, 'Identificación del Representante');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Identificación del Representante',0, 1, 1, 33, 0);

/*Dirección*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Dirección', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (34, 'Dirección');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Dirección',0, 1, 1, 34, 0);

/*Notificaciones*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Notificaciones', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (35, 'Notificaciones');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Notificaciones',0, 1, 1, 35, 0);

/*Tipo de Solicitud*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Tipo de Solicitud', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (36, 'Tipo de Solicitud');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Tipo de Solicitud',0, 1, 1, 36, 0);

/*Firma*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Firma', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (37, 'Firma');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Firma',0, 1, 1, 37, 0);

/*Recibido Por*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Recibido Por', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (38, 'Recibido Por');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Recibido Por',0, 1, 1, 38, 0);

/*Fecha*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Fecha', 'date', 'date');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (39, 'Fecha');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Fecha',0, 1, 1, 39, 0);

/*Funcionario*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Funcionario', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (40, 'Funcionario');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Funcionario',0, 1, 1, 40, 0);

/*Consecutivo*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Consecutivo', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (41, 'Consecutivo');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Consecutivo',0, 1, 1, 41, 0);

/*Total Contado*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Total Contado', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (42, 'Total Contado');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Total Contado',0, 1, 1, 42, 0);

/*Monto a Condonar Contado*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Monto a Condonar Contado', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (43, 'Monto a Condonar Contado');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Monto a Condonar Contado',0, 1, 1, 43, 0);

/*Fecha de Pago*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Fecha de Pago', 'date', 'date');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (44, 'Fecha de Pago');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Fecha de Pago',0, 1, 1, 44, 0);

/*Total Arreglo de Pago*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Total Arreglo de Pago', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (45, 'Total Arreglo de Pago');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Total Arreglo de Pago',0, 1, 1, 45, 0);

/*Monto a Condonar Arreglo de Pago*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Monto a Condonar Arreglo de Pago', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (46, 'Monto a Condonar Arreglo de Pago');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Monto a Condonar Arreglo de Pago',0, 1, 1, 46, 0);

/*Fecha de Inicio*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Fecha de Inicio', 'date', 'date');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (47, 'Fecha de Inicio');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Fecha de Inicio',0, 1, 1, 47, 0);

/*Plazo*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Plazo', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (48, 'Plazo');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Plazo',0, 1, 1, 48, 0);

/*Cantidad de Cuotas*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Cantidad de Cuotas', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (49, 'Cantidad de Cuotas');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Cantidad de Cuotas',0, 1, 1, 49, 0);

/*Adelanto 20%*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Adelanto 20%', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (50, 'Adelanto 20%');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Adelanto 20%',0, 1, 1, 50, 0);

/*Pago por Cuota*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Pago por Cuota', 'number', 'number');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (51, 'Pago por Cuota');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Pago por Cuota',0, 1, 1, 51, 0);

/*Resolución*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Resolución', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (52, 'Resolución');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Resolución',0, 1, 1, 52, 0);

/*Plazo de Prevención*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Plazo de Prevención', 'text', 'text');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (53, 'Plazo de Prevención');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Plazo de Prevención',0, 1, 1, 53, 0);

/*Fecha de Notificación*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Fecha de Notificación', 'date', 'date');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (54, 'Fecha de Notificación');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Fecha de Notificación',0, 1, 1, 54, 0);

/*Cumple*/
INSERT INTO TIPO_CAMPO(DESCRIPCION, FORMATO_CAMPO, TIPO_CONTROL)
VALUES ('Cumple', 'bit', 'bit');
INSERT INTO TIPO_REQUISITO (ID_TIPO_CAMPO, DESCRIPCION) VALUES (55, 'Cumple');
INSERT INTO REQUISITO_TIPO_SOLICITUD (DESCRIPCION, REQUERIDO, ADJUNTO, TIPO_SOLICITUD, TIPO_REQUISITO, BORRADO)
VALUES ('Cumple',0, 1, 1, 55, 0);