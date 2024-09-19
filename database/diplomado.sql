CREATE TABLE asistente (
  nombre_asistente varchar(100) NOT NULL,
  id_asistente int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  dir_asistente varchar(255) NOT NULL,
  tel_asistente varchar(10) NOT NULL,
  email_asistente varchar(100) NOT NULL,
  genero_asistente enum('Masculino','Femenino','Otro') NOT NULL,
  fecha_nacimiento_asistente date NOT NULL,
  fecha_vinculacion_asistente date NOT NULL,
  acuerdo_nombramiento_asistente varchar(255) NOT NULL,
  fyh_creacion datetime DEFAULT NULL,
  fyh_actualizacion datetime DEFAULT NULL,
  estado varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE cohorte (
  cod_cohorte int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_cohorte varchar(100) NOT NULL,
  fecha_inicio date NOT NULL,
  fecha_finalizacion date NOT NULL,
  N_estudiantes text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE coordinadores (
  nombre_cordi varchar(100) NOT NULL,
  id_cordi int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  dir_cordi varchar(255) NOT NULL,
  tel_cordi varchar(10) NOT NULL,
  email_cordi varchar(100) NOT NULL,
  genero_cordi enum('Masculino','Femenino','Otro') NOT NULL,
  fecha_nacimiento_cordi date NOT NULL,
  fecha_vinculacion_cordi date NOT NULL,
  acuerdo_nombramiento_cordi varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE docentes (
  nombre_docente varchar(100) NOT NULL,
  id_docente int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  dir_docente varchar(255) NOT NULL,
  tel_docente varchar(10) NOT NULL,
  email_docente varchar(100) NOT NULL,
  genero_docente enum('Masculino','Femenino','Otro') NOT NULL,
  fecha_nacimiento_docente date NOT NULL,
  formacion_academica enum('Pregrado','Posgrado') NOT NULL,
  areas_conocimiento set('Ingeniería de Software','Telecomunicaciones','Bases de Datos','Inteligencia Artificial','Ciencia de Datos','Redes y Seguridad','Sistemas Embebidos','Desarrollo Web') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE estudiante (
  nombre_estudiante varchar(255) NOT NULL,
  id_estudiante int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Cod_estudiante int(11) NOT NULL,
  foto_estudiante varchar(255) NOT NULL,
  dir_estudiante varchar(255) NOT NULL,
  tel_estudiante varchar(20) NOT NULL,
  email_estudiante varchar(100) NOT NULL,
  fecha_nacimiento date NOT NULL,
  semestre_estudiante enum('Semestre 7','Semestre 8','Semestre 9','Semestre 10','Egresado') NOT NULL,
  estado_civil enum('Soltero','Casado','Divorciado','UnionLibre','Viudo') NOT NULL,
  fecha_ingreso date NOT NULL,
  fecha_egreso date NOT NULL,
  estado_cohorte enum('Cohorte1','Cohorte2','Cohorte3','Cohorte4') NOT NULL,
  programa enum('Sistemas','Electrica','Agronomia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE programas (
  snies int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_program varchar(255) NOT NULL,
  des_program varchar(255) NOT NULL,
  email_program varchar(255) NOT NULL,
  lineas_trabajo varchar(255) NOT NULL,
  fecha date NOT NULL,
  no_resolucion int(11) NOT NULL,
  archivo_pdf varchar(255) NOT NULL,
  logo varchar(255) NOT NULL,
  fyh_creacion datetime DEFAULT NULL,
  fyh_actualizacion datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE roles (

  id_rol        INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_rol    VARCHAR (255) NOT NULL UNIQUE KEY,

  fyh_creacion   DATETIME NULL,
  fyh_actualizacion DATETIME NULL,
  estado        VARCHAR (11)

)ENGINE=InnoDB;
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES  ('ADMINISTRADOR','2024-01-03 16:20:20','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES  ('COORDINADOR','2024-01-03 16:20:20','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES  ('ASISTENTE','2024-01-03 16:20:20','1');

CREATE TABLE usuarios (

  id_usuario    INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombres       VARCHAR (255) NOT NULL,
  rol_id        INT (11) NOT NULL,
  email         VARCHAR (255) NOT NULL UNIQUE KEY,
  password      TEXT NOT NULL,

  fyh_creacion   DATETIME NULL,
  fyh_actualizacion DATETIME NULL,
  estado        VARCHAR (11),

  FOREIGN KEY (rol_id) REFERENCES roles (id_rol) on delete no action on update cascade

)ENGINE=InnoDB;


INSERT INTO usuarios (nombres,rol_id,email,password,fyh_creacion,estado)
VALUES ('christian','1','cristianerazoc9.5@gmail.com','$2y$10$0tYmdHU9uGCIxY1f90W1EuIm54NQ8axowkxL1WzLbqO2LdNa8m3l2','2024-09-05 25:24:10','1');

INSERT INTO usuarios (nombres,rol_id,email,password,fyh_creacion,estado)
VALUES ('Jhon','2','jhonxavi830@gmail.com','$2y$10$0tYmdHU9uGCIxY1f90W1EuIm54NQ8axowkxL1WzLbqO2LdNa8m3l2','2024-09-05 25:24:10','1');


CREATE TABLE permisos (

  id_permiso        INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  
  nombre_url        VARCHAR (100) NOT NULL,
  url               text NOT NULL,

  fyh_creacion   DATETIME NULL,
  fyh_actualizacion DATETIME NULL,
  estado        VARCHAR (11)

)ENGINE=InnoDB;

INSERT INTO permisos (nombre_url,url, fyh_creacion, estado)
VALUES ('Programas', 'admin/programas/index.php', '2024-01-03 16:20:20','1');

CREATE TABLE roles_permisos (

  id_rol_permiso    INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  
  rol_id            INT (11) NOT NULL,
  permiso_id        INT (11) NOT NULL,

  fyh_creacion   DATETIME NULL,
  fyh_actualizacion DATETIME NULL,
  estado        VARCHAR (11), 

  FOREIGN KEY (rol_id) REFERENCES roles (id_rol) on delete no action on update cascade,
  FOREIGN KEY (permiso_id) REFERENCES permisos (id_permiso) on delete no action on update cascade

)ENGINE=InnoDB;
