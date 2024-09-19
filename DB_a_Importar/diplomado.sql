-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 23:56:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `diplomado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente`
--

CREATE TABLE `asistente` (
  `nombre_asistente` varchar(100) NOT NULL,
  `id_asistente` int(11) NOT NULL,
  `dir_asistente` varchar(255) NOT NULL,
  `tel_asistente` varchar(10) NOT NULL,
  `email_asistente` varchar(100) NOT NULL,
  `genero_asistente` enum('Masculino','Femenino','Otro') NOT NULL,
  `fecha_nacimiento_asistente` date NOT NULL,
  `fecha_vinculacion_asistente` date NOT NULL,
  `acuerdo_nombramiento_asistente` varchar(255) NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistente`
--

INSERT INTO `asistente` (`nombre_asistente`, `id_asistente`, `dir_asistente`, `tel_asistente`, `email_asistente`, `genero_asistente`, `fecha_nacimiento_asistente`, `fecha_vinculacion_asistente`, `acuerdo_nombramiento_asistente`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
('Carlos Perez', 1, 'Calle 12 #34-56, Bogotá', '3101234567', 'carlos.perez@mail.com', 'Masculino', '1985-04-12', '2020-01-15', 'Acuerdo 01/2020', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Laura Gómez', 2, 'Carrera 10 #22-33, Medellín', '3209876543', 'laura.gomez@mail.com', 'Femenino', '1990-07-08', '2021-06-01', 'Acuerdo 15/2021', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Andrés Martínez', 3, 'Calle 45 #12-34, Cali', '3151234568', 'andres.martinez@mail.com', 'Masculino', '1987-09-23', '2019-03-10', 'Acuerdo 05/2019', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('María Rodríguez', 4, 'Avenida 19 #20-50, Bogotá', '3012345678', 'maria.rodriguez@mail.com', 'Femenino', '1992-11-15', '2022-04-22', 'Acuerdo 22/2022', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Juan Hernández', 5, 'Calle 8 #23-45, Barranquilla', '3112345678', 'juan.hernandez@mail.com', 'Masculino', '1995-02-18', '2020-09-10', 'Acuerdo 18/2020', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Sofía López', 6, 'Carrera 9 #33-22, Cartagena', '3023456789', 'sofia.lopez@mail.com', 'Femenino', '1988-05-25', '2018-12-05', 'Acuerdo 03/2018', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Pedro Ortiz', 7, 'Calle 7 #19-65, Bogotá', '3124567890', 'pedro.ortiz@mail.com', 'Masculino', '1991-03-12', '2017-11-30', 'Acuerdo 21/2017', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Elena Castillo', 8, 'Carrera 8 #44-55, Medellín', '3225678901', 'elena.castillo@mail.com', 'Femenino', '1993-08-07', '2021-02-17', 'Acuerdo 07/2021', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Miguel Ramírez', 9, 'Calle 6 #16-12, Cali', '3136789012', 'miguel.ramirez@mail.com', 'Masculino', '1984-06-18', '2016-05-12', 'Acuerdo 09/2016', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo'),
('Ana Torres', 10, 'Avenida 7 #12-34, Bogotá', '3047890123', 'ana.torres@mail.com', 'Femenino', '1996-10-21', '2022-07-14', 'Acuerdo 27/2022', '2024-09-18 16:46:17', '2024-09-18 16:46:17', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cohorte`
--

CREATE TABLE `cohorte` (
  `cod_cohorte` int(50) NOT NULL,
  `nombre_cohorte` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `N_estudiantes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cohorte`
--

INSERT INTO `cohorte` (`cod_cohorte`, `nombre_cohorte`, `fecha_inicio`, `fecha_finalizacion`, `N_estudiantes`) VALUES
(1, 'Cohorte 2020 - Ingeniería de Sistemas', '2020-02-01', '2020-12-15', '120'),
(2, 'Cohorte 2021 - Ingeniería de Software', '2021-03-10', '2021-11-30', '110'),
(3, 'Cohorte 2022 - Ciencia de Datos', '2022-01-15', '2022-10-20', '135'),
(4, 'Cohorte 2023 - Inteligencia Artificial', '2023-04-01', '2023-12-10', '98'),
(5, 'Cohorte 2019 - Seguridad Informática', '2019-05-05', '2019-12-25', '150'),
(6, 'Cohorte 2020 - Desarrollo Web', '2020-06-20', '2021-02-28', '140');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinadores`
--

CREATE TABLE `coordinadores` (
  `nombre_cordi` varchar(100) NOT NULL,
  `id_cordi` int(20) NOT NULL,
  `dir_cordi` varchar(255) NOT NULL,
  `tel_cordi` varchar(10) NOT NULL,
  `email_cordi` varchar(100) NOT NULL,
  `genero_cordi` enum('Masculino','Femenino','Otro') NOT NULL,
  `fecha_nacimiento_cordi` date NOT NULL,
  `fecha_vinculacion_cordi` date NOT NULL,
  `acuerdo_nombramiento_cordi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`nombre_cordi`, `id_cordi`, `dir_cordi`, `tel_cordi`, `email_cordi`, `genero_cordi`, `fecha_nacimiento_cordi`, `fecha_vinculacion_cordi`, `acuerdo_nombramiento_cordi`) VALUES
('Oscar Revelo', 1, 'Carrera 11, #45-23, Pasto', '321456 789', 'OscarRevelo2343@udenar.edu.co', 'Masculino', '1988-06-15', '2004-11-18', '../../../uploads/66eb48d94a21e_Phrasal Verbs extended4.pdf'),
('Ricardo Timarán', 2, 'Carrera 15, #32-18, Cali', '311234 567', 'RicardoTimaran56@udenar.edu.co', 'Masculino', '1975-06-10', '1995-03-08', '../../../uploads/66eb49c565778_Phrasal Verbs extended4.pdf'),
('Laura Patricia Díaz', 3, 'Av. Siempre Viva 742, Cali', '3154567890', 'laura.diaz@universidad.edu', 'Femenino', '1990-07-18', '2021-06-10', 'Acuerdo_11223.pdf'),
('José Luis Martínez', 4, 'Calle 10 # 20-50, Barranquilla', '3209871234', 'jose.martinez@universidad.edu', 'Masculino', '1982-11-02', '2019-11-30', 'Acuerdo_33445.pdf'),
('Andrea Suárez Torres', 5, 'Carrera 7 # 14-23, Bucaramanga', '3011239876', 'andrea.suarez@universidad.edu', 'Femenino', '1992-01-25', '2022-01-05', 'Acuerdo_55667.pdf'),
('Ana María Gómez', 7, 'Calle 45 # 12-34, Bogotá', '3001234567', 'ana.gomez@universidad.edu', 'Femenino', '1985-04-12', '2020-03-15', 'Acuerdo_12345.pdf'),
('Carlos Ramírez Pérez', 8, 'Carrera 21 # 54-89, Medellín', '3129876543', 'carlos.ramirez@universidad.edu', 'Masculino', '1978-09-20', '2018-09-01', 'Acuerdo_67890.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `nombre_docente` varchar(100) NOT NULL,
  `id_docente` int(20) NOT NULL,
  `dir_docente` varchar(255) NOT NULL,
  `tel_docente` varchar(10) NOT NULL,
  `email_docente` varchar(100) NOT NULL,
  `genero_docente` enum('Masculino','Femenino','Otro') NOT NULL,
  `fecha_nacimiento_docente` date NOT NULL,
  `formacion_academica` enum('Pregrado','Posgrado') NOT NULL,
  `areas_conocimiento` set('Ingeniería de Software','Telecomunicaciones','Bases de Datos','Inteligencia Artificial','Ciencia de Datos','Redes y Seguridad','Sistemas Embebidos','Desarrollo Web') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`nombre_docente`, `id_docente`, `dir_docente`, `tel_docente`, `email_docente`, `genero_docente`, `fecha_nacimiento_docente`, `formacion_academica`, `areas_conocimiento`) VALUES
('Juan Pérez', 1, 'Calle 123 #45-67, Bogotá', '3009876543', 'juan.perez@universidad.edu', 'Masculino', '1980-05-10', 'Posgrado', 'Ingeniería de Software'),
('María Gómez', 2, 'Carrera 9 #12-34, Medellín', '3012345678', 'maria.gomez@universidad.edu', 'Femenino', '1985-03-22', 'Pregrado', 'Ciencia de Datos'),
('Carlos Ramírez', 3, 'Av. Los Andes 45, Cali', '3101234567', 'carlos.ramirez@universidad.edu', 'Masculino', '1979-12-01', 'Posgrado', 'Redes y Seguridad'),
('Laura Torres', 4, 'Calle 56 #7-89, Bucaramanga', '3156543210', 'laura.torres@universidad.edu', 'Femenino', '1990-07-18', 'Pregrado', 'Telecomunicaciones'),
('Andrés Castillo', 5, 'Carrera 17 #89-56, Barranquilla', '3124567890', 'andres.castillo@universidad.edu', 'Masculino', '1988-11-14', 'Posgrado', 'Ingeniería de Software'),
('Juan Perez', 6, 'carrera 11', '312345345', 'Arevalo@udenar.edu.com', 'Masculino', '2024-09-02', 'Pregrado', 'Redes y Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `nombre_estudiante` varchar(255) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `Cod_estudiante` int(11) NOT NULL,
  `foto_estudiante` varchar(255) NOT NULL,
  `dir_estudiante` varchar(255) NOT NULL,
  `tel_estudiante` varchar(20) NOT NULL,
  `email_estudiante` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `semestre_estudiante` enum('Semestre 7','Semestre 8','Semestre 9','Semestre 10','Egresado') NOT NULL,
  `estado_civil` enum('Soltero','Casado','Divorciado','UnionLibre','Viudo') NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date NOT NULL,
  `estado_cohorte` enum('Cohorte1','Cohorte2','Cohorte3','Cohorte4') NOT NULL,
  `programa` enum('Sistemas','Electrica','Agronomia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`nombre_estudiante`, `id_estudiante`, `Cod_estudiante`, `foto_estudiante`, `dir_estudiante`, `tel_estudiante`, `email_estudiante`, `fecha_nacimiento`, `semestre_estudiante`, `estado_civil`, `fecha_ingreso`, `fecha_egreso`, `estado_cohorte`, `programa`) VALUES
('Juan Perez Ordoñes', 2023001, 21912392, '../../../docest/66eb4b3ccccdd_est1.jpg', 'Calle 123 #45-67, Pasto', '3101234567', 'juan.perez@mail.com', '2005-02-17', 'Semestre 7', 'Soltero', '2016-06-10', '2024-09-05', 'Cohorte1', 'Sistemas'),
('María González', 2023002, 1232023002, '../../../docest/66eb4b9c535fb_est2.jpg', 'Carrera 45 #12-34, Medellín', '3209876543', 'maria.gonzalez@mail.com', '1998-07-18', 'Semestre 8', 'Casado', '2021-02-02', '2024-09-19', 'Cohorte2', 'Agronomia'),
('Carlos Ramírez', 2023003, 2147483647, '../../../docest/66eb4be6d0227_juan.jpg', 'Avenida 19 #20-50, Cali', '3113456789', 'carlos.ramirez@mail.com', '2014-02-05', 'Semestre 10', 'Divorciado', '2024-09-11', '2024-09-28', 'Cohorte4', 'Electrica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre_url` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre_url`, `url`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(2, 'Programas', '/admin/programas/index.php', '2024-01-03 16:20:20', '2024-09-18 12:55:10', '1'),
(8, 'Roles', '/admin/roles/index.php', '2024-09-18 00:02:03', '2024-09-18 12:55:29', '1'),
(9, 'Permisos', '/admin/roles/permisos.php', '2024-09-18 00:02:23', '2024-09-18 12:55:03', '1'),
(10, 'Usuarios', '/admin/usuarios/index.php', '2024-09-18 00:02:44', '2024-09-18 12:55:34', '1'),
(11, 'Coordinadores', '/admin/coordinadores/index.php', '2024-09-18 00:03:08', '2024-09-18 12:54:52', '1'),
(12, 'Asistentes', '/admin/asistente/index.php', '2024-09-18 00:03:23', '2024-09-18 12:54:43', '1'),
(13, 'Docentes', '/admin/docentes/index.php', '2024-09-18 00:03:42', '2024-09-18 12:54:55', '1'),
(14, 'Cohortes', '/admin/cohortes/index.php', '2024-09-18 00:03:53', '2024-09-18 12:54:48', '1'),
(15, 'Estudiantes', '/admin/estudiantes/index.php', '2024-09-18 00:04:16', '2024-09-18 12:54:59', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `snies` int(11) NOT NULL,
  `nombre_program` varchar(255) NOT NULL,
  `des_program` varchar(255) NOT NULL,
  `email_program` varchar(255) NOT NULL,
  `lineas_trabajo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `no_resolucion` int(11) NOT NULL,
  `archivo_pdf` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`snies`, `nombre_program`, `des_program`, `email_program`, `lineas_trabajo`, `fecha`, `no_resolucion`, `archivo_pdf`, `logo`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(215234876, 'Especialización en Construcción de Software', 'Enfocado en formar profesionales altamente capacitados en el diseño, desarrollo, implementación y mantenimiento de aplicaciones y sistemas de software', 'EspSoftware@udenar.edu.co', 'Construcción de Software', '2015-08-20', 1883455673, '../../../docpro/66eb48284ee94_Guide first second.pdf', '../../../docpro/66eb48284efb7_Especializacion.jpg', NULL, NULL),
(218234456, 'Maestría en Ingeniería de Sistemas y Computación', 'Posgrado orientado a la formación avanzada de profesionales en el diseño, análisis, desarrollo y gestión de sistemas complejos de software y hardware', 'IngSisCom@udenar.edu.co', 'Sistemas y Computacion', '2016-06-15', 2147483647, '../../../docpro/66eb4788af7fd_GuideAdjectives-Adverbs.pdf', '../../../docpro/66eb4788af99d_MaestriaOscar.jpg', NULL, NULL),
(219093482, 'Maestría en Gestión de Tecnologías de la Información y el Conocimiento', 'diseñado para formar profesionales con habilidades avanzadas en la administración, implementación y optimización de tecnologías y sistemas de información', 'TecInfo@udenar.edu.co', 'Tecnologia', '2024-02-06', 2147483647, '../../../docpro/66eb47058375a_Guia1_traduccion.pdf', '../../../docpro/66eb470583935_MestriaRicardo.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'PRESIDENTE', '2024-01-03 16:20:20', '2024-09-16 14:20:37', '1'),
(2, 'COORDINADOR', '2024-01-03 16:20:20', NULL, '1'),
(3, 'ASISTENTE', '2024-01-03 16:20:20', NULL, '1'),
(6, 'ADMINISTRADOR', '2024-09-17 23:45:47', '2024-09-18 13:10:44', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id_rol_permiso` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`id_rol_permiso`, `rol_id`, `permiso_id`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(2, 3, 2, '2024-09-17 22:55:38', NULL, 'Activo'),
(6, 1, 14, '2024-09-18 00:05:05', NULL, 'Activo'),
(7, 1, 12, '2024-09-18 00:05:12', NULL, 'Activo'),
(8, 1, 11, '2024-09-18 00:05:30', NULL, 'Activo'),
(9, 1, 13, '2024-09-18 00:05:35', NULL, 'Activo'),
(10, 1, 15, '2024-09-18 00:05:41', NULL, 'Activo'),
(11, 1, 9, '2024-09-18 00:05:46', NULL, 'Activo'),
(12, 1, 2, '2024-09-18 00:05:52', NULL, 'Activo'),
(13, 1, 8, '2024-09-18 00:05:57', NULL, 'Activo'),
(14, 1, 10, '2024-09-18 00:06:01', NULL, 'Activo'),
(15, 2, 12, '2024-09-18 00:09:02', NULL, 'Activo'),
(16, 2, 14, '2024-09-18 00:09:08', NULL, 'Activo'),
(17, 2, 13, '2024-09-18 00:09:18', NULL, 'Activo'),
(18, 2, 15, '2024-09-18 00:09:22', NULL, 'Activo'),
(19, 2, 2, '2024-09-18 12:58:35', NULL, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `rol_id`, `email`, `password`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'Luis Obeymar Estrada', 1, 'cristianerazoc9.5@gmail.com', '$2y$10$HLCA62bV2OGqhEJpOwzoAe6Kge3nZ02r0nUAYgdRnHHdyT5myCnaK', '2024-09-05 00:00:00', '2024-09-18 13:27:25', '1'),
(2, 'Oscar Revelo', 2, 'jhonxavi830@gmail.com', '$2y$10$FiuImULGkT1yIMA3RPbDxONJKpydVebxfRkao9D84fex4oK2YWjOS', '2024-09-05 00:00:00', '2024-09-18 13:28:03', '1'),
(5, 'Juan Andrez Perez', 3, 'jeisondaneiro@outlook.com', '$2y$10$0.WXgM0KYnAZr5xGldmH1OVZ.mSYi6qWivemMUkKVHsAanIBgs12q', '2024-09-16 18:09:24', '2024-09-18 13:32:24', '1'),
(6, 'Ricardo Timarán', 2, 'davidleccter02@gmail.com', '$2y$10$9h.aHyY.S5LA4wKPqMju8OLoVRsubcA/sLASTCh19sZJLr87Bw2J6', '2024-09-18 13:30:49', NULL, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistente`
--
ALTER TABLE `asistente`
  ADD PRIMARY KEY (`id_asistente`);

--
-- Indices de la tabla `cohorte`
--
ALTER TABLE `cohorte`
  ADD PRIMARY KEY (`cod_cohorte`);

--
-- Indices de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  ADD PRIMARY KEY (`id_cordi`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`snies`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id_rol_permiso`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistente`
--
ALTER TABLE `asistente`
  MODIFY `id_asistente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cohorte`
--
ALTER TABLE `cohorte`
  MODIFY `cod_cohorte` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id_cordi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1045982343;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023004;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `snies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219093483;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `id_rol_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
