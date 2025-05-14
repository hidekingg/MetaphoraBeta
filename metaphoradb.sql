-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2025 a las 12:15:19
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `metaphoradb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

DROP TABLE IF EXISTS `asientos`;
CREATE TABLE IF NOT EXISTS `asientos` (
  `IdAsiento` int NOT NULL AUTO_INCREMENT,
  `IdAutobus` int DEFAULT NULL,
  `NumeroAsiento` int DEFAULT NULL,
  `Columna` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IdTipoAsiento` int DEFAULT NULL,
  `IdEstadoAsiento` int DEFAULT NULL,
  PRIMARY KEY (`IdAsiento`),
  KEY `IdAutobus` (`IdAutobus`),
  KEY `IdTipoAsiento` (`IdTipoAsiento`),
  KEY `IdEstadoAsiento` (`IdEstadoAsiento`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`IdAsiento`, `IdAutobus`, `NumeroAsiento`, `Columna`, `IdTipoAsiento`, `IdEstadoAsiento`) VALUES
(1, 1, 1, 'A', 1, 1),
(2, 1, 2, 'A', 1, 1),
(30, 2, 1, 'B', 1, 1),
(4, 1, 3, 'A', 1, 1),
(5, 1, 4, 'A', 1, 1),
(6, 1, 1, 'B', 1, 1),
(7, 1, 2, 'B', 1, 1),
(29, 2, 4, 'A', 1, 1),
(9, 1, 3, 'B', 1, 1),
(10, 1, 4, 'B', 1, 1),
(11, 1, 1, 'C', 1, 1),
(12, 1, 2, 'C', 1, 1),
(28, 2, 3, 'A', 1, 1),
(14, 1, 3, 'C', 1, 1),
(15, 1, 4, 'C', 1, 1),
(16, 1, 1, 'D', 1, 1),
(17, 1, 2, 'D', 1, 1),
(27, 2, 2, 'A', 1, 1),
(19, 1, 3, 'D', 1, 1),
(20, 1, 4, 'D', 1, 1),
(21, 1, 1, 'E', 1, 1),
(22, 1, 2, 'E', 1, 1),
(26, 2, 1, 'A', 1, 1),
(24, 1, 3, 'E', 1, 1),
(25, 1, 4, 'E', 1, 1),
(31, 2, 2, 'B', 1, 1),
(32, 2, 3, 'B', 1, 1),
(33, 2, 4, 'B', 1, 1),
(34, 2, 1, 'C', 1, 1),
(35, 2, 2, 'C', 1, 1),
(36, 2, 3, 'C', 1, 1),
(37, 2, 4, 'C', 1, 1),
(38, 2, 1, 'D', 1, 1),
(39, 2, 2, 'D', 1, 1),
(40, 2, 3, 'D', 1, 1),
(41, 2, 4, 'D', 1, 1),
(42, 2, 1, 'E', 1, 1),
(43, 2, 2, 'E', 1, 1),
(44, 2, 3, 'E', 1, 1),
(45, 2, 4, 'E', 1, 1),
(46, 2, 1, 'F', 1, 1),
(47, 2, 2, 'F', 1, 1),
(48, 2, 3, 'F', 1, 1),
(49, 2, 4, 'F', 1, 1),
(50, 2, 1, 'G', 1, 1),
(51, 2, 2, 'G', 1, 1),
(52, 2, 3, 'G', 1, 1),
(53, 2, 4, 'G', 1, 1),
(54, 2, 1, 'H', 1, 1),
(55, 2, 2, 'H', 1, 1),
(56, 2, 3, 'H', 1, 1),
(57, 2, 4, 'H', 1, 1),
(58, 2, 1, 'I', 1, 1),
(59, 2, 2, 'I', 1, 1),
(60, 2, 3, 'I', 1, 1),
(61, 2, 4, 'I', 1, 1),
(62, 2, 1, 'J', 1, 1),
(63, 2, 2, 'J', 1, 1),
(64, 2, 3, 'J', 1, 1),
(65, 0, 4, 'J', 1, 1),
(67, 3, 1, 'A', 1, 1),
(68, 3, 2, 'A', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobuses`
--

DROP TABLE IF EXISTS `autobuses`;
CREATE TABLE IF NOT EXISTS `autobuses` (
  `IdAutobus` int NOT NULL AUTO_INCREMENT,
  `IdClase` int DEFAULT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdEmpleado` int DEFAULT NULL,
  `Capacidad` int DEFAULT NULL,
  `Modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Año` int DEFAULT NULL,
  `Placas` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdAutobus`),
  KEY `IdClase` (`IdClase`),
  KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autobuses`
--

INSERT INTO `autobuses` (`IdAutobus`, `IdClase`, `Nombre`, `IdEmpleado`, `Capacidad`, `Modelo`, `Año`, `Placas`) VALUES
(1, 1, 'Unidad 1', 1, 20, 'Mercedez-Benz', 2023, 'MET-36-40'),
(2, 2, 'Unidad 2', 1, 30, 'Mercedez-Benz', 2022, 'JDC-36-50'),
(3, 2, 'Unidad 3', 1, 30, 'Mercedez-Benz', 2022, 'JDC-36-59'),
(5, 1, 'Unidad 4', 1, 20, 'Toyota', 2020, 'MET-60-71');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

DROP TABLE IF EXISTS `boletos`;
CREATE TABLE IF NOT EXISTS `boletos` (
  `IdBoleto` int NOT NULL AUTO_INCREMENT,
  `IdEstatusBoleto` int DEFAULT NULL,
  `IdUsuario` int DEFAULT NULL,
  `Nombre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Apellidos` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `IdPromocion` int DEFAULT NULL,
  `IdViaje` int DEFAULT NULL,
  `IdAsiento` int DEFAULT NULL,
  PRIMARY KEY (`IdBoleto`),
  KEY `IdEstatusBoleto` (`IdEstatusBoleto`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdPromocion` (`IdPromocion`),
  KEY `IdViaje` (`IdViaje`),
  KEY `IdAsiento` (`IdAsiento`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `IdClase` int NOT NULL AUTO_INCREMENT,
  `LogoClase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdClase`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`IdClase`, `LogoClase`, `Nombre`) VALUES
(1, 'view/img/Marcas/MarcaViajes/Marca1.png', 'Metaphora'),
(2, 'view/img/Marcas/MarcaViajes/Marca3.png', 'Ejecutivos del surestes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `IdEmpleado` int NOT NULL AUTO_INCREMENT,
  `IdPuesto` int DEFAULT NULL,
  `IdTerminal` int DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IdEmpleado`, `IdPuesto`, `IdTerminal`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `IdEstado` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdPais` int DEFAULT NULL,
  PRIMARY KEY (`IdEstado`),
  KEY `IdPais` (`IdPais`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`IdEstado`, `Nombre`, `IdPais`) VALUES
(1, 'Chiapas', 1),
(2, 'Aguascalientes', 1),
(3, 'Baja California', 1),
(4, 'Baja California Sur', 1),
(5, 'Campeche', 1),
(6, 'Coahuila', 1),
(7, 'Colima', 1),
(8, 'Ciudad de México', 1),
(9, 'Durango', 1),
(10, 'Guanajuato', 1),
(11, 'Guerrero', 1),
(12, 'Hidalgo', 1),
(13, 'Jalisco', 1),
(14, 'México', 1),
(15, 'Michoacán', 1),
(16, 'Morelos', 1),
(17, 'Nayarit', 1),
(18, 'Nuevo León', 1),
(19, 'Oaxaca', 1),
(20, 'Puebla', 1),
(21, 'Querétaro', 1),
(22, 'Quintana Roo', 1),
(23, 'San Luis Potosí', 1),
(24, 'Sinaloa', 1),
(25, 'Sonora', 1),
(26, 'Tabasco', 1),
(27, 'Tamaulipas', 1),
(28, 'Tlaxcala', 1),
(29, 'Veracruz', 1),
(30, 'Yucatán', 1),
(31, 'Zacatecas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoasientos`
--

DROP TABLE IF EXISTS `estadoasientos`;
CREATE TABLE IF NOT EXISTS `estadoasientos` (
  `IdEstadoAsiento` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdEstadoAsiento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadoasientos`
--

INSERT INTO `estadoasientos` (`IdEstadoAsiento`, `Nombre`) VALUES
(1, 'Disponible'),
(2, 'Ocupado'),
(3, 'Deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatusboleto`
--

DROP TABLE IF EXISTS `estatusboleto`;
CREATE TABLE IF NOT EXISTS `estatusboleto` (
  `IdEstatusBoleto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdEstatusBoleto`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatusboleto`
--

INSERT INTO `estatusboleto` (`IdEstatusBoleto`, `Nombre`) VALUES
(1, 'Activo'),
(2, 'Cancelado'),
(3, 'Devuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatusviajes`
--

DROP TABLE IF EXISTS `estatusviajes`;
CREATE TABLE IF NOT EXISTS `estatusviajes` (
  `IdEstatusViaje` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdEstatusViaje`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatusviajes`
--

INSERT INTO `estatusviajes` (`IdEstatusViaje`, `Nombre`) VALUES
(1, 'Activo'),
(2, 'No disponible'),
(3, 'En ruta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodospago`
--

DROP TABLE IF EXISTS `metodospago`;
CREATE TABLE IF NOT EXISTS `metodospago` (
  `IdMetodoPago` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdMetodoPago`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodospago`
--

INSERT INTO `metodospago` (`IdMetodoPago`, `Nombre`) VALUES
(1, 'Visaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificaciones`
--

DROP TABLE IF EXISTS `modificaciones`;
CREATE TABLE IF NOT EXISTS `modificaciones` (
  `IdModificaciones` int NOT NULL AUTO_INCREMENT,
  `TablaAfectada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdOperacion` int DEFAULT NULL,
  `IdUsuario` int DEFAULT NULL,
  `Fecha_Hora` datetime DEFAULT NULL,
  `Descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdModificaciones`),
  KEY `IdOperacion` (`IdOperacion`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `IdMunicipio` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdEstado` int DEFAULT NULL,
  PRIMARY KEY (`IdMunicipio`),
  KEY `IdEstado` (`IdEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`IdMunicipio`, `Nombre`, `IdEstado`) VALUES
(1, 'Tuxtla Gutierrez', 1),
(2, 'Berriozábal', 1),
(3, 'Ciudad de México', 8),
(4, 'Guadalajara', 13),
(5, 'Monterrey', 18),
(6, 'Puebla', 20),
(7, 'Mérida', 30),
(8, 'Cancún', 22),
(9, 'Tijuana', 3),
(10, 'León', 10),
(11, 'Querétaro', 21),
(12, 'Chihuahua', 9),
(13, 'Hermosillo', 25),
(14, 'Saltillo', 6),
(15, 'Aguascalientes', 2),
(16, 'San Luis Potosí', 23),
(17, 'Morelia', 15),
(18, 'Veracruz', 30),
(19, 'Oaxaca de Juárez', 19),
(21, 'Villahermosa', 26),
(22, 'Pijijiapan', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
CREATE TABLE IF NOT EXISTS `operaciones` (
  `IdOperacion` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdOperacion`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`IdOperacion`, `Nombre`) VALUES
(1, 'Actualizar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `IdPago` int NOT NULL AUTO_INCREMENT,
  `IdBoleto` int DEFAULT NULL,
  `FechaPago` date DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `IdMetodoPago` int DEFAULT NULL,
  PRIMARY KEY (`IdPago`),
  KEY `IdBoleto` (`IdBoleto`),
  KEY `IdMetodoPago` (`IdMetodoPago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `IdPais` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdPais`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`IdPais`, `Nombre`) VALUES
(1, 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

DROP TABLE IF EXISTS `promociones`;
CREATE TABLE IF NOT EXISTS `promociones` (
  `IdPromocion` int NOT NULL AUTO_INCREMENT,
  `Descuento` decimal(5,2) DEFAULT NULL,
  `Condiciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ImagenPromocion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activo` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`IdPromocion`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`IdPromocion`, `Descuento`, `Condiciones`, `ImagenPromocion`, `activo`) VALUES
(1, 200.00, 'Descuento del 30% en reservaciones anticipadas.', 'view/img/Promociones/promomini2.png', 1),
(2, 0.00, '6 meses sin intereses, pagando con PayPal', 'view/img/Promociones/promomini1.png', 1),
(3, 100.00, 'Descuento de $100 en tu boleto, pagando con tarjeta de debito/credito.', 'view/img/Promociones/promomini3.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `IdPuesto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`IdPuesto`, `Nombre`, `Descripcion`) VALUES
(1, 'CEO', 'Puesto mayor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `IdRol` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `Nombre`) VALUES
(1, 'Cliente'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

DROP TABLE IF EXISTS `rutas`;
CREATE TABLE IF NOT EXISTS `rutas` (
  `IdRuta` int NOT NULL AUTO_INCREMENT,
  `NombreRuta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdTerminalOrigen` int DEFAULT NULL,
  `IdTerminalDestino` int DEFAULT NULL,
  PRIMARY KEY (`IdRuta`),
  KEY `IdTerminalOrigen` (`IdTerminalOrigen`),
  KEY `IdTerminalDestino` (`IdTerminalDestino`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`IdRuta`, `NombreRuta`, `Descripcion`, `IdTerminalOrigen`, `IdTerminalDestino`) VALUES
(1, 'Tuxtla - CDMX', 'Viaje directo, desde Tuxtla Gutierrez, Chiapas, a la Ciudad de México.', 1, 4),
(2, 'Tuxtla - Berriozábal', 'Viaje directo, desde Tuxtla Gutiérrez, Chiapas, a Berriozábal', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminal`
--

DROP TABLE IF EXISTS `terminal`;
CREATE TABLE IF NOT EXISTS `terminal` (
  `IdTerminal` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ImgTerminal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Coordenadas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Pais` int DEFAULT NULL,
  `Estado` int DEFAULT NULL,
  `Municipio` int DEFAULT NULL,
  `CP` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdTerminal`),
  KEY `Pais` (`Pais`),
  KEY `Estado` (`Estado`),
  KEY `Municipio` (`Municipio`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terminal`
--

INSERT INTO `terminal` (`IdTerminal`, `Nombre`, `ImgTerminal`, `Coordenadas`, `Pais`, `Estado`, `Municipio`, `CP`, `Direccion`) VALUES
(1, 'Tuxtla Gutiérrez (Chiapas)', 'view/img/Terminales/Central1.jpg', '16.742848870595502, -93.10593561465953', 1, 1, 1, '29080', 'Maldonado 2'),
(2, 'Berriozábal Centro', 'view/img/Terminales/Central2.jpg', '16.79744568427841, -93.27525885268003', 1, 1, 2, '29130', 'El mirador'),
(3, 'Central de Autobuses de la Ciudad de México (TAPO)', 'view/img/Terminales/Central3.jpg', '19.4158, -99.0932', 1, 8, 3, '08010', 'Av. Ignacio Zaragoza 200'),
(4, 'Central de Autobuses del Norte (CDMX)', 'view/img/Terminales/Central4.jpg', '19.4856, -99.1174', 1, 8, 3, '07760', 'Av. Cien Metros 4907'),
(5, 'Central de Autobuses de Guadalajara', 'view/img/Terminales/Central5.jpg', '20.6614, -103.2846', 1, 13, 4, '44700', 'Av. de las Torres 1515'),
(6, 'Central de Autobuses de Monterrey', 'view/img/Terminales/Central6.jpg', '25.6734, -100.3091', 1, 18, 5, '64000', 'Av. Cristóbal Colón 855'),
(7, 'Central de Autobuses de Puebla (CAPU)', 'view/img/Terminales/Central7.jpg', '19.0826, -98.1984', 1, 20, 6, '72090', 'Blvd. Norte 4222'),
(8, 'Central de Autobuses de Mérida (TAME)', 'view/img/Terminales/Central8.jpg', '20.9669, -89.6237', 1, 31, 7, '97000', 'Calle 70 555'),
(9, 'Central de Autobuses de Cancún', 'view/img/Terminales/Central9.jpg', '21.1605, -86.8475', 1, 22, 8, '77500', 'Av. Tulum 230'),
(10, 'Central de Autobuses de Tijuana', 'view/img/Terminales/Central10.jpg', '32.5140, -116.9824', 1, 3, 9, '22150', 'Blvd. Abelardo L. Rodríguez 18821'),
(11, 'Central de Autobuses de León', 'view/img/Terminales/Central11.png', '21.1256, -101.6860', 1, 10, 10, '37320', 'Blvd. Adolfo López Mateos 1817'),
(12, 'Central de Autobuses de Querétaro', 'view/img/Terminales/Central12.jpg', '20.5937, -100.3929', 1, 21, 11, '76000', 'Av. Revolución 1'),
(13, 'Central de Autobuses de Chihuahua', 'view/img/Terminales/Central13.jpg', '28.6289, -106.0731', 1, 9, 12, '31140', 'Blvd. Juan Pablo II 4106'),
(14, 'Central de Autobuses de Hermosillo', 'view/img/Terminales/Central14.jpg', '29.0729, -110.9559', 1, 25, 13, '83000', 'Blvd. Eusebio Kino 100'),
(15, 'Central de Autobuses de Saltillo', 'view/img/Terminales/Central15.jpg', '25.4232, -101.0053', 1, 6, 14, '25000', 'Blvd. Francisco Coss 2400'),
(16, 'Central de Autobuses de Aguascalientes', 'view/img/Terminales/Central16.jpg', '21.8536, -102.2917', 1, 2, 15, '20200', 'Av. Circunvalación Sur 1801'),
(17, 'Central de Autobuses de San Luis Potosí', 'view/img/Terminales/Central17.jpg', '22.1421, -100.9765', 1, 23, 16, '78290', 'Av. Venustiano Carranza 2570'),
(18, 'Central de Autobuses de Morelia', 'view/img/Terminales/Central18.jpeg', '19.7026, -101.1920', 1, 15, 17, '58230', 'Periférico Paseo de la República 5550'),
(19, 'Central de Autobuses de Veracruz', 'view/img/Terminales/Central19.jpg', '19.1877, -96.1423', 1, 30, 18, '91900', 'Av. Salvador Díaz Mirón 1698'),
(20, 'Central de Autobuses de Oaxaca', 'view/img/Terminales/Central20.jpg', '17.0674, -96.7253', 1, 19, 19, '68120', 'Calz. Héroes de Chapultepec 1036'),
(22, 'Central de Autobuses de Villahermosa', 'view/img/Terminales/Central21.jpg', '17.9892, -92.9281', 1, 26, 21, '86100', 'Av. Adolfo Ruiz Cortines 1307');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoasientos`
--

DROP TABLE IF EXISTS `tipoasientos`;
CREATE TABLE IF NOT EXISTS `tipoasientos` (
  `IdTipoAsiento` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdTipoAsiento`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoasientos`
--

INSERT INTO `tipoasientos` (`IdTipoAsiento`, `Nombre`) VALUES
(1, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FotoPerfil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdRol` int DEFAULT NULL,
  `IdEmpleado` int DEFAULT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Paterno` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Materno` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Edad` int DEFAULT NULL,
  `Sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Pais` int DEFAULT NULL,
  `Estado` int DEFAULT NULL,
  `Municipio` int DEFAULT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CP` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `Username` (`Username`),
  KEY `IdRol` (`IdRol`),
  KEY `IdEmpleado` (`IdEmpleado`),
  KEY `Pais` (`Pais`),
  KEY `Estado` (`Estado`),
  KEY `Municipio` (`Municipio`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Username`, `Password`, `FotoPerfil`, `IdRol`, `IdEmpleado`, `Nombre`, `Paterno`, `Materno`, `Edad`, `Sexo`, `Pais`, `Estado`, `Municipio`, `Direccion`, `CP`, `Telefono`) VALUES
(4, 'mejorperzona@hotmail.com', '128Hidekikkdvak$', 'view/img/Usuarios/FotoPerfil_usuario_4.jpeg', 2, 1, 'Jose Angel Alberto', 'Herrera', 'Camacho', 21, 'M', 1, 1, 1, 'Av. Sinaloa MZ203 LT15, Las Granjas', '29019', '9611063428'),
(9, 'd@d.com', '123456', 'view/img/Usuarios/FotoPerfil_usuario_9.jpg', 1, NULL, 'Hide', 'King', 'Hola', 20, 'F', 1, 13, 4, 'Radium 3080, Colonia Industrial Sur', '44099', '3317091864');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

DROP TABLE IF EXISTS `viajes`;
CREATE TABLE IF NOT EXISTS `viajes` (
  `IdViaje` int NOT NULL AUTO_INCREMENT,
  `IdAutobus` int DEFAULT NULL,
  `IdRuta` int DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `FechaSalida` date DEFAULT NULL,
  `FechaLlegada` date DEFAULT NULL,
  `HoraSalida` time DEFAULT NULL,
  `HoraLlegada` time DEFAULT NULL,
  `IdEstatusViaje` int DEFAULT NULL,
  PRIMARY KEY (`IdViaje`),
  KEY `IdAutobus` (`IdAutobus`),
  KEY `IdRuta` (`IdRuta`),
  KEY `IdEstatusViaje` (`IdEstatusViaje`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`IdViaje`, `IdAutobus`, `IdRuta`, `Precio`, `FechaSalida`, `FechaLlegada`, `HoraSalida`, `HoraLlegada`, `IdEstatusViaje`) VALUES
(1, 1, 1, 800.00, '2025-05-13', '2025-05-13', '22:00:00', '07:00:00', 1),
(4, 2, 1, 800.00, '2025-05-13', '2025-05-13', '22:00:00', '07:00:00', 1),
(5, 3, 2, 20.00, '2025-05-13', '2025-05-13', '22:00:00', '22:30:00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
