-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2017 a las 10:37:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psicologa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_cita`
--

CREATE TABLE `tab_cita` (
  `idTab_Cita` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` enum('Pagada','Cancelada','Pendiente','Pospuesta') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_consulta`
--

CREATE TABLE `tab_consulta` (
  `idTab_Consulta` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` enum('Ausente','Asistencia','Pospuesta','Cancelada','Pendiente','Pagada','Credito') NOT NULL DEFAULT 'Pendiente',
  `Nota` int(11) DEFAULT NULL,
  `idExpediente` int(11) NOT NULL,
  `idPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_expediente`
--

CREATE TABLE `tab_expediente` (
  `idTab_Expediente` int(11) NOT NULL,
  `Titutlo` varchar(30) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Tecnica` varchar(150) NOT NULL,
  `idNota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_historial`
--

CREATE TABLE `tab_historial` (
  `idTab_Historial` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Seccion` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Accion` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Description` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ip` varchar(17) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Dispositivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_media`
--

CREATE TABLE `tab_media` (
  `idTab_Media` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idExperiencia` int(11) NOT NULL,
  `UrlArchivo` varchar(80) NOT NULL,
  `TipoArchivo` enum('Receta','Analisis','PendienteUsuario','Radiografia','Tratamiento','Otro','Especialidad','Tecnica') NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_pago`
--

CREATE TABLE `tab_pago` (
  `idTab_Pago` int(11) NOT NULL,
  `FormaPago` enum('Efectivo','MevadoPago','Oxxo','Paypal','Visa','Cheque','MasterCard') NOT NULL,
  `creditos` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` enum('Autorizado','Pendiente','NoAplica','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tipousuario`
--

CREATE TABLE `tab_tipousuario` (
  `idTab_TipoUsuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tipousuario`
--

INSERT INTO `tab_tipousuario` (`idTab_TipoUsuario`, `Nombre`) VALUES
(1, 'Contacto'),
(2, 'Registrado'),
(3, 'Paciente'),
(4, 'Visitante'),
(5, 'Admin'),
(6, 'Super Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_usuarios`
--

CREATE TABLE `tab_usuarios` (
  `idTab_Usario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Direccion` varchar(70) NOT NULL,
  `Telefono2` varchar(15) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_usuarios`
--

INSERT INTO `tab_usuarios` (`idTab_Usario`, `Nombre`, `Usuario`, `Password`, `Apellidos`, `Telefono`, `Email`, `Direccion`, `Telefono2`, `idTipoUsuario`) VALUES
(1, 'Arturo Navarrete', 'lans', 'aserty', '', '', '', '', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tab_cita`
--
ALTER TABLE `tab_cita`
  ADD PRIMARY KEY (`idTab_Cita`);

--
-- Indices de la tabla `tab_consulta`
--
ALTER TABLE `tab_consulta`
  ADD PRIMARY KEY (`idTab_Consulta`);

--
-- Indices de la tabla `tab_expediente`
--
ALTER TABLE `tab_expediente`
  ADD PRIMARY KEY (`idTab_Expediente`);

--
-- Indices de la tabla `tab_historial`
--
ALTER TABLE `tab_historial`
  ADD PRIMARY KEY (`idTab_Historial`);

--
-- Indices de la tabla `tab_media`
--
ALTER TABLE `tab_media`
  ADD PRIMARY KEY (`idTab_Media`);

--
-- Indices de la tabla `tab_pago`
--
ALTER TABLE `tab_pago`
  ADD PRIMARY KEY (`idTab_Pago`);

--
-- Indices de la tabla `tab_tipousuario`
--
ALTER TABLE `tab_tipousuario`
  ADD PRIMARY KEY (`idTab_TipoUsuario`);

--
-- Indices de la tabla `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  ADD PRIMARY KEY (`idTab_Usario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tab_cita`
--
ALTER TABLE `tab_cita`
  MODIFY `idTab_Cita` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_consulta`
--
ALTER TABLE `tab_consulta`
  MODIFY `idTab_Consulta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_expediente`
--
ALTER TABLE `tab_expediente`
  MODIFY `idTab_Expediente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_historial`
--
ALTER TABLE `tab_historial`
  MODIFY `idTab_Historial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_media`
--
ALTER TABLE `tab_media`
  MODIFY `idTab_Media` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_pago`
--
ALTER TABLE `tab_pago`
  MODIFY `idTab_Pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tab_tipousuario`
--
ALTER TABLE `tab_tipousuario`
  MODIFY `idTab_TipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  MODIFY `idTab_Usario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
