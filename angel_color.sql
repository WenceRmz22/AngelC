-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-09-2015 a las 23:34:28
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `f403_angelcolor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `idclientes` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `rfc` varchar(45) NOT NULL,
  `cp` varchar(45) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idclientes`, `nombre`, `email`, `direccion`, `telefono`, `rfc`, `cp`, `fecha`) VALUES
(2, 'Juan', 'ajuan7', 'almez #5529', '7-18-76-07', '29849291730809128', '88291', '2015-08-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `nombre` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `rfc` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `fecha` date NOT NULL,
  `idproveedores` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`nombre`, `email`, `direccion`, `telefono`, `descripcion`, `rfc`, `cp`, `fecha`, `idproveedores`) VALUES
('Juan Manuel Ahumada Vazquez', 'jorge.a.torres.98', NULL, '7-18-76-07', '', '29849291730809128', '88293', '2015-09-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `idservicios` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `servicio` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idservicios`, `fecha`, `servicio`, `tipo`, `precio`) VALUES
(4, '2015-09-01', 'Foto', '6x4', '1500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `idstock` int(11) NOT NULL,
  `articulo` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `precioventa` varchar(45) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`idstock`, `articulo`, `marca`, `tipo`, `stock`, `precio`, `precioventa`, `observaciones`, `fecha`) VALUES
(1, 'objeto prueba', 'marca prueba', 'tipo prueba', '5', '150', '200', 'observaciones prueba', '2015-09-04'),
(2, 'objeto prueba1', 'marca prueba1', 'tipo prueba1', '6', '1500', '2000', 'obseraviones prueba', '2015-09-04'),
(3, 'objeto prueba3', 'marca prueba3', '5*5', '50', '700', '1400', 'Observaciones prueba', '2015-09-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(10) unsigned NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `privilegio` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `ingreso` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `privilegio`, `usuario`, `password`, `ip`, `ingreso`) VALUES
(2, 'juan manuel ahumada vazquez ', '1', 'juanadmin', '1f7d060dab05ab8e2ebdbdd679046bee', '::1', '2015-09-07 23:15:58'),
(3, 'Gerardo Diaz', '1', 'Gerardo', '01b3ebf87868b70121dc42784c97038a', '::1', '2015-08-17 23:28:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idclientes`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedores`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservicios`,`servicio`),
  ADD KEY `servicio` (`servicio`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`),
  ADD UNIQUE KEY `articulo` (`articulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idclientes` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedores` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idservicios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;