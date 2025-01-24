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
    TELEFONO VARCHAR (15) UNIQUE,
    WHATSAPP VARCHAR(15) UNIQUE,
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
    ADJUNTO_REQUISITO VARCHAR (200),
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
CREATE TABLE PERSONA_SESION (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_SESION INT NOT NULL,
    ID_PERSONA INT NOT NULL,
    FOREIGN KEY (ID_SESION) REFERENCES SESION(ID),
    FOREIGN KEY (ID_PERSONA) REFERENCES PERSONA(ID)
);
CREATE TABLE NOTICIA (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    TITULO VARCHAR (100) NOT NULL,
    DESCRIPCION_LARGA VARCHAR(1000) NOT NULL,
    URL_IMAGEN VARCHAR(200), 
    INHABILITADA BIT NOT NULL,
);

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