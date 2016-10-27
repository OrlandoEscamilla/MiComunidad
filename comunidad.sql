-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2016 a las 19:04:26
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comunidad`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_asesoria` (IN `id_usuario` INT(11), IN `carrera` VARCHAR(15), IN `materia` VARCHAR(25), IN `dominio` VARCHAR(10), IN `costo` VARCHAR(12), IN `descripcion` TEXT, IN `registro` DATE)  NO SQL
INSERT INTO asesorias (id_usuario, carrera, materia, dominio, costo, descripcion, registro)
VALUES (id_usuario, carrera, materia, dominio, costo, descripcion, registro)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_evaluacion` (IN `id` INT, IN `nombre` VARCHAR(50), IN `asistencia` INT(1), IN `conocimiento` INT(1), IN `exigencia` INT(1), IN `evaluacion` TEXT, IN `registro` DATE)  NO SQL
INSERT INTO evaluaciones (id_usuario, nombre_profesor, asistencia, exigencia, conocimiento, evaluacion, registro)
VALUES (id, nombre, asistencia, conocimiento, exigencia, evaluacion, registro)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_profesor` (IN `nombre` VARCHAR(50), IN `registro` DATE)  NO SQL
INSERT INTO profesores (nombre, registro) VALUES (nombre, registro)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_usuario` (IN `nombre` VARCHAR(40), IN `correo` VARCHAR(30), IN `pass` VARCHAR(8), IN `telefono` INT(10), IN `carrera` VARCHAR(15), IN `registro` DATE)  NO SQL
INSERT INTO usuarios(nombre, email, pass, telefono, carrera_usuario, registro)
VALUES (nombre, correo, pass, telefono, carrera, registro)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesorias`
--

CREATE TABLE `asesorias` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `carrera` varchar(15) NOT NULL,
  `materia` varchar(25) NOT NULL,
  `dominio` varchar(10) NOT NULL,
  `costo` varchar(12) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asesorias`
--

INSERT INTO `asesorias` (`id`, `id_usuario`, `carrera`, `materia`, `dominio`, `costo`, `descripcion`, `estado`, `registro`) VALUES
(1, 1, 'Sistemas', 'POO', 'Básico', 'Gratuito', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi voluptatum voluptas accusantium excepturi, quisquam, id veritatis ea suscipit, omnis, voluptates doloribus necessitatibus quam consequatur recusandae aliquid optio alias nisi. Nam.', 2, '2016-02-08'),
(2, 8, 'Geociencias', 'POO', 'Básico', 'Gratuito', 'Soy asesor', 2, '2016-02-15'),
(3, 1, 'Sistemas', 'Química', 'Avanzado', 'Por acordar', 'Asesoría de quimica!', 2, '2016-02-15'),
(4, 7, 'Sistemas', 'Cálculo Diferencial', 'Intermedio', 'Por acordar', 'Ofrezco asesorías de cálculo baratas!', 2, '2016-02-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_profesor` varchar(50) NOT NULL,
  `asistencia` tinyint(1) NOT NULL,
  `exigencia` tinyint(1) NOT NULL,
  `conocimiento` tinyint(1) NOT NULL,
  `evaluacion` text NOT NULL,
  `registro` date NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `id_usuario`, `nombre_profesor`, `asistencia`, `exigencia`, `conocimiento`, `evaluacion`, `registro`, `estado`) VALUES
(2, 1, 'Elizabeth Cortéz', 5, 5, 5, 'Este es un comentario [re-editado]x4                                                                                                                               ', '2016-02-15', 2),
(3, 1, 'Jorge Peralta', 9, 10, 8, 'El primer comentario del profe Jorge Peralta.', '2016-02-15', 2),
(4, 8, 'Elizabeth Cortéz', 5, 5, 5, 'Hice primer comment!', '2016-02-15', 2),
(5, 7, 'Jorge Peralta', 7, 7, 7, 'La evaluación del profe peralta por joya.', '2016-02-17', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `registro` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre`, `registro`, `estado`) VALUES
(15, 'Elizabeth Cortéz', '2016-02-11', 1),
(17, 'Jorge Peralta', '2016-02-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `telefono` int(10) DEFAULT NULL,
  `carrera_usuario` varchar(15) DEFAULT NULL,
  `permiso` tinyint(1) DEFAULT '2',
  `registro` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`, `telefono`, `carrera_usuario`, `permiso`, `registro`, `estado`) VALUES
(1, 'Hiram Guerrero', 'hiramg90@gmail.com', 'chato', 2147483647, 'Sistemas', 1, '2016-02-05', 1),
(5, 'Tadeo Calles', 'tadeo@gmail.com', 'tadeo', 2147483647, 'Sistemas', 2, '2016-02-05', 1),
(6, 'Chris', 'chris@gmail.com', 'chris', 2147483647, 'Sistemas', 2, '2016-02-05', 1),
(7, 'Joya', 'joya@gmail.com', 'joya', 833123456, 'Sistemas', 2, '2016-02-05', 1),
(8, 'Rocky', 'rocky@gmail.com', 'rocky', 833123456, 'Geociencias', 2, '2016-02-05', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_asesores`
--
CREATE TABLE `view_asesores` (
`id` int(11)
,`id_usuario` int(11)
,`nombre` varchar(40)
,`carrera` varchar(15)
,`materia` varchar(25)
,`dominio` varchar(10)
,`costo` varchar(12)
,`estado` tinyint(1)
,`descripcion` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_profesores`
--
CREATE TABLE `view_profesores` (
`nombre_profesor` varchar(50)
,`asistencia` tinyint(1)
,`exigencia` tinyint(1)
,`conocimiento` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_asesores`
--
DROP TABLE IF EXISTS `view_asesores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asesores`  AS  select `asesorias`.`id` AS `id`,`asesorias`.`id_usuario` AS `id_usuario`,`usuarios`.`nombre` AS `nombre`,`asesorias`.`carrera` AS `carrera`,`asesorias`.`materia` AS `materia`,`asesorias`.`dominio` AS `dominio`,`asesorias`.`costo` AS `costo`,`asesorias`.`estado` AS `estado`,`asesorias`.`descripcion` AS `descripcion` from (`asesorias` join `usuarios` on((`asesorias`.`id_usuario` = `usuarios`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_profesores`
--
DROP TABLE IF EXISTS `view_profesores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_profesores`  AS  select `evaluaciones`.`nombre_profesor` AS `nombre_profesor`,`evaluaciones`.`asistencia` AS `asistencia`,`evaluaciones`.`exigencia` AS `exigencia`,`evaluaciones`.`conocimiento` AS `conocimiento` from `evaluaciones` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesorias`
--
ALTER TABLE `asesorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asesorias_usuarios` (`id_usuario`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evaluaciones_usuarios` (`id_usuario`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_profesores` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesorias`
--
ALTER TABLE `asesorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asesorias`
--
ALTER TABLE `asesorias`
  ADD CONSTRAINT `fk_asesorias_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `fk_evaluaciones_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
